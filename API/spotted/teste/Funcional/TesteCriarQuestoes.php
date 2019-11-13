<?php

namespace Teste\Funcional;

use Framework\DW3Sessao;
use \Teste\Teste;
use \Modelo\Usuario;
use \Framework\DW3BancoDeDados;

class TesteCriarQuestoes extends Teste
{


    public function testeLogin()
    {


        $login =TesteCriarQuestoes::salvarUsuario();

        $this->verificar(DW3Sessao::get('usuario') != null);

        $this->verificarRedirecionar($login, URL_RAIZ . 'questao');


    }

    public function testeCriarPagina()
    {

        $login =TesteCriarQuestoes::salvarUsuario();


        $resposta = $this->get(URL_RAIZ . 'questao/criarPagina');

        $this->verificarContem($resposta, 'criar_questao');
        $this->verificar(DW3Sessao::get('usuario') != null);

    }

    public function testeCriarQuestaoCorreta()
    {

        $login =TesteCriarQuestoes::salvarUsuario();

        $resposta = $this->post(URL_RAIZ . 'questao/criarPagina', [
            'titulo' => 'O que é, o que é?',
            'descricao' => 'O que é, o que é? Feito para andar e não anda.',
            'select' => 'facil',
            'a'=> 'Carro',
            'b' => 'Sapato',
            'c' => 'Violão',
            'd' => 'Rua',
            'e' => 'Spacionave',
            'alternativaCorreta' => 'd'

        ]);


       $resposta = $this->get(URL_RAIZ . 'questao/criarPagina');

        $this->verificarContem($resposta, 'Questao salva com sucesso!  <span class="emoj">😉</span>');
        $this->verificar(DW3Sessao::get('usuario') != null);

    }

    public function testeCriarQuestaoAlternativaFaltando()
    {

        $login =TesteCriarQuestoes::salvarUsuario();

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

        $login =TesteCriarQuestoes::salvarUsuario();

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

        $login =TesteCriarQuestoes::salvarUsuario();

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

        $login =TesteCriarQuestoes::salvarUsuario();

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

        $login =TesteCriarQuestoes::salvarUsuario();

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

        $login =TesteCriarQuestoes::salvarUsuario();

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
