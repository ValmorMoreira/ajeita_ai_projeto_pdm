<?php

namespace Controlador;

use Framework\DW3Sessao;
use \Modelo\Usuario;

class UsuarioControlador extends Controlador
{

    private $errors = ['erros' => 'Foram encontrado alguns erros'];
    private $haErros = false;

    public function index()
    {

        $this->visao('cadastroUsuario/index.php');

    }

    public function armazenar()
    {


        $nome = $_POST['nome'];
        $sobrenome = $_POST['sobrenome'];
        $senha = $_POST['senha'];
        $senha1 = $_POST['senha1'];
        $email = $_POST['email'];


        $foto = array_key_exists('foto', $_FILES) ? $_FILES['foto'] : null;

        $usuario = new Usuario($nome, $sobrenome, $email, $senha, $senha1, null, $foto);

        if ($usuario->isValido()) {
            $usuario->salvar();
            DW3Sessao::set('usuario', $usuario);
            $this->redirecionar('questao');

        } else {

            $this->setErros($usuario->getValidacaoErros());
            $this->visao('cadastroUsuario/index.php', [
                'nome' => $nome,
                'sobrenome' => $sobrenome,
                'email' => $email
            ]);

        }


    }

    public function armazenarApi()
    {

        header('Content-Type: application/json');
        $json = file_get_contents('php://input');
        $obj = json_decode($json, true);
        $usuarioTemp = $obj["usuario"];

        @$nome = $usuarioTemp["nome"];
        @$sobrenome = $usuarioTemp["sobrenome"];
        @$senha = $usuarioTemp["senha"];
        @$senha1 = $usuarioTemp["senha1"];
        @$email = $usuarioTemp["email"];
        @$img = $usuarioTemp["img"];


        $foto = array_key_exists('foto', $_FILES) ? $_FILES['foto'] : null;

        $usuario = new Usuario($nome, $sobrenome, $email, $senha, $senha1, null, $foto);

        if ($usuario->isValido()) {
            $usuario->salvar();

            DW3Sessao::set('usuario', $usuario);

            $nome = $usuario->getNome();
            $sobrenome = $usuario->getSobrenome();
            $email = $usuario->getEmail();
            $imagem = $usuario->getImagem();
            $id = $usuario->getId();

//            echo $nome;
//            echo $sobrenome;
//            echo $email;
//            echo $imagem;
//            echo $id;

            header('HTTP/1.1 200 Accepted');
            $json = '{"title": "Accepted", "Status": ' . 200 . ','
                . '"usuario": {' .
                '"nome":"' . $nome . '",' .
                '"sobrenome": "' . $sobrenome . '",' .
                '"email" :"' . $email . '",' .
                '"imagem" :"' . $imagem . '",' .
                '"id" :"' . $id . '"  }' .
                ' }';
            print_r($json);

        } else {

            $this->setErros($usuario->getValidacaoErros());
            $erros = $usuario->getValidacaoErros();

            $json = '{ "title": "Unprocessable Entity", "Status":' . 422 . ', "erros":' . json_encode($erros) . '}';


            header('HTTP / 1.1 402 Unprocessable Entity');
            print_r($json);


        }


    }

    public function atualizaApi()
    {

        header('Content-Type: application/json');
        $json = file_get_contents('php://input');

        $obj = json_decode($json, true);
        $usuarioTemp = $obj["usuario"];


        @$nome = $usuarioTemp["nome"];
        @$sobrenome = $usuarioTemp["sobrenome"];
        @$senha = $usuarioTemp["senha"];
        @$senha1 = $usuarioTemp["senha1"];
        @$email = $usuarioTemp["email"];
        @$img = $usuarioTemp["img"];
        @$id = $usuarioTemp["id"];



        $foto = array_key_exists('foto', $_FILES) ? $_FILES['foto'] : null;

        $usuario = new Usuario($nome, $sobrenome, $email, $senha, $senha1, null, $foto);

        if ($usuario->isValidoAtualiza()) {
            $usuario->atualizar($nome, $sobrenome, $senha, $id);

            DW3Sessao::set('usuario', $usuario);



            $nome = $usuario->getNome();
            $sobrenome = $usuario->getSobrenome();
            $email = $usuario->getEmail();
            $imagem = $usuario->getImagem();


            header('HTTP/1.1 200 Accepted');
            $json = '{"title": "Accepted", "Status": ' . 200 . ','
                . '"usuario": {' .
                '"nome":"' . $nome . '",' .
                '"sobrenome": "' . $sobrenome . '",' .
                '"email" :"' . $email . '",' .
                '"imagem" :"' . $imagem . '",' .
                '"id" :"' . $id . '"  }' .
                ' }';
            print_r($json);

        } else {

            $this->setErros($usuario->getValidacaoErros());
            $erros = $usuario->getValidacaoErros();

            $json = '{"title": "Unprocessable Entity",
          "Status":' . 422 . ', "erros":' . json_encode($erros) . '}';


            header('HTTP/1.1 402 Unprocessable Entity');
            print_r($json);


        }


    }


}
