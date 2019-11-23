<?php

namespace Modelo;

use Framework\DW3ImagemUpload;
use \PDO;
use \Framework\DW3BancoDeDados;

class Usuario extends Modelo
{
    const BUSCAR_TODOS = 'SELECT * FROM usuarios ';
    const INSERIR = 'INSERT INTO usuarios(nome, sobrenome, email, senha) VALUES (?, ? , ? , ?)';
    const ATUALIZAR = 'UPDATE usuarios set nome = ? , sobrenome = ? , senha = ?  where id_usuario = ?';
    const BUSCAR_POR_EMAIL = 'SELECT * FROM usuarios WHERE email = ? LIMIT 1';
    const CONTAR_ACERTOS = 'select count(acertou) from respostas where id_usuario = ?  and acertou = 1';
    const CONTAR_ERROS = 'select count(acertou) from respostas where id_usuario = ?  and acertou = 0';

    private $id;
    private $nome;
    private $sobrenome;
    private $email;
    private $acertos;
    private $erros;
    private $senha;
    private $senhaCripto;
    private $img;

    public function __construct(
        $nome,
        $sobrenome,
        $email,
        $senha,
        $senha1,
        $id = null,
        $img

    )
    {
        $this->nome = $nome;
        $this->sobrenome = $sobrenome;
        $this->email = $email;
        $this->senha = $senha;
        $this->senha1 = $senha1;
        $this->id = $id;
        $this->senhaCripto = password_hash($senha, PASSWORD_BCRYPT);
        $this->img = $img;
    }



    public function inserir()
    {


        DW3BancoDeDados::getPdo()->beginTransaction();
        $comando = DW3BancoDeDados::prepare(self::INSERIR);
        $comando->bindValue(1, $this->nome, PDO::PARAM_STR);
        $comando->bindValue(2, $this->sobrenome, PDO::PARAM_STR);
        $comando->bindValue(3, $this->email, PDO::PARAM_STR);
        $comando->bindValue(4, $this->senhaCripto, PDO::PARAM_STR);
        $comando->execute();
        $this->id = DW3BancoDeDados::getPdo()->lastInsertId();
        DW3BancoDeDados::getPdo()->commit();
    }




    public function atualizar($nome,$sobrenome,$senha , $id)
    {

        //const ATUALIZAR = 'UPDATE usuarios set nome = ? , sobrenome = ? , senha = ?  where id_usuario = ?;';
        DW3BancoDeDados::getPdo()->beginTransaction();
        $comando = DW3BancoDeDados::prepare(self::ATUALIZAR);


        $senhaCripto = password_hash($senha, PASSWORD_BCRYPT);


        $comando->bindValue(1, $nome, PDO::PARAM_STR);
        $comando->bindValue(2, $sobrenome, PDO::PARAM_STR);
        $comando->bindValue(3, $senhaCripto, PDO::PARAM_STR);
        $comando->bindValue(4, $id, PDO::PARAM_INT);



        $comando->execute();
        DW3BancoDeDados::getPdo()->commit();



    }



    public static function buscarEmail($email)
    {
        $comando = DW3BancoDeDados::prepare(self::BUSCAR_POR_EMAIL);
        $comando->bindValue(1, $email, PDO::PARAM_STR);
        $comando->execute();
        $objeto = null;
        $registro = $comando->fetch();
        if ( $registro ) {
            $objeto = new Usuario(
                $registro['nome'],
                $registro['sobrenome'],
                $registro['email'],
                null,
                null,
                $registro['id_usuario'],
                null
            );
            $objeto->senha = $registro['senha'];
            $objeto->id = $registro['id_usuario'];
        }

        return $objeto;
    }

    public function verificarSenha($senhaPlana)
    {

        return password_verify($senhaPlana, $this->senha);

    }

    public static function buscarTodos()
    {
        $registros = DW3BancoDeDados::query(self::BUSCAR_TODOS);
        $objetos = [];
        foreach ($registros as $registro) {
            array_push($objetos, array(
                'nome' => $registro['nome'],
                'sobrenome' => $registro['sobrenome'],
                'email' => $registro['email']
            ));

        }


        return $objetos;
    }


    public function salvar()
    {
        $this->inserir();
        $this->salvarImagem();
    }


    public function getImagem()
    {
        $img = "$this->id .png";
        if ( !DW3ImagemUpload::existe($img) ) {
            $img = 'login.png';
        }
        return $img;
    }


    private function salvarImagem()
    {

        if ( DW3ImagemUpload::isValida($this->img) ) {
            $nomeCompleto = PASTA_PUBLICO . "img/$this->id .png";
            DW3ImagemUpload::salvar($this->img, $nomeCompleto);
        }
    }

    protected function verificarErros()
    {

        //Verifica o tamanho do nome
        if ( !$this->verificaTamanhoString($this->nome, 2) ) {
            $this->insereError('nome');
        }
        //Verifica o tamanho do sobrenome
        if ( !$this->verificaTamanhoString($this->sobrenome, 4) ) {
            $this->insereError('sobrenome');
        }
        //Verifica email
        if ( !preg_match('/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/', $this->email) ) {
            $this->insereError('emailInvalido');
        }
        //Verifica Nome correto
        if ( !$this->verificaLetrasString($this->nome) ) {
            $this->insereError('nomeInvalido');
        }
        //Verifica Sobrenome Correto
        if ( !$this->verificaLetrasString($this->sobrenome) ) {
            $this->insereError('sobrenomeInvalido');
        }


        //Verifica o tamanho da senha
        if ( $this->verificaTamanhoString($this->senha, 8) ) {

            //Verificando se as senhas confere uma com a outra
            if ( !($this->senha === $this->senha1) ) {

                $this->insereError('senhaDif');

            }

        } else {
            $this->insereError('senha');
            $this->insereError('senha1');

        }


        if ( !$this->verificaTamanhoString($this->email, 8) ) {

            $this->insereError('email');

        }

        $array = self::buscarEmail($this->email);
        if ( $array ) {
            $this->insereError('emailexistente');
        }


    }

    protected function verificarErrosAtuliza()
    {

        //Verifica o tamanho do nome
        if ( !$this->verificaTamanhoString($this->nome, 2) ) {
            $this->insereError('nome');
        }
        //Verifica o tamanho do sobrenome
        if ( !$this->verificaTamanhoString($this->sobrenome, 4) ) {
            $this->insereError('sobrenome');
        }
        //Verifica email
        if ( !preg_match('/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/', $this->email) ) {
            $this->insereError('emailInvalido');
        }
        //Verifica Nome correto
        if ( !$this->verificaLetrasString($this->nome) ) {
            $this->insereError('nomeInvalido');
        }
        //Verifica Sobrenome Correto
        if ( !$this->verificaLetrasString($this->sobrenome) ) {
            $this->insereError('sobrenomeInvalido');
        }


        //Verifica o tamanho da senha
        if ( $this->verificaTamanhoString($this->senha, 8) ) {

            //Verificando se as senhas confere uma com a outra
            if ( !($this->senha === $this->senha1) ) {

                $this->insereError('senhaDif');

            }

        } else {
            $this->insereError('senha');
            $this->insereError('senha1');

        }


        if ( !$this->verificaTamanhoString($this->email, 8) ) {

            $this->insereError('email');

        }




    }

    private function verificaLetrasString($string)
    {
        $resultado = preg_match('/^[a-zA-Zà-úÀ-ú ]*$/',$string , $teste);

        if ( $teste ) {


            return true;
        } else {

            return false;
        }

    }

    private function verificaTamanhoString($palavra, $tamanho)
    {
        return strlen($palavra) >= $tamanho;

    }


    private function insereError($campo)
    {
        switch ($campo) {
            case "nome" :
                $this->setErroMensagem('nome', 'O nome deve conter mais que 2 letras!');
                break;
            case  "sobrenome":
                $this->setErroMensagem('sobrenome', 'O sobrenome deve conter mais que 5 letras!');
                break;
            case  "senha":
                $this->setErroMensagem('senha', 'A senha deve conter no minimo 8 caracteres!');
                break;
            case  "senha1":
                $this->setErroMensagem('senha1', 'A senha deve conter no minimo 8 caracteres!');
                break;
            case  "email":
                $this->setErroMensagem('email', 'O email deve conter mais caracteres!');
                break;
            case  "senhaDif":
                $this->setErroMensagem('conf', 'As senhas estão diferente!');
                break;
            case  "emailexistente":
                $this->setErroMensagem('email', 'Ops, acho que você já é cadastrado em nosso sistema!');
                break;
            case  "emailInvalido":
                $this->setErroMensagem('email', 'Eita, acho que você inseriu um email que não é um email!');
                break;
            case  "nomeInvalido":
                $this->setErroMensagem('nome', 'Oxi, eu desconfio que seu nome esteja errado, somente letras é permitido');
                break;
            case  "sobrenomeInvalido":
                $this->setErroMensagem('sobrenome', 'Óia, eu desconfio que seu sobrenome esteja errado, somente letras é permitido');
                break;
        }


    }


    public function getId()
    {
        return $this->id;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getSenha()
    {
        return $this->senha;
    }

    public function getNome()
    {
        return $this->nome;
    }



    public function getSobrenome()
    {
        return $this->sobrenome;
    }

    public function getImg()
    {
        return $this->img;
    }

    public function setImg($img): void
    {
        $this->img = $img;
    }


    public function getAcertos()
    {


        $comando = DW3BancoDeDados::prepare(self::CONTAR_ACERTOS);
        $comando->bindValue(1, $this->id, PDO::PARAM_STR);
        $comando->execute();
        $registro = $comando->fetch();
        $this->acertos = $registro[0];
        return $this->acertos;
    }


    public function getErros()
    {
        $comando = DW3BancoDeDados::prepare(self::CONTAR_ERROS);
        $comando->bindValue(1, $this->id, PDO::PARAM_STR);
        $comando->execute();
        $registro = $comando->fetch();
        $this->erros = $registro[0];

        return $this->erros;
    }


}
