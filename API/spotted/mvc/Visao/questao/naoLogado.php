<h1 class="hide">questoes_nao_logado</h1>


<div class="col offset-s3 s6  offset-m3 m6 ">
    <div class="card  darken-1 z-depth-3">
        <div class="card-content">
            <div class="row center"><h2>Questões recentes</h2></div>
            <div class="row">


                <?php if ($questoes) : ?>
                    <?php foreach ($questoes as $questao): ?>


                        <div class="col s12 m6">
                            <div class="card">
                                <div class="card-image">
                                    <img class="imagensQuest responsive-img "
                                         src="<?= URL_IMG . $questao->getImagem() ?>">
                                    <span class="card-title tituloCard"><?php echo $questao->getTitulo() ?></span>
                                </div>


                                <div class="card-content">
                                    <p>
                                        <?php echo $questao->getDescricao() . "<hr>";
                                        echo 'Acertos: ' . $questao->getQuantidadeAcertos($questao->getId()) . "<hr>";
                                        echo 'Erros: ' . $questao->getQuantidadeErros($questao->getId()) . "<hr>";
                                        echo 'Autor: ' . $questao->getNomeUsuario() . "<hr>";
                                        echo 'Dificuldade: ' . $questao->getDificuldade();
                                        ?>
                                    </p>
                                </div>


                            </div>
                        </div>


                    <?php endforeach ?>
                <?php else: ?>

                    <div class="col s12 m12">
                        <div class="card blue-grey darken-1">
                            <div class="card-content white-text">
                                <span class="card-title">Ops....</span>
                                <p>Me desculpe, mas... não temos questões para responder!
                                    Porém poderá criar diversas questões para seus amigos possam responder! 😉</p>
                            </div>

                        </div>
                    </div>


                <?php endif; ?>


            </div>

        </div>
        <div class="row center">
            <div class="row">
                <?php if ($pagina > 1) : ?>

                    <img class="icons-buttons" src="<?= URL_IMG . 'icons/esquerda.svg' ?>">
                    <a href="<?= URL_RAIZ . 'questao_nao_logado?p=' . ($pagina - 1) ?>" class="btn btn-default">Página
                        anterior</a>
                <?php endif ?>
                <?php if ($pagina < $ultimaPagina) : ?>
                    <a href="<?= URL_RAIZ . 'questao_nao_logado?p=' . ($pagina + 1) ?>" class="btn btn-default">Próxima
                        página</a>
                    <img class="icons-buttons" src="<?= URL_IMG . 'icons/direita.svg' ?>">
                <?php endif ?>
            </div>
        </div>
    </div>
</div>

