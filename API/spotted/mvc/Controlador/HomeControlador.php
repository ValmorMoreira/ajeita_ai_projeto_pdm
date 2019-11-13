<?php
namespace Controlador;

use \Modelo\Mensagem;

class HomeControlador extends Controlador
{
    public function index()
    {
         $this->visao('home/index.php');
    }


}
