<h1 class="hide">responder</h1>

<?php if (isset($flash)) : ?>
    <?php if (isset($valores)) : ?>
        <?php if ($valores['resultado']) {
            echo '
                <div class="div_teste circle">
                    <div class="img_yes circle">
                
                    </div>
                </div>';
        } else {
            echo '
                <div class="div_teste circle">
                    <div class="img_no circle">
                
                    </div>
                </div>';

        }


        ?>
    <?php endif; ?>
<?php endif; ?>

<div class="col offset-s3 s6  offset-m3 m6 ">
    <div class="card  darken-1 z-depth-3">
        <div class="card-content">

            <div class="row">
                <div class="col s12 m12 center"><h3>Responde se for capaz! <span class="emoj">😎 </span></h3></div>
            </div>


            <div class="row center">
                <div class="col s12 m12 center">
                    <form action="<?= URL_RAIZ . 'questao/responderPagina' ?>" method="get"
                          class="form-inline pull-left">

                        <?php $this->incluirVisao('util/select.php', []) ?>
                        <button type="submit" class="btn btn-primary center-block largura100">Filtrar</button>

                    </form>
                </div>
            </div>


            <div class="row">


                    <?php if ($questoes) : ?>
                    <?php foreach ($questoes

                    as $questao): ?>


                    <div class="col s12 m6 corpo ">
                        <?php if ($questao->getAtributosQuestRespondida()) {
                            echo '<div class="card ">';
                        } else {
                            echo '<div class="card hoverable">';
                        } ?>


                        <div class="card-image">
                            <img class="imagensQuest responsive-img "
                                 src="<?= URL_IMG . $questao->getImagem() ?>">
                            <span class="card-title tituloCard"><?php echo $questao->getTitulo() ?></span>
                        </div>


                        <?php if ($valores['id_quest'] == $questao->getId()) : ?>
                            <?php if ($flash) : ?>
                                <div class="animated jackInTheBox faster delay-1s">
                                    <div class="card-panel teal lighten-2 center text-darken-2">
                                        <?= $flash ?>
                                    </div>
                                </div>
                            <?php endif ?>
                        <?php endif ?>


                        <div class="card-content">

                            <h5 class="">
                                <?php echo $questao->getDescricao() . "<hr>"; ?>
                            </h5>
                            <p class="<?= $questao->getDificuldade() ?>"><?= $questao->getDificuldade() ?></p>
                        </div>

                        <?php if ($questao->getAtributosQuestRespondida()) : ?>
                            <div class="card-content">

                                <?php
                                $array = $questao->getAtributosQuestRespondida();


                                if ($array['acertou']) {
                                    echo "<p class='certo'>Você acertou esta questão <span class='emoj'>😉</span></p>";
                                    echo "<p>Alternativa que você selecionou:<b> " . $array['alternativa'] . "</b></p>";
                                    echo "<p>Alternativa Correta:<b> " . $array['alternativa'] . "</b></p>";;

                                } else {
                                    echo "<p>Você errou está questão <span class='emoj'>😐</span></p>";
                                    echo "<p>Alternativa que você selecionou: <b>" . $array['alternativa'] . "</b></p>";
                                    echo "<p>Alternativa Correta:<b> " . $questao->getAlternativaCorreta() . "</b></p>";

                                }
                                echo "Data da sua resposta: <b> " . date('d/m/Y H:i:s', strtotime($array['data_resposta']));
                                echo "</b><p>Dificuldade:<b> " . $questao->getDificuldade() . "</b></p>";
                                ?>
                            </div>

                        <?php else : ?>
                            <ul class="collapsible">
                                <li>


                                    <div class="collapsible-header"><i class="material-icons"><img class="icom-menu"
                                                                                                   src="<?= URL_IMG . 'icons/edit.svg' ?>"></i>Responder
                                    </div>
                                    <div class="collapsible-body">


                                        <form action="<?= URL_RAIZ . 'questao/responderPagina' ?>" method="post">

                                            <input type="hidden" name="id_quest"
                                                   value="<?php echo $questao->getId() ?>">


                                            <input type="hidden" name="pagina" value="<?php echo $pagina ?>">

                                            <?php
                                            $arrays = $questao->buscarPorIdAlternativas($questao->getId());

                                            foreach ($arrays as $alternativa)  : ?>

                                                <p>
                                                    <label>
                                                        <input name="alternativaCorreta"
                                                               value="<?php echo $alternativa ?>" type="radio"/>
                                                        <span>  <?php echo $alternativa ?></span>
                                                    </label>
                                                </p>
                                                <br>
                                                <hr>

                                            <?php endforeach ?>
                                            <div class="center">
                                                <button class="btn waves-effect waves-light" type="submit"
                                                        name="action">Salvar
                                                    <i class="material-icons right"><img class="icom-menu"
                                                                                         src="<?= URL_IMG . 'icons/send.svg' ?>"></i>
                                                </button>
                                            </div>

                                        </form>
                                    </div>
                                </li>
                            </ul>
                        <?php endif; ?>
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

        <div class="row center">
            <?php if ($pagina > 1) : ?>
                 <img class="icons-buttons" src="<?= URL_IMG . 'icons/esquerda.svg' ?>">

                <a href="<?= URL_RAIZ . 'questao/responderPagina?p=' . ($pagina - 1) ?>" class="btn btn-default">Página
                    anterior</a>
            <?php endif ?>
            <?php if ($pagina < $ultimaPagina) : ?>
                <a href="<?= URL_RAIZ . 'questao/responderPagina?p=' . ($pagina + 1) ?>" class="btn btn-default">Próxima
                    página</a>
                 <img class="icons-buttons" src="<?= URL_IMG . 'icons/direita.svg' ?>">

            <?php endif ?>
        </div>


    </div>
</div>
