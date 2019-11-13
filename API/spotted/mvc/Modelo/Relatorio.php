<?php

namespace Modelo;

use \PDO;
use \Framework\DW3BancoDeDados;
use \Framework\DW3ImagemUpload;


class Relatorio extends Modelo
{


    const  BUSCAR_MAIS_ACERTO = 'SELECT * FROM (select * from questoes where dificuldade = ?  order by quantidade_acerto desc )DATAIN LIMIT 1; ';
    const  BUSCAR_MAIS_ERRO = 'SELECT * FROM (select * from questoes where dificuldade = ?  order by quantidade_erro desc )DATAIN LIMIT 1;';


    public static function filtroCategoria($categoria = [])
    {

        if (!(isset($categoria['select']))) {
            $categoria = ['select' => 'facil'];
        }

        $comando = DW3BancoDeDados::prepare(self::BUSCAR_MAIS_ACERTO);
        $comando->bindValue(1, $categoria['select'], PDO::PARAM_STR);
        $comando->execute();

        $registro = $comando->fetch();


        $acertos = new Questao(

            $registro['id_usuario'],
            $registro['id_usuario'],
            $registro['titulo'],
            $registro['descricao'],
            $registro['dificuldade'],
            $registro['alternativa_correta'],
            null,
            null,
            $registro['id_questao']
        );


        $comando = DW3BancoDeDados::prepare(self::BUSCAR_MAIS_ERRO);
        $comando->bindValue(1, $categoria['select'], PDO::PARAM_STR);
        $comando->execute();
        $registro = $comando->fetch();

        $erros = new Questao(

            $registro['id_usuario'],
            $registro['id_usuario'],
            $registro['titulo'],
            $registro['descricao'],
            $registro['dificuldade'],
            $registro['alternativa_correta'],
            null,
            null,
            $registro['id_questao']
        );


        $objetos = [
            'acertos' =>$acertos ,
            'erros' => $erros
        ];

        return $objetos;
    }


}
