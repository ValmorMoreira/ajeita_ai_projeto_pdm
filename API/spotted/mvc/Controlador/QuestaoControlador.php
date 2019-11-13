<?php

namespace Controlador;

use Framework\DW3Sessao;
use Modelo\Questao;

class QuestaoControlador extends Controlador
{
    public function index()
    {

        $usuario = DW3Sessao::get('usuario');

        if ($usuario) {

            $paginacao = $this->calcularPaginacao(null);


            $this->visao('questao/index.php', [
                'questoes' => $paginacao['questoes'],
                'pagina' => $paginacao['pagina'],
                'ultimaPagina' => $paginacao['ultimaPagina'],
            ], 'logado.php');
        } else {
            $this->redirecionar(URL_RAIZ . 'login');

        }


    }

    private function calcularPaginacao($id)
    {

        $dificuldade = DW3Sessao::get('filtroDificuldade');

        if ($id) {
            $pagina = array_key_exists('p', $_GET) ? intval($_GET['p']) : 1;
            $limit = 4;
            $offset = ($pagina - 1) * $limit;
            $questoes = Questao::buscarPorId($limit, $offset, $id, $dificuldade);
            $ultimaPagina = ceil(Questao::contarTodosId($id) / $limit);
            return compact('pagina', 'questoes', 'ultimaPagina');

        } else {

            $pagina = array_key_exists('p', $_GET) ? intval($_GET['p']) : 1;
            $limit = 4;
            $offset = ($pagina - 1) * $limit;
            $questoes = Questao::buscarTodos($limit, $offset);
            $ultimaPagina = ceil(Questao::contarTodos() / $limit);
            return compact('pagina', 'questoes', 'ultimaPagina');
        }

    }

    public function naoLogado()
    {

        $paginacao = $this->calcularPaginacao(null);


        $this->visao('questao/naoLogado.php', [
            'questoes' => $paginacao['questoes'],
            'pagina' => $paginacao['pagina'],
            'ultimaPagina' => $paginacao['ultimaPagina'],
        ]);
    }

    public function criarPaginaQuestao()
    {
        $usuario = DW3Sessao::get('usuario');

        if ($usuario) {
            $this->visao('questao/criar.php', ['sucesso' => DW3Sessao::getFlash('sucesso')], 'logado.php');
        } else {
            $this->redirecionar(URL_RAIZ . 'login');

        }

    }

    public function responderPaginaQuestao()
    {


        $usuario = DW3Sessao::get('usuario');
        if ($usuario) {

            $paginacao = $this->calcularPaginacao($usuario->getId());


            $flash = DW3Sessao::getFlash('flash');
            $valores = DW3Sessao::get('acertou');

            //$acertou = $paginacao['questoes'];


            $this->visao('questao/responder.php', [
                'questoes' => $paginacao['questoes'],

                'pagina' => $paginacao['pagina'],
                'ultimaPagina' => $paginacao['ultimaPagina'],
                'flash' => $flash,
                'valores' => $valores
            ], 'logado.php');


        } else {
            $this->redirecionar(URL_RAIZ . 'login');
        }

    }

    public function responderFiltro()
    {

        $usuario = DW3Sessao::get('usuario');


        if ($usuario) {
            if (isset($_GET['select'])) {
                if (!DW3Sessao::get('filtroDificuldade')) {
                    DW3Sessao::set('filtroDificuldade', 'facil');

                } else {
                    DW3Sessao::set('filtroDificuldade', $_GET['select']);
                }
            }

            $paginacao = $this->calcularPaginacao($usuario->getId());

            $flash = DW3Sessao::getFlash('flash');
            $valores = DW3Sessao::get('acertou');

            //$acertou = $paginacao['questoes'];


            $this->visao('questao/responder.php', [
                'questoes' => $paginacao['questoes'],

                'pagina' => $paginacao['pagina'],
                'ultimaPagina' => $paginacao['ultimaPagina'],
                'flash' => $flash,
                'valores' => $valores
            ], 'logado.php');


        } else {
            $this->redirecionar(URL_RAIZ . 'login');
        }

    }

    public function relatorioPageQuestao()
    {

        $usuario = DW3Sessao::get('usuario');

        if ($usuario) {


            $this->visao('questao/relatorio.php', [

            ], 'logado.php');
        } else {
            $this->redirecionar(URL_RAIZ . 'login');

        }
    }

    public function respostaQuestao()
    {

        $usuario = DW3Sessao::get('usuario');
        if ($usuario) {


            $id_quest = $_POST['id_quest'];

            $pagina = $_POST['pagina'];
            $id_user = $usuario->getId();

            if (isset($_POST['alternativaCorreta'])) {

                $alternativaCorreta = $_POST['alternativaCorreta'];
                $validaQuest = Questao::validacaoQuest($id_quest, $alternativaCorreta, $id_user);

                if ($validaQuest) {
                    DW3Sessao::setFlash('flash', 'Que maravilha você acertou! <span class="emoj"> 😉</span>');
                    DW3Sessao::set('acertou',
                        [
                            'alternativa' => $alternativaCorreta,
                            'resultado' => $validaQuest,
                            'id_quest' => $id_quest
                        ]);
                    if ($pagina) {
                        $this->redirecionar(URL_RAIZ . 'questao/responderPagina?p=' . $pagina);

                    } else {
                        $this->redirecionar(URL_RAIZ . 'questao/responderPagina');

                    }
                    $this->redirecionar(URL_RAIZ . 'questao/responderPagina?p=' . $pagina);

                } else {

                    DW3Sessao::setFlash('flash', 'Ops, eita, melhor dedicar mais na próxima!  <span class="emoj">😭</span>');
                    DW3Sessao::set('acertou',
                        [
                            'alternativa' => $alternativaCorreta,
                            'resultado' => $validaQuest,
                            'id_quest' => $id_quest
                        ]);
                    if ($pagina) {
                        $this->redirecionar(URL_RAIZ . 'questao/responderPagina?p=' . $pagina);

                    } else {
                        $this->redirecionar(URL_RAIZ . 'questao/responderPagina');

                    }

                }
            } else {
                DW3Sessao::setFlash('flash', 'Eita, acho que você não marcou a alternativa que quer responder! <h5 class="animated  heartBeat delay-3s"> <span class="emoj">😅</span></h5>');
                DW3Sessao::set('acertou',
                    [

                        'id_quest' => $id_quest
                    ]);
                if ($pagina) {
                    $this->redirecionar(URL_RAIZ . 'questao/responderPagina?p=' . $pagina);

                } else {
                    $this->redirecionar(URL_RAIZ . 'questao/responderPagina');

                }
            }
        } else {
            $this->redirecionar(URL_RAIZ . 'login');
        }

    }

    public function salvarQuestao()
    {

        $usuario = DW3Sessao::get('usuario');

        $foto = array_key_exists('foto', $_FILES) ? $_FILES['foto'] : null;

        $titulo = htmlentities($_POST['titulo']);
        $descricao = htmlentities($_POST['descricao']);
        $dificuldade = htmlentities($_POST['select']);
        $a = htmlentities($_POST['a']);
        $b = htmlentities($_POST['b']);
        $c = htmlentities($_POST['c']);
        $d = htmlentities($_POST['d']);
        $e = htmlentities($_POST['e']);
        $e = htmlentities($_POST['e']);

        $foto = array_key_exists('img', $_FILES) ? $_FILES['img'] : null;

        if ($usuario) {

            if (isset($_POST['alternativaCorreta'])) {
                $alternativaCorreta = $_POST['alternativaCorreta'];

                $questao = new Questao(
                    $usuario,
                    $usuario->getId(),
                    $titulo,
                    $descricao,
                    $dificuldade,
                    $alternativaCorreta,
                    ["a" => $a, "b" => $b, "c" => $c, "d" => $d, "e" => $e],
                    $foto,
                    null
                );

                if ($questao->isValido()) {
                    $questao->salvar();
                    DW3Sessao::setFlash('sucesso', 'Questao salva com sucesso!  <span class="emoj">😉</span>');
                    $this->redirecionar(URL_RAIZ . 'questao/criarPagina');

                } else {
                    $this->setErros($questao->getValidacaoErros());

                    $this->visao('questao/criar.php',

                        [
                            'gif' => 'no',
                            'titulo' => $titulo,
                            'descricao' => $descricao,
                            'dificuldade' => $dificuldade,
                            'a' => $a,
                            'b' => $b,
                            'c' => $c,
                            'd' => $d,
                            'e' => $e,
                            'alternativaCorreta' => $alternativaCorreta,
                            'sucesso' => null

                        ], 'logado.php'
                    );
                }

            } else {
                $this->setErros(['alternativa' => 'Tem que selecionar uma alternativa correta para proceguir <span class="emoj"> 😶</span>']);

                $this->visao('questao/criar.php',

                    [
                        'gif' => 'no',
                        'titulo' => $titulo,
                        'descricao' => $descricao,
                        'dificuldade' => $dificuldade,
                        'a' => $a,
                        'b' => $b,
                        'c' => $c,
                        'd' => $d,
                        'e' => $e,
                        'alternativaCorreta' => null,
                        'sucesso' => null

                    ], 'logado.php'
                );
            }

        } else {
            $this->redirecionar(URL_RAIZ . 'login');
        }

    }


}
