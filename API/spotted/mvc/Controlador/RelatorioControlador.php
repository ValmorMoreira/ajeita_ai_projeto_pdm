<?php

namespace Controlador;

use Framework\DW3Sessao;
use \Modelo\Mensagem;
use Modelo\Questao;
use Modelo\Relatorio;

class RelatorioControlador extends Controlador
{
    public function index()
    {

        $usuario = DW3Sessao::get('usuario');


        if ($usuario) {

            $relatorio = Relatorio::filtroCategoria($_GET);
            $this->visao('questao/relatorio.php', [
                'relatorio' => $relatorio,
            ], 'logado.php');

        } else {
            $this->redirecionar(URL_RAIZ . 'login');

        }

    }




}
