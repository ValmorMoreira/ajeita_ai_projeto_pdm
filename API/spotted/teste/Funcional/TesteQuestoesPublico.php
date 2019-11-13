<?php

namespace Teste\Funcional;

use Framework\DW3Sessao;
use \Teste\Teste;
use \Modelo\Usuario;
use \Framework\DW3BancoDeDados;

class TesteQuestoesPublico extends Teste
{




    public function testeMinhasQuestoesPagina()
    {


        $resposta = $this->get(URL_RAIZ . 'questao_nao_logado');

        $this->verificarContem($resposta, 'questoes_nao_logado');

    }







}
