<?php
namespace Teste\Funcional;

use \Teste\Teste;
use \Modelo\Mensagem;
use \Framework\DW3BancoDeDados;

class TesteRaiz extends Teste
{
    public function testeAcessar()
    {
        $resposta = $this->get(URL_RAIZ);
        $this->verificarContem($resposta, 'home');



    }
}
