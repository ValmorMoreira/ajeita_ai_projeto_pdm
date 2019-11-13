<?php
namespace Teste\Funcional;

use Framework\DW3Sessao;
use \Teste\Teste;
use \Modelo\Usuario;
use \Framework\DW3BancoDeDados;

class TesteLogin extends Teste
{
    public function testeAcessar()
    {
        $resposta = $this->get(URL_RAIZ . 'login');
        $this->verificarContem($resposta, 'login');


    }

    public function testeLogin()
    {


        (new Usuario('Ricardo', 'de Oliveira', 'ricardo.de.oliveira@ricardo.com','123456789','123456789', null,null))->salvar();


        $login = $this->post(URL_RAIZ . 'login', [
            'usuario' => 'ricardo.de.oliveira@ricardo.com',
            'senha' => '123456789'
        ]);


        $this->verificarRedirecionar($login, URL_RAIZ . 'questao');
        $this->verificar(DW3Sessao::get('usuario') != null);
    }

    public function testeLoginInvalido()
    {
        $resposta = $this->post(URL_RAIZ . 'login', [
            'usuario' => 'joao@teste.com',
            'senha' => '123456789'
        ]);

        $this->verificarContem($resposta, 'Usuário ou senha inválido.');
        $this->verificar(DW3Sessao::get('usuario') == null);
    }

    public function testeDeslogar()
    {
        (new Usuario('Ricardo', 'de Oliveira', 'ricardo.de.oliveira@ricardo.com','123456789','123456789', null,null))->salvar();
        $resposta = $this->post(URL_RAIZ . 'login', [
            'usuario' => 'ricardo.de.oliveira@ricardo.com',
            'senha' => '123456789'
        ]);

        $resposta =  $this->get(URL_RAIZ. 'sair' );

        $this->verificarContem($resposta,  'login');
        $this->verificar(DW3Sessao::get('usuario') == null);
    }
}
