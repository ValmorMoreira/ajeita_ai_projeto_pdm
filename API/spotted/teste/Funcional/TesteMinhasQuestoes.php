<?php

namespace Teste\Funcional;

use Framework\DW3Sessao;
use Modelo\Questao;
use \Teste\Teste;
use \Modelo\Usuario;
use \Framework\DW3BancoDeDados;

class TesteMinhasQuestoes extends Teste
{


    public function testeLogin()
    {


        $login = TesteMinhasQuestoes::salvarUsuario();

        $this->verificar(DW3Sessao::get('usuario') != null);

        $this->verificarRedirecionar($login, URL_RAIZ . 'questao');


    }

    public function testeMinhasQuestoesPagina()
    {

        $login = TesteMinhasQuestoes::salvarUsuario();


        $resposta = $this->get(URL_RAIZ . 'questao/minhasQuestoesPagina');

        $this->verificarContem($resposta, 'minhas_questoes');
        $this->verificar(DW3Sessao::get('usuario') != null);

    }


    public function testeMinhasQuestoesSemNada()
    {

        $login = TesteMinhasQuestoes::salvarUsuario();


        $resposta = $this->get(URL_RAIZ . 'questao/minhasQuestoesPagina');

        $this->verificarContem($resposta, 'Me desculpe, mas... não temos questões para responder!
                                    Porém poderá criar diversas questões para seus amigos possam responder!');
        $this->verificar(DW3Sessao::get('usuario') != null);

    }

    public function testeCriarQuestaoCorreta()
    {

        $login = TesteMinhasQuestoes::salvarUsuario();

        $resposta = $this->post(URL_RAIZ . 'questao/criarPagina', [
            'titulo' => 'O que é, o que é?',
            'descricao' => 'O que é, o que é? Feito para andar e não anda.',
            'select' => 'facil',
            'a' => 'Carro',
            'b' => 'Sapato',
            'c' => 'Violão',
            'd' => 'Rua',
            'e' => 'Spacionave',
            'alternativaCorreta' => 'd'

        ]);


        $resposta = $this->get(URL_RAIZ . 'questao/minhasQuestoesPagina');
        $this->verificarContem($resposta, ' O que &eacute;, o que &eacute;? Feito para andar e n&atilde;o anda');
        $this->verificar(DW3Sessao::get('usuario') != null);

    }

    public function testeDeletarQuestao()
    {

        $login = TesteMinhasQuestoes::salvarUsuario();

        $resposta = $this->post(URL_RAIZ . 'questao/criarPagina', [
            'titulo' => 'O que é, o que é?',
            'descricao' => 'O que é, o que é? Feito para andar e não anda.',
            'select' => 'facil',
            'a' => 'Carro',
            'b' => 'Sapato',
            'c' => 'Violão',
            'd' => 'Rua',
            'e' => 'Spacionave',
            'alternativaCorreta' => 'd'

        ]);

        $questao = Questao::buscarTodos();
        $id = $questao[0]->getId();

        $resposta = $this->delete(URL_RAIZ . 'questao/minhasQuestoesPagina/' . $id);
        $resposta = $this->get(URL_RAIZ . 'questao/minhasQuestoesPagina');

        $this->verificarContem($resposta, 'não temos questões para responder');
        $this->verificar(DW3Sessao::get('usuario') != null);

    }

    public function testeCriarQuestaoAlternativaFaltando()
    {

        $login =TesteMinhasQuestoes::salvarUsuario();

        $resposta = $this->post(URL_RAIZ . 'questao/criarPagina', [
            'titulo' => 'O que é, o que é?',
            'descricao' => 'O que é, o que é? Feito para andar e não anda.',
            'select' => 'facil',
            'a'=> 'Carro',
            'b' => 'Sapato',
            'c' => 'Violão',
            'd' => 'Rua',
            'e' => 'Spacionave',


        ]);

        $this->verificarContem($resposta, 'Tem que selecionar uma alternativa correta para proceguir <span class="emoj"> 😶</span>');
        $this->verificar(DW3Sessao::get('usuario') != null);

    }

    public function testeCriarQuestaoTituloErrado()
    {

        $login =TesteMinhasQuestoes::salvarUsuario();

        $resposta = $this->post(URL_RAIZ . 'questao/criarPagina', [
            'titulo' => 'O',
            'descricao' => 'O que é, o que é? Feito para andar e não anda.',
            'select' => 'facil',
            'a'=> 'Carro',
            'b' => 'Sapato',
            'c' => 'Violão',
            'd' => 'Rua',
            'e' => 'Spacionave',
            'alternativaCorreta' => 'd'

        ]);

        $this->verificarContem($resposta, 'O Titulo deve ter entre 5 e 1000 caracteres');
        $this->verificar(DW3Sessao::get('usuario') != null);

    }
    public function testeCriarDescricaoTituloErrado()
    {

        $login =TesteMinhasQuestoes::salvarUsuario();

        $resposta = $this->post(URL_RAIZ . 'questao/criarPagina', [
            'titulo' => 'O que é, o que é?',
            'descricao' => 'O',
            'select' => 'facil',
            'a'=> 'Carro',
            'b' => 'Sapato',
            'c' => 'Violão',
            'd' => 'Rua',
            'e' => 'Spacionave',
            'alternativaCorreta' => 'd'

        ]);

        $this->verificarContem($resposta, 'A descrição deve ter entre 5 e 1000 caracteres');
        $this->verificar(DW3Sessao::get('usuario') != null);

    }

    public function testeCriarDificuldadeErrado()
    {

        $login =TesteMinhasQuestoes::salvarUsuario();

        $resposta = $this->post(URL_RAIZ . 'questao/criarPagina', [
            'titulo' => 'O que é, o que é?',
            'descricao' => 'O que é, o que é? Feito para andar e não anda.',
            'select' => 'faciliz',
            'a'=> 'Carro',
            'b' => 'Sapato',
            'c' => 'Violão',
            'd' => 'Rua',
            'e' => 'Spacionave',
            'alternativaCorreta' => 'd'

        ]);


        $this->verificarContem($resposta, '<div class="img_no circle">');
        $this->verificar(DW3Sessao::get('usuario') != null);

    }

    public function testeCriarAlternativaErrado1()
    {

        $login =TesteMinhasQuestoes::salvarUsuario();

        $resposta = $this->post(URL_RAIZ . 'questao/criarPagina', [
            'titulo' => 'O que é, o que é?',
            'descricao' => 'O que é, o que é? Feito para andar e não anda.',
            'select' => 'faciliz',
            'a'=> 'Carro',
            'b' => null,
            'c' => null,
            'd' => null,
            'e' => null,

            'alternativaCorreta' => 'a'

        ]);

        $this->verificarContem($resposta, 'Deve se criar duas ou mais alternativas!');

        $this->verificar(DW3Sessao::get('usuario') != null);

    }


    public function testeCriarDificuldadeErrado2()
    {

        $login =TesteMinhasQuestoes::salvarUsuario();

        $resposta = $this->post(URL_RAIZ . 'questao/criarPagina', [
            'titulo' => 'O que é, o que é?',
            'descricao' => 'O que é, o que é? Feito para andar e não anda.',
            'select' => 'faciliz',
            'a'=> 'Carro',
            'b' => 'Sapato',
            'c' => 'Violão',
            'd' => null,
            'e' => 'Spacionave',
            'alternativaCorreta' => 'd'

        ]);


        $this->verificarContem($resposta, 'Ops, deve se selecionar a altenativa correta para continuar!');
        $this->verificar(DW3Sessao::get('usuario') != null);

    }



    private function salvarUsuario()
    {

        (new Usuario('Ricardo', 'de Oliveira', 'ricardo.de.oliveira@ricardo.com', '123456789', '123456789', null, null))->salvar();

        $login = $this->post(URL_RAIZ . 'login', [
            'usuario' => 'ricardo.de.oliveira@ricardo.com',
            'senha' => '123456789'
        ]);
        return $login;

    }
}
