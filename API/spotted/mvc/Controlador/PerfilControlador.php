<?php
namespace Controlador;

use \Modelo\Usuario;
use \Framework\DW3Sessao;

class PerfilControlador extends Controlador
{
    public function index()
    {

        var_dump(DW3Sessao::get('usuario'));
    $this->visao('perfil/index.php');

    }



}
