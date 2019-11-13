<h1 class="hide">minhas_questoes</h1>

<?php


if (isset($dados['flash'])) : ?>
    <?php if ($dados['flash']) {
        echo '
                <div class="div_teste circle">
                    <div class="animated zoomOutUp faster delay-5s img_no circle">
                    </div>
                </div>
                <div class="animated zoomOutUp faster delay-5s erro">
                      <div class="card-panel teal lighten-2 center text-darken-2">
                        <p>' . $dados['flash'] . '</p>
                      </div>
                </div>
                
                ';
    } ?>
<?php endif; ?>


<?php

if (isset($flash)) : ?>

    <div class="div_teste circle ">
        <div class="animated zoomOutUp faster delay-5s img_yes circle">
        </div>
    </div>
    <div class="animated zoomOutUp faster delay-5s erro">
        <div class="card-panel teal lighten-2 center text-darken-2">
            <p><?php echo $flash ?></p>
        </div>
    </div>

<?php endif ?>


<div class="col offset-s3 s6  offset-m3 m6 ">
    <div class="card  darken-1 z-depth-3">
        <div class="card-content">
            <div class="row">
                <div class="col s12 m12 center"><h3>Suas Questões! <span class="emoj">😎 </span></h3></div>

            </div>
            <div class="row">
                <div class="row">

                    <?php if ($questoes) : ?>
                    <?php foreach ($questoes

                    as $questao) : ?>


                    <div class="col s12 m6  ">
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


                        <div class="card-content">
                            <h5> <?php echo $questao->getDescricao() . "<hr>"; ?> </h5>
                        </div>


                        <?php if ($questao->getAtributosQuestRespondida()) : ?>
                            <div class="card-content">

                                <h4>Dados da sua quest!</h4>
                                <p>Dificuldade:<b> <?php echo $questao->getDificuldade() ?> </b></p>
                                <p>Acertos: <b><?php echo $questao->getAcertos() ?> </b></p>
                                <p>Erros: <b><?php echo $questao->getErros() ?> </b></p>
                                <p>Alternativas: </p>
                                <hr>

                                <?php
                                $arrays = $questao->buscarPorIdAlternativas($questao->getId());
                                foreach ($arrays as $alternativa)  : ?>
                                    <p><b><?php echo $alternativa ?></b></p>
                                    <hr>
                                <?php endforeach ?>

                                <hr>
                                <p>Alternativa Correta: <b><?php echo $questao->getAlternativaCorreta() ?> </b></p>

                            </div>

                        <?php else : ?>


                            <ul class="collapsible">
                                <li>
                                    <div class="collapsible-header"><i class="material-icons"><img class="icons-menu" src="<?= URL_IMG . 'icons/delete.svg' ?>"></i>Deletar
                                        a
                                        sua questão para todo sempre
                                    </div>
                                    <div class="collapsible-body">

                                    <span>
                                        <p>Tem certeza que deseja excluir a sua quest?</p></span>
                                        <p>Após deletar será imposível recuperar!</p>
                                        <p>Pense bem no que está fazendo!</p>
                                        </span>
<br>

                                        <form action=" <?= URL_RAIZ . 'questao/minhasQuestoesPagina/' . $questao->getId() ?>"
                                              method="post">
                                            <div class="row center">
                                                <input type="hidden" name="_metodo" value="DELETE">
                                                <button type="submit" class=" btn waves-effect waves-light"
                                                        title="Deletar">Deletar
                                                    <i class="material-icons right"><img class="icons-buttons" src="<?= URL_IMG . 'icons/delete-branco.svg' ?>"></i>
                                                </button>
                                            </div>
                                        </form>

                                    </div>
                                </li>


                                <li>
                                    <div class="collapsible-header"><i class="material-icons"><img class="icons-menu" src="<?= URL_IMG . 'icons/edit.svg' ?>"></i>Editar</div>
                                    <div class="collapsible-body">


                                        <form action="<?= URL_RAIZ . 'questao/minhasQuestoesPagina' ?>" method="post">

                                            <input type="hidden" name="id_quest"
                                                   value="<?php echo $questao->getId() ?>">


                                            <input type="hidden" name="pagina" value="<?php echo $pagina ?>">



                                            <?php if (!isset($dados)) : ?>
                                                <h5 class="center">Edição da sua quest!</h5>
                                                <div class="input-field col m12 s12">
                                                    <input placeholder="O que é uma diagrama" id="titulo"
                                                           name="titulo"
                                                           onclick="M.toast({html: value+' Sempre é bom inserir um titulo que chame a atenção!'})"
                                                           type="text" value="<?php echo $questao->getTitulo() ?>"
                                                           class="validate">
                                                    <label for="first_name">Titulo da pergunta</label>
                                                </div>

                                            <?php else : ?>

                                                <?php if ($dados['idQuest'] === $questao->getId()): ?>
                                                    <h5 class="center">Edição da sua quest!</h5>
                                                    <div class="input-field col m12 s12">

                                                        <input placeholder="O que é uma diagrama"
                                                               value="<?php echo $dados['titulo'] ?>" id="titulo"
                                                               name="titulo"
                                                               onclick="M.toast({html: value+' Sempre é bom inserir um titulo que chame a atenção!'})"
                                                               type="text" class="validate">
                                                        <label for="first_name">Titulo da pergunta</label>

                                                        <?php


                                                        $this->incluirVisao('util/formErroEditar.php',
                                                            [
                                                                'campo' => 'titulo',
                                                                'erro' => $dados['erros']

                                                            ]); ?>

                                                    </div>


                                                <?php else: ?>
                                                    <h5 class="center">Edição da sua quest!</h5>
                                                    <div class="input-field col m12 s12">
                                                        <input placeholder="O que é uma diagrama" id="titulo"
                                                               name="titulo"
                                                               onclick="M.toast({html: value+' Sempre é bom inserir um titulo que chame a atenção!'})"
                                                               type="text"
                                                               value="<?php echo $questao->getTitulo() ?>"
                                                               class="validate">
                                                        <label for="first_name">Titulo da pergunta</label>
                                                    </div>
                                                <?php endif ?>
                                            <?php endif ?>


                                            <!---->


                                            <!-- inicio Imput descricao -->


                                            <?php if (!isset($dados)) : ?>

                                                <div class="input-field col m12 s12">
                                                <textarea class="materialize-textarea" name="descricao"
                                                          placeholder="Ex. teste" id="textarea1"
                                                          onclick="M.toast({html:  'Na descrição é recomendado sempre detalhar a sua questão, desta forma deixando bem mais compreensivo a questão!'})"><?= $questao->getDescricao() ?></textarea>
                                                    <label for="textarea1">Descrição da questão</label>
                                                </div>


                                            <?php else : ?>
                                                <?php if ($dados['idQuest'] === $questao->getId()): ?>

                                                    <div class="input-field col m12 s12">
                                                    <textarea id="descricao" name="descricao"
                                                              class="materialize-textarea"
                                                              onclick="M.toast({html:  'Na descrição é recomendado sempre detalhar a sua questão, desta forma deixando bem mais compreensivo a questão!'})"><?php echo $dados['descricao'] ?></textarea>
                                                        <label for="textarea1">Descrição da questão</label>
                                                        <?php


                                                        $this->incluirVisao('util/formErroEditar.php',
                                                            [
                                                                'campo' => 'descricao',
                                                                'erro' => $dados['erros']

                                                            ]); ?>

                                                    </div>

                                                <?php else: ?>

                                                    <div class="input-field col m12 s12">
                                                <textarea class="materialize-textarea" name="descricao"
                                                          placeholder="Ex. teste" id="textarea1"
                                                          onclick="M.toast({html:  'Na descrição é recomendado sempre detalhar a sua questão, desta forma deixando bem mais compreensivo a questão!'})"><?= $questao->getDescricao() ?></textarea>
                                                        <label for="textarea1">Descrição da questão</label>
                                                    </div>
                                                <?php endif ?>

                                            <?php endif ?>

                                            <!-- fim Imput descricao -->


                                            <?php if ($questao->getDificuldade()) : ?>
                                                <?php
                                                switch ($questao->getDificuldade()) {
                                                    case 'facil':
                                                        echo '<div class="input-field col m12 s12">
                                                            <select name="select" id="select">
                                                                <option value="facil">Fácil  <span class="emoj">😇</span></option>
                                                                <option value="media">Mediana  <span class="emoj">😅</span></option>
                                                                <option value="dificil">Difícil  <span class="emoj">😈</span></option>
                                                            </select>
                                                            <label>Nível da questão</label>                                            
                                                        </div>';
                                                        break;

                                                    case 'media':
                                                        echo ' <div class="input-field col m12 s12">
                                                              <select name="select" id="select">
                                                                  <option value="facil">Fácil  <span class="emoj">😇</span></option>
                                                                  <option selected value="media">Mediana  <span class="emoj">😅</span></option>
                                                                  <option value="dificil">Difícil  <span class="emoj">😈</span></option>
                                                              </select>
                                                              <label>Nível da questão</label>                                            
                                                          </div>';
                                                        break;

                                                    case 'dificil':
                                                        echo ' <div class="input-field col m12 s12">
                                                            <select name="select" id="select">
                                                                <option value="facil">Fácil  <span class="emoj">😇</span></option>
                                                                <option  value="media">Mediana  <span class="emoj">😅</span></option>
                                                                <option selected value="dificil">Difícil  <span class="emoj">😈</span></option>
                                                            </select>
                                                            <label>Nível da questão</label>                                        
                                                        </div>';
                                                        break;

                                                } ?>


                                            <?php else : ?>
                                                <div class="input-field col m12 s12">
                                                    <select name="select" id="select">
                                                        <option value="facil">Fácil <span class="emoj">😇</span>
                                                        </option>
                                                        <option value="media">Mediana <span class="emoj">😅</span>
                                                        </option>
                                                        <option value="dificil">Difícil <span class="emoj">😈</span>
                                                        </option>
                                                    </select>
                                                    <label>Nível da questão</label>

                                                </div>

                                            <?php endif ?>



                                            <?php
                                            $arrays = $questao->buscarPorIdAlternativas($questao->getId());
                                            $contador = 0;

                                            foreach ($arrays as $alternativa)  : ?>
                                                <?php $contador++;

                                                switch ($contador) {
                                                    case 1:
                                                        $letra = 'a';
                                                        break;
                                                    case 2:
                                                        $letra = 'b';
                                                        break;
                                                    case 3:
                                                        $letra = 'c';
                                                        break;
                                                    case 4:
                                                        $letra = 'd';
                                                        break;
                                                    case 5:
                                                        $letra = 'e';
                                                        break;


                                                }

                                                ?>
                                                <div class="row">
                                                    <div class="input-field col m1">

                                                        <?php if ($alternativa === $questao->getAlternativaCorreta()) : ?>
                                                            <label>
                                                                <input name="alternativaCorreta"
                                                                       value="<?php echo $letra; ?>" checked
                                                                       type="radio"
                                                                       onclick="M.toast({html:  'A altenativa correta vai ser a letra <?php echo $letra; ?>'})"/>
                                                                <span><?php echo $letra; ?></span>
                                                            </label>

                                                        <?php else: ?>

                                                            <label>
                                                                <input name="alternativaCorreta"
                                                                       value="<?php echo $letra; ?>" type="radio"
                                                                       onclick="M.toast({html:  'A altenativa correta vai ser a letra <?php echo $letra; ?>'})"/>
                                                                <span><?php echo $letra; ?></span>
                                                            </label>
                                                        <?php endif; ?>
                                                    </div>

                                                    <div class="input-field  offset-m1 col m10 s11">

                                                            <textarea class="materialize-textarea"
                                                                      placeholder="Ex. teste" id="<?php echo $letra; ?>"
                                                                      name="<?php echo $letra; ?>"
                                                                      onclick="M.toast({html:  'Insira uma resposta para a letra <?php echo $letra; ?>'})"><?php echo $alternativa ?></textarea>
                                                        <label for="textarea1">Alternativa <?php echo $letra; ?></label>

                                                        <?php $this->incluirVisao('util/formErroCadastro.php', ['campo' => $letra]) ?>

                                                    </div>
                                                </div>
                                            <?php endforeach ?>


                                            <?php for ($contador = $contador + 1; $contador <= 5; $contador++): ?>


                                                <?php
                                                switch ($contador) {
                                                    case 3:
                                                        $letra = 'c';
                                                        break;
                                                    case 4:
                                                        $letra = 'd';
                                                        break;
                                                    case 5:
                                                        $letra = 'e';
                                                        break;

                                                }

                                                if (isset($letra)) : ?>
                                                    <div class="row">
                                                        <div class="input-field col m1">

                                                            <label>
                                                                <input name="alternativaCorreta"
                                                                       value="<?php echo $letra; ?>" type="radio"
                                                                       onclick="M.toast({html:  'A altenativa correta vai ser a letra <?php echo $letra; ?>'})"/>
                                                                <span><?php echo $letra; ?></span>
                                                            </label>

                                                        </div>

                                                        <div class="input-field  offset-m1 col m10 s11">

                                                            <textarea class="materialize-textarea"
                                                                      placeholder="Ex. teste" id="<?php echo $letra; ?>"
                                                                      name="<?php echo $letra; ?>"
                                                                      onclick="M.toast({html:  'Insira uma resposta para a letra <?php echo $letra; ?>'})"></textarea>
                                                            <label for="textarea1">Alternativa <?php echo $letra; ?></label>

                                                            <?php $this->incluirVisao('util/formErroCadastro.php', ['campo' => $letra]) ?>

                                                        </div>
                                                    </div>


                                                <?php endif ?>

                                            <?php endfor; ?>
                                            <div class="center">
                                                <button class="btn waves-effect waves-light" type="submit"
                                                        name="action">Salvar
                                                    <i class="material-icons right"><img class="icons-buttons" src="<?= URL_IMG . 'icons/send.svg' ?>"></i>
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

        </div>

        <div class="row center">
            <?php if ($pagina > 1) : ?>
                <img class="icons-buttons" src="<?= URL_IMG . 'icons/esquerda.svg' ?>">
                <a href="<?= URL_RAIZ . 'questao/minhasQuestoesPagina?p=' . ($pagina - 1) ?>" class="btn btn-default">


                    Página
                    anterior</a>

            <?php endif ?>
            <?php if ($pagina < $ultimaPagina) : ?>
                <a href="<?= URL_RAIZ . 'questao/minhasQuestoesPagina?p=' . ($pagina + 1) ?>" class="btn btn-default">Próxima
                    página
                          </a> <img class="icons-buttons" src="<?= URL_IMG . 'icons/direita.svg' ?>">

            <?php endif ?>
        </div>


    </div>

