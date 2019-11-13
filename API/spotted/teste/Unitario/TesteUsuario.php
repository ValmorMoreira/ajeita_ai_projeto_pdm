<?php

namespace Teste\Unitario;

use \Teste\Teste;
use \Modelo\Usuario;
use \Modelo\Questao;
use \Framework\DW3BancoDeDados;
use Framework\DW3Sessao;


class TesteUsuario extends Teste
{

    public function testeInserir()
    {
        $usuario = new Usuario('Ricardo', 'Martins', 'ricardo@gamilc.com', '123456789', '123456789', null, null);
        $usuario->salvar();
        $query = DW3BancoDeDados::query('SELECT * FROM usuarios');
        $baseUsuario = $query->fetch();
        $this->verificar($baseUsuario['email'] === $usuario->getEmail());
        $this->verificar($query->rowCount() == 1);
    }


    public function testeEmail()
    {
        $usuario = new Usuario('Ricardo', 'Martins', 'ricardo@gmail.com', '123456789', '123456789', null, null);
        $usuario->salvar();

        $this->verificar('ricardo@gmail.com' === $usuario->getEmail());
    }

    public function testeBuscarTodos()
    {
        $ricardo = new Usuario('Ricardo', 'Martins', 'ricardo@gmail.com', '123456789', '123456789', null, null);
        $bruna = new Usuario('Bruna', 'Camomila', 'bruna@gmail.com', '123456789', '123456789', null, null);
        $ricardo->salvar();
        $bruna->salvar();


        $resultado = Usuario::buscarTodos();
        foreach ($resultado as $user) {
            if ( $user['nome'] == 'Ricardo' ) {
                $this->verificar('Ricardo' === $user['nome']);
            } else {
                if ( $user['nome'] == 'Bruna' ) {
                    $this->verificar('Bruna' === $user['nome']);

                }
            }
        }


    }

    public function testeQuantidadeAcertos()
    {
        TesteUsuario::salvarOutroUsuario();
        TesteUsuario::salvarOutroUsuario1();
      $usuario =  TesteUsuario::salvarUsuario();

        $usuario = DW3Sessao::get('usuario');

       $todasQuestoes = Questao::buscarPorId(4, 0, $usuario->getId(), 'facil');

       //
        foreach ($todasQuestoes as $questao) {
            $resposta = $this->post(URL_RAIZ . 'questao/responderPagina', [
                'id_quest' => $questao->getId(),
                'pagina' => 1,
                'alternativaCorreta' => 'CERTA'

            ]);
            $resposta = $this->get(URL_RAIZ . 'questao/responderPagina');
            $this->verificarContem($resposta, 'Que maravilha você acertou');
        }

       $this->verificar($usuario->getAcertos() , 2);
    }


    private function salvarOutroUsuario()
    {

        (new Usuario('Bruna', 'Camomila', 'bruna.camomila@gmail.com', '123456789', '123456789', null, null))->salvar();

        $login = $this->post(URL_RAIZ . 'login', [
            'usuario' => 'bruna.camomila@gmail.com',
            'senha' => '123456789'
        ]);

        $resposta = $this->post(URL_RAIZ . 'questao/criarPagina', [
            'titulo' => 'O que é, o que é?',
            'descricao' => 'O que é, o que é? Feito para andar e não anda facil.',
            'select' => 'facil',
            'a' => 'Carro',
            'b' => 'Sapato',
            'c' => 'Violão',
            'd' => 'CERTA',
            'e' => 'Spacionave',
            'alternativaCorreta' => 'd'

        ]);
        $resposta = $this->get(URL_RAIZ . 'questao/minhasQuestoesPagina');
        $this->verificarContem($resposta, ' O que &eacute;, o que &eacute;? Feito para andar e n&atilde;o anda facil');




    }

    private function salvarOutroUsuario1()
    {

        (new Usuario('Bruna', 'Camomila', 'bruna.camomila@gmail.com.br', '123456789', '123456789', null, null))->salvar();

        $login = $this->post(URL_RAIZ . 'login', [
            'usuario' => 'bruna.camomila@gmail.com.br',
            'senha' => '123456789'
        ]);

        $resposta = $this->post(URL_RAIZ . 'questao/criarPagina', [
            'titulo' => 'O que é, o que é?',
            'descricao' => 'O que é, o que é? Feito para andar e não anda facil.',
            'select' => 'facil',
            'a' => 'ERRADA',
            'b' => 'Sapato',
            'c' => 'Violão',
            'd' => 'CERTA',
            'e' => 'Spacionave',
            'alternativaCorreta' => 'd'

        ]);
        $resposta = $this->get(URL_RAIZ . 'questao/minhasQuestoesPagina');
        $this->verificarContem($resposta, ' O que &eacute;, o que &eacute;? Feito para andar e n&atilde;o anda facil');



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
