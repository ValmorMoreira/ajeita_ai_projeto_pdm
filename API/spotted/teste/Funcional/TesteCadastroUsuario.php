<?php

namespace Teste\Funcional;

use Framework\DW3Sessao;
use \Teste\Teste;
use \Modelo\Usuario;
use \Framework\DW3BancoDeDados;

class TesteCadastroUsuario extends Teste
{
    public function testeAcessar()
    {
        $resposta = $this->get(URL_RAIZ . 'cadastroUsuario');
        $this->verificarContem($resposta, 'cadastro_usuario');


    }

    public function testeCriarUsuarioCorreto()
    {
        $resposta = $this->post(URL_RAIZ . 'cadastroUsuario', [
            'nome' => 'Ricardo',
            'sobrenome' => 'de Oliveira',
            'senha' => 123456789,
            'senha1' => 123456789,
            'email' => 'ricardo.oliveira@gmail.com',

        ]);
        $this->verificarRedirecionar($resposta, 'questao');
        $this->verificar(DW3Sessao::get('usuario') != null);
    }


    public function testeCriarUsuarioErrado1()
    {
        $resposta = $this->post(URL_RAIZ . 'cadastroUsuario', [
            'nome' => 'Ricardo12',
            'sobrenome' => 'de Oliveira',
            'senha' => 123456789,
            'senha1' => 123456789,
            'email' => 'ricardo.oliveira@gmail.com',

        ]);

        $this->verificarContem($resposta, 'somente letras são permitido');

    }

    public function testeCriarUsuarioErrado2()
    {
        $resposta = $this->post(URL_RAIZ . 'cadastroUsuario', [
            'nome' => 'Ricardo',
            'sobrenome' => 'de Oliveira12',
            'senha' => 123456789,
            'senha1' => 123456789,
            'email' => 'ricardo.oliveira@gmail.com',

        ]);

        $this->verificarContem($resposta, 'somente letras são permitido');

    }

    public function testeCriarUsuarioErrado3()
    {
        $resposta = $this->post(URL_RAIZ . 'cadastroUsuario', [
            'nome' => 'R',
            'sobrenome' => 'de Oliveira12',
            'senha' => '123456789',
            'senha1' => '123456789',
            'email' => 'ricardo.oliveira@gmail.com',

        ]);

        $this->verificarContem($resposta, 'O nome deve conter mais que 2 letras');

    }

    public function testeCriarUsuarioErrado4()
    {
        $resposta = $this->post(URL_RAIZ . 'cadastroUsuario', [
            'nome' => 'Ricardo',
            'sobrenome' => 'e',
            'senha' => '123456789',
            'senha1' => '123456789',
            'email' => 'ricardo.oliveira@gmail.com',

        ]);

        $this->verificarContem($resposta, 'O sobrenome deve conter mais que 5 letras');

    }

    public function testeCriarUsuarioErrado5()
    {
        $resposta = $this->post(URL_RAIZ . 'cadastroUsuario', [
            'nome' => 'Ricardo',
            'sobrenome' => 'de Oliveira',
            'senha' => '',
            'senha1' => '123456789',
            'email' => 'ricardo.oliveira@gmail.com',

        ]);

        $this->verificarContem($resposta, 'A senha deve conter no minimo 8 caracteres');

    }

    public function testeCriarUsuarioErrado6()
    {
        $resposta = $this->post(URL_RAIZ . 'cadastroUsuario', [
            'nome' => 'Ricardo',
            'sobrenome' => 'de Oliveira',
            'senha' => '12',
            'senha1' => '12',
            'email' => 'ricardo.oliveira@gmail.com',

        ]);

        $this->verificarContem($resposta, 'A senha deve conter no minimo 8 caracteres');

    }
    public function testeCriarUsuarioErrado7()
    {
        $resposta = $this->post(URL_RAIZ . 'cadastroUsuario', [
            'nome' => 'Ricardo',
            'sobrenome' => 'de Oliveira',
            'senha' => '1231231233',
            'senha1' => '1231231235',
            'email' => 'ricardo.oliveira@gmail.com',

        ]);

        $this->verificarContem($resposta, 'As senhas estão diferente');

    }
    public function testeCriarUsuarioErrado8()
    {
        $resposta = $this->post(URL_RAIZ . 'cadastroUsuario', [
            'nome' => 'Ricardo',
            'sobrenome' => 'de Oliveira',
            'senha' => '1231231233',
            'senha1' => '123123123',
            'email' => 'ricardo.oliveira@gmail.commmmmmmmm',

        ]);

        $this->verificarContem($resposta, 'Eita, acho que você inseriu um email que não é um email');

    }

}
