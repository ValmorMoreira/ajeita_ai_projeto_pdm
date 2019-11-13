<?php

namespace Controlador;

use Framework\DW3Sessao;
use Modelo\Questao;
use Modelo\Relatorio;

class MinhasQuestoesControlador extends Controlador
{
    public function index()
    {


        $usuario = DW3Sessao::get('usuario');
        if ($usuario) {

            $paginacao = $this->calcularPaginacao($usuario->getId());


            $flash = DW3Sessao::getFlash('sucesso');
            $dados = DW3Sessao::getFlash('dados');
            // $valores = DW3Sessao::get('acertou');


            $this->visao('questao/minhasQuestoes.php', [
                'questoes' => $paginacao['questoes'],

                'pagina' => $paginacao['pagina'],
                'ultimaPagina' => $paginacao['ultimaPagina'],
                'flash' => $flash,
                'dados' => $dados,

                //  'valores' => $valores
            ], 'logado.php');


        } else {
            $this->redirecionar(URL_RAIZ . 'login');
        }


    }


    private function calcularPaginacao($id)
    {
        if ($id) {
            $pagina = array_key_exists('p', $_GET) ? intval($_GET['p']) : 1;
            $limit = 4;
            $offset = ($pagina - 1) * $limit;
            $questoes = Questao::buscarPorIdUser($limit, $offset, $id);
            $ultimaPagina = ceil(Questao::contarTodosDoUser($id) / $limit);
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

    public function destruir($id)
    {


        $usuario = DW3Sessao::get('usuario');


        if ($usuario) {
            Questao::deletarById($id);
            DW3Sessao::set('flash', "A sua questão foi apagada para todo sempre!");

            $paginacao = $this->calcularPaginacao($usuario->getId());

            $flash = DW3Sessao::getFlash('flash');
            // $valores = DW3Sessao::get('acertou');


            $this->visao('questao/minhasQuestoes.php', [
                'questoes' => $paginacao['questoes'],

                'pagina' => $paginacao['pagina'],
                'ultimaPagina' => $paginacao['ultimaPagina'],
                'flash' => $flash,

                //  'valores' => $valores
            ], 'logado.php');


        } else {
            $this->redirecionar(URL_RAIZ . 'login');
        }


    }


    public function editar()
    {


        $usuario = DW3Sessao::get('usuario');

        $paginacao = $this->calcularPaginacao($usuario->getId());
        $titulo = $_POST['titulo'];
        $descricao = $_POST['descricao'];
        $dificuldade = $_POST['select'];
        $a = $_POST['a'];
        $b = $_POST['b'];
        $c = $_POST['c'];
        $d = $_POST['d'];
        $e = $_POST['e'];
        $idQuest = $_POST['id_quest'];
        $pagina = $_POST['pagina'];

        if ($usuario) {
            $valores = DW3Sessao::get('acertou');

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
                    null,
                    $idQuest

                );

                if ($questao->isValido()) {
                    $questao->atualizarQuest();
                    DW3Sessao::setFlash('sucesso', 'Questao atualizada com sucesso!  <span class="emoj">😉</span>');
                    $this->redirecionar(URL_RAIZ . 'questao/minhasQuestoesPagina?p=' . $pagina);

                } else {
                    $questao->setErros($questao->getValidacaoErros());


                    $dados = [
                        'erros' => $questao->getErros(),
                        'questao' => $questao,
                        'idQuest' => $idQuest,
                        'flash' => 'Ops, eu desconfio que há algo errado, confere na sua questão se está tuod ok! <span class="emoj"> 😶</span>',
                        'pagina' => $pagina,
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
                        'sucesso' => null,
                        'questoes' => $paginacao['questoes'],
                        'valores' => $valores,
                        'pagina' => $paginacao['pagina'],
                        'ultimaPagina' => $paginacao['ultimaPagina'],
                        'idQuest' => $idQuest,
                        'pagina' => $pagina,

                    ];

                    DW3Sessao::setFlash('dados', $dados);
                    $this->redirecionar(URL_RAIZ . 'questao/minhasQuestoesPagina?p=' . $pagina);
                }

            } else {
                $this->setErros(['alternativa' => 'Tem que selecionar uma alternativa correta para proceguir <span class="emoj" > 😶</span>']);


                $dados = [
                    'erros' => $this->getErro(),
                    'idQuest' => $idQuest,
                    'flash' => 'Ops, eu desconfio que há algo errado, confere na sua questão se está tuod ok! <span class="emoj"> 😶</span>',
                    'pagina' => $pagina,
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
                    'sucesso' => null,
                    'questoes' => $paginacao['questoes'],
                    'valores' => $valores,
                    'pagina' => $paginacao['pagina'],
                    'ultimaPagina' => $paginacao['ultimaPagina'],
                    'idQuest' => $idQuest,
                    'pagina' => $pagina,

                ];

                DW3Sessao::setFlash('dados', $dados);
                $this->redirecionar(URL_RAIZ . 'questao/minhasQuestoesPagina?p=' . $pagina);

            }

        } else {
            $this->redirecionar(URL_RAIZ . 'login');
        }

    }

}
