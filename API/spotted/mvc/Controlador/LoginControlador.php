<?php

namespace Controlador;

use \Modelo\Usuario;
use \Framework\DW3Sessao;


class LoginControlador extends Controlador
{
    public function loginPage()
    {



        $usuarioID = DW3Sessao::get('usuario');

        if ( !$usuarioID ) {

            $this->visao('login/index.php');

        } else {
            $this->redirecionar(URL_RAIZ . 'questao');

        }

    }


    public function loginPageAPI()
    {
        header('Content-Type: application/json');
      //  $usuarios = Usuario::buscarTodos();

       // echo json_encode($usuarios);

    }


    public function destruirLogin()
    {
        DW3Sessao::deletar('usuario');

        $this->visao('login/index.php');

    }

    public function login()
    {
        $email = $_POST['usuario'];
      //  setcookie('emailLogin', $email, time() + 600);
        $usuario = Usuario::buscarEmail($email);

        if ( $usuario && $usuario->verificarSenha($_POST['senha']) ) {
            DW3Sessao::set('usuario', $usuario);

            $this->redirecionar(URL_RAIZ . 'questao');


        } else {
            $this->setErros(['login' => 'Usuário ou senha inválido.']);

            $this->visao('login/index.php');

        }


    }

    public function loginViaApi()
    {
        header('Content-Type: application/json');
        $json = file_get_contents('php://input');
        $obj = json_decode($json, true);
        $usuarioTemp = $obj["usuario"];


        $email = $usuarioTemp["email"];
        $senha = $usuarioTemp["senha"];




        $usuario = Usuario::buscarEmail($email);

        if ( $usuario && $usuario->verificarSenha($senha) ) {
            DW3Sessao::set('usuario', $usuario);

            header('HTTP/1.1 200 Accepted');
            $json = '{"title": "Accepted", "Status": ' . 200 . '}';
            print_r($json);


        } else {
            $erro = ['login' => 'Usuário ou senha inválido.'];


            $json = '{"title": "Unprocessable Entity",
          "Status":' . 422 . ', "erros":' . json_encode($erro) . '}';


            header('HTTP/1.1 402 Unprocessable Entity');
            print_r($json);


        }


    }

}
