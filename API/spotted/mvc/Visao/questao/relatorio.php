<h1 class="hide">relatorio</h1>


<div class="col offset-s3 s6  offset-m3 m6 ">
    <div class="card  darken-1 z-depth-3">
        <div class="card-content">
            <div class="row">
                <h4 class="center">Relatório de Questões</h4>


                <div class="col s12 m12 center">


                    <form action="<?= URL_RAIZ . 'questao/relatorioPagina' ?>" method="get"
                          class="form-inline pull-left">

                        <?php $this->incluirVisao('util/select.php', []) ?>
                        <button type="submit" class="btn btn-primary center-block largura100">Filtrar</button>

                    </form>

                </div>


                <?php

                if ( (($relatorio['acertos']->getId() != null) && ($relatorio['erros']->getId() != null)) ): ?>


                    <?php
                    $acertos = $relatorio['acertos'];
                    $erros = $relatorio['erros'];
                    ?>

                    <?php if ( $acertos->getQuantidadeAcertos($acertos->getId()) > 0 ) : ?>

                        <div class="col s12 m6">
                            <div class="card">

                                <div class="card-image">
                                    <img class="imagensQuest responsive-img "
                                         src="<?= URL_IMG . $acertos->getImagem() ?>">
                                    <span class="card-title tituloCard"><?php echo $acertos->getTitulo() ?></span>
                                </div>


                                <div class="card-content">
                                    <p>
                                        <?php echo '<h5>' . $acertos->getDescricao() . "<h5><hr>";
                                        echo '<h5> A que povo mais acertou! 😎 </h5>';

                                        echo "<h5>Acertos: " . $acertos->getQuantidadeAcertos($acertos->getId()) . "</h5>";

                                        echo "<h5>Erros: " . $acertos->getQuantidadeErros($acertos->getId()) . "</h5>";
                                        echo " <p class=" . $acertos->getDificuldade() . ">" . $acertos->getDificuldade() . '</p>';

                                        ?>
                                    </p>
                                </div>
                                <?php $usuario = \Framework\DW3Sessao::get("usuario");

                                if ( $usuario->getId() != $acertos->getUsuarioId() ) : ?>
                                    <?php if ( $acertos->getEstaRespondida($usuario->getId(), $acertos->getId()) ) : ?>

                                        <div class="card-content">

                                            <?php
                                            $array = $acertos->getEstaRespondida($usuario->getId(), $acertos->getId());

                                            if ( $array['acertou'] ) {
                                                echo "<p class='certo'>Você acertou esta questão <span class='emoj'>😉</span></p>";
                                                echo "<p>Alternativa Correta:<b> " . $array['alternativa'] . "</b></p>";;

                                            } else {
                                                echo "<p>Você errou está questão <span class='emoj'>😐</span></p>";
                                                echo "<p>Alternativa Correta:<b> " . $acertos->getAlternativaCorreta() . "</b></p>";
                                                echo "<p>Alternativa que você selecionou:<b> " . $array['alternativa'] . "</b></p>";

                                            }
                                            echo "Data da sua resposta: <b> " . date('d/m/Y', strtotime($array['data_resposta']));
                                            echo "</b><p>Dificuldade:<b> " . $acertos->getDificuldade() . "</b></p>";
                                            ?>
                                        </div>

                                    <?php else : ?>
                                        <ul class="collapsible">
                                            <li>
                                                <div class="collapsible-header"><i class="material-icons right"><img
                                                                class="icons-menu"
                                                                src="<?= URL_IMG . 'icons/edit.svg' ?>"></i>Responder
                                                </div>
                                                <div class="collapsible-body">


                                                    <form action="<?= URL_RAIZ . 'questao/responderPagina' ?>"
                                                          method="post">

                                                        <input type="hidden" name="id_quest"
                                                               value="<?php echo $acertos->getId() ?>">


                                                        <?php
                                                        $arrays = $acertos->buscarPorIdAlternativas($acertos->getId());

                                                        foreach ($arrays as $alternativa)  : ?>

                                                            <p>
                                                                <label>
                                                                    <input name="alternativaCorreta"
                                                                           value="<?php echo $alternativa ?>"
                                                                           type="radio"/>
                                                                    <span>  <?php echo $alternativa ?></span>
                                                                </label>
                                                            </p>
                                                            <br>
                                                            <hr>

                                                        <?php endforeach ?>
                                                        <div class="center">
                                                            <button class="btn waves-effect waves-light"
                                                                    name="action">Salvar
                                                                <i class="material-icons right"> <img
                                                                            class="icons-buttons"
                                                                            src="<?= URL_IMG . 'icons/send.svg' ?>">

                                                                </i></button>
                                                        </div>

                                                    </form>
                                                </div>
                                            </li>
                                        </ul>
                                    <?php endif; ?>
                                <?php else: ?>
                                    <div class="row"><h5 class="center">Sua questão!</h5></div>

                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endif; ?>


                    <?php if ( $erros->getQuantidadeErros($erros->getId()) > 0 ) : ?>

                        <div class="col s12 m6">
                            <div class="card">

                                <div class="card-image">
                                    <img class="imagensQuest responsive-img "
                                         src="<?= URL_IMG . $erros->getImagem() ?>">
                                    <span class="card-title tituloCard"><?php echo $erros->getTitulo() ?></span>
                                </div>


                                <div class="card-content">

                                    <?php echo '<h5>' . $erros->getDescricao() . "</h5><hr>";
                                    echo '<h5> A que povo mais errou! 😥 </h5>';
                                    echo "<h5>Acertos: " . $erros->getQuantidadeAcertos($erros->getId()) . "</h5>";
                                    echo "<h5>Erros: " . $erros->getQuantidadeErros($erros->getId()) . "</h5>";
                                    echo " <p class=" . $erros->getDificuldade() . ">" . $erros->getDificuldade() . '</p>';
                                    ?>


                                </div>

                                <?php $usuario = \Framework\DW3Sessao::get("usuario");

                                if ( $usuario->getId() != $erros->getUsuarioId() ) : ?>

                                    <?php
                                    if ( $erros->getEstaRespondida($usuario->getId(), $erros->getId()) ) : ?>

                                        <div class="card-content">

                                            <?php
                                            $array = $erros->getEstaRespondida($usuario->getId(), $erros->getId());


                                            if ( $array['acertou'] ) {
                                                echo "<p class='certo'>Você acertou esta questão <span class='emoj'>😉</span></p>";
                                                echo "<p>Alternativa Correta:<b> " . $array['alternativa'] . "</b></p>";;

                                            } else {
                                                echo "<p>Você errou está questão <span class='emoj'>😐</span></p>";
                                                echo "<p>Alternativa Correta:<b> " . $erros->getAlternativaCorreta() . "</b></p>";
                                                echo "<p>Alternativa que você selecionou:<b> " . $array['alternativa'] . "</b></p>";


                                            }
                                            echo "Data da sua resposta: <b> " . date('d/m/Y ', strtotime($array['data_resposta']));
                                            echo "</b><p>Dificuldade:<b> " . $erros->getDificuldade() . "</b></p>";
                                            ?>
                                        </div>

                                    <?php else : ?>


                                        <ul class="collapsible">
                                            <li>
                                                <div class="collapsible-header"><i class="material-icons right"><img
                                                                class="icons-menu"
                                                                src="<?= URL_IMG . 'icons/edit.svg' ?>"></i>Responder
                                                </div>
                                                <div class="collapsible-body">


                                                    <form action="<?= URL_RAIZ . 'questao/responderPagina' ?>"
                                                          method="post">

                                                        <input type="hidden" name="id_quest"
                                                               value="<?php echo $erros->getId() ?>">

                                                        <?php
                                                        $arrays = $erros->buscarPorIdAlternativas($erros->getId());

                                                        foreach ($arrays as $alternativa)  : ?>

                                                            <p>
                                                                <label>
                                                                    <input name="alternativaCorreta"
                                                                           value="<?php echo $alternativa ?>"
                                                                           type="radio"/>
                                                                    <span>  <?php echo $alternativa ?></span>
                                                                </label>
                                                            </p>
                                                            <br>


                                                        <?php endforeach ?>
                                                        <div class="center">
                                                            <button class="btn waves-effect waves-light" type="submit"
                                                                    name="action">Salvar
                                                                <i class="material-icons right"> <img
                                                                            class="icons-buttons"
                                                                            src="<?= URL_IMG . 'icons/send.svg' ?>">

                                                                </i></button>
                                                        </div>

                                                    </form>
                                                </div>
                                            </li>
                                        </ul>

                                    <?php endif; ?>
                                <?php else: ?>
                                    <h5 class="center">Sua questão!</h5>

                                <?php endif; ?>

                            </div>
                        </div>

                    <?php endif; ?>


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
    </div>
</div>