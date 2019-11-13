<?php

namespace Teste\Unitario;

use \Teste\Teste;
use \Modelo\Usuario;
use \Framework\DW3BancoDeDados;


class TesteQuestao extends Teste
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
      //  print_r($resultado);
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


}
