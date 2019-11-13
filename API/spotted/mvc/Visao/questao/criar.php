<h1 class="hide">criar_questao</h1>


    <?php if (isset($gif)) : ?>
        <?php if ($gif == 'no') {
            echo '
                <div class="div_teste circle">
                    <div class="img_no circle">
                
                    </div>
                </div>';
        } ?>
    <?php endif; ?>


<?php
if ($sucesso) : ?>


    <div class="div_teste circle ">
        <div class=" img_yes circle">

        </div>
    </div>

    <div class="animated zoomOutUp faster delay-5s erro">
        <div class="card-panel teal lighten-2 center text-darken-2">    <?= $sucesso ?>
        </div>
    </div>
<?php endif ?>


<div class="col offset-s3 s6  offset-m3 m6 ">
    <div class="card  darken-1 z-depth-3">
        <div class="card-content">
            <div class="row">
                <h4 class="center">Crie suas questão</h4>
                <h6 class="center">Seja desafiador ou nem tanto! <span class="emoj">😅 </span></h6>

                <form action="<?= URL_RAIZ . 'questao/criarPagina' ?>" method="post" class="form-inline pull-left"
                      enctype="multipart/form-data">

                    <?php $this->incluirVisao('util/formErroCadastro.php', ['campo' => 'erros']) ?>


                    <!-- inicio Imput titulo -->

                    <?php if (isset($titulo)) : ?>

                        <div class="input-field col m8 s12">
                            <input placeholder="O que é uma diagrama" id="titulo"   data-length="1000" name="titulo" onclick="M.toast({html: value+' Sempre é bom inserir um titulo que chame a atenção!'
                                })" type="text" value="<?= $titulo ?>"
                                   class="validate materialize-textarea"">
                            <label for="first_name">Titulo da pergunta</label>

                            <?php $this->incluirVisao('util/formErroCadastro.php', ['campo' => 'titulo']) ?>

                        </div>


                    <?php else : ?>


                        <div class="input-field col m8 s12">
                            <input placeholder="O que é uma diagrama" id="titulo"  data-length="1000"  name="titulo" onclick="M.toast({html: value+' Sempre é bom inserir um titulo que chame a atenção!'
                                })" type="text"
                                   class="validate materialize-textarea"">
                            <label for="first_name">Titulo da pergunta</label>


                            <?php $this->incluirVisao('util/formErroCadastro.php', ['campo' => 'titulo']) ?>

                        </div>
                    <?php endif ?>


                    <!-- fim Imput titulo -->

                    <?php if (isset($dificuldade)) : ?>
                        <?php
                        switch ($dificuldade) {
                            case 'facil':
                                echo '<div class="input-field col m4 s12">
                <select name="select" id="select">
                    <option value="facil">Fácil  <span class="emoj">😇</span></option>
                    <option value="media">Mediana  <span class="emoj">😅</span></option>
                    <option value="dificil">Difícil  <span class="emoj">😈</span></option>
                </select>
                <label>Nível da questão</label>

            </div>';
                                break;

                            case 'media':
                                echo ' <div class="input-field col m4 s12">
                  <select name="select" id="select">
                      <option value="facil">Fácil  <span class="emoj">😇</span></option>
                      <option selected value="media">Mediana  <span class="emoj">😅</span></option>
                      <option value="dificil">Difícil  <span class="emoj">😈</span></option>
                  </select>
                  <label>Nível da questão</label>

              </div>';
                                break;

                            case 'dificil':
                                echo ' <div class="input-field col m4 s12">
                    <select name="select" id="select">
                        <option value="facil">Fácil  <span class="emoj">😇</span></option>
                        <option  value="media">Mediana  <span class="emoj">😅</span></option>
                        <option selected value="dificil">Difícil  <span class="emoj">😈</span></option>
                    </select>
                    <label>Nível da questão</label>

                </div>';
                                break;


                        }
                        ?>


                    <?php else : ?>
                        <div class="input-field col m4 s12">
                            <select name="select" id="select">
                                <option value="facil">Fácil <span class="emoj">😇</span></option>
                                <option value="media">Mediana <span class="emoj">😅</span></option>
                                <option value="dificil">Difícil <span class="emoj">😈</span></option>
                            </select>
                            <label>Nível da questão</label>

                        </div>

                    <?php endif ?>

                    <!-- inicio Imput descricao -->


                    <?php if (isset($descricao)) : ?>

                        <div class="input-field col m12 s12">

                        <textarea class="materialize-textarea" name="descricao" placeholder="Ex. teste" id="textArrea"
                                  onclick="M.toast({html:  'Na descrição é recomendado sempre detalhar a sua questão, desta forma deixando bem mais compreensivo a questão!'})"><?= $descricao ?></textarea>
                            <label for="textarea1">Descrição da questão</label>

                            <?php $this->incluirVisao('util/formErroCadastro.php', ['campo' => 'descricao']) ?>

                        </div>


                    <?php else : ?>
                        <div class="input-field col m12 s12">

                        <textarea id="descricao" name="descricao" class="materialize-textarea"
                                  onclick="M.toast({html:  'Na descrição é recomendado sempre detalhar a sua questão, desta forma deixando bem mais compreensivo a questão!'})"></textarea>
                            <label for="descricao">Descrição da questão</label>

                            <?php $this->incluirVisao('util/formErroCadastro.php', ['campo' => 'descricao']) ?>

                        </div>


                    <?php endif ?>

                    <!-- fim Imput descricao -->


            </div>
            <!--imagem perfil-->


            <?php if (isset($foto)) : ?>

                <div class="row">
                    <div class="input-field col offset-s2 s12  m12  ">

                        <div class="file-field input-field">
                            <div class="btn">
                                <span>Imagem para a questão</span>
                                <input id="img" name="img" type="file">
                            </div>

                            <?php $this->incluirVisao('util/formErroCadastro.php', ['campo' => 'foto']) ?>

                        </div>
                    </div>

                </div>


            <?php else : ?>

                <div class="row">
                    <div class="input-field col offset-s2 s12  m12  ">

                        <div class="file-field input-field">
                            <div class="btn">
                                <span>Imagem para a questão</span>
                                <input id="img" name="img" type="file">
                            </div>
                            <div class="file-path-wrapper">
                                <input class="file-path validate" type="text">
                            </div>
                        </div>
                    </div>

                </div>


            <?php endif ?>


            <!-- Modal dica -->

            <!-- Modal Trigger -->
            <div class="col m12 center ">
                <a class="waves-effect waves-light btn modal-trigger center " href="#modal1">Dicas para se criar
                    altenativas</a>
            </div>
            <!-- Modal Structure -->
            <div id="modal1" class="modal">
                <div class="modal-content">
                    <h4 class="center">Dicas de como se criar uma boa questão!</h4>

                    <p>
                        ― Sempre é bom inserir uma alternativa clara mesmo sendo a errada para que o usuário tenha um
                        ótimo entendimento.

                    </p>
                    <p>
                        ― Sempre selecionar a alternativa correta, e certificar se que realmente é a correta.

                    </p>
                    <p>
                        ― É importante selecionar pelo menos duas alternativas e selecionar uma delas como correta.

                    </p>
                    <p>
                        ― As alternativas tem que ter no mínimo 10 caracteres, e seja o mais claro possível.

                    </p>
                    <p>
                        ― Pode deixar as alternativas em branco caso não exista mais respostas, porém terá que criar
                        pelo
                        menos duas alternativas obrigatoriamente.


                    </p>


                </div>
                <div class="modal-footer">
                    <a href="#!" class="modal-close waves-effect waves-green btn-flat">Ok entendi!</a>
                </div>
            </div>

            <!-- Modal dica -->


            <div class="col m12 center ">
                <h3 class="center ">Alternativas</h3>
                <?php $this->incluirVisao('util/formErroCadastro.php', ['campo' => 'alternativa']) ?>

            </div>


            <!--Alternativas A-->


            <?php if (isset($a)) : ?>
                <div class="row">
                    <div class="input-field col m1">
                        <?php if ($alternativaCorreta === 'a') : ?>
                            <label>
                                <input name="alternativaCorreta" checked value="a" type="radio"
                                       onclick="M.toast({html:  'A altenativa correta vai ser a letra A'})"/>
                                <span>A</span>
                            </label>
                        <?php else : ?>
                            <label>
                                <input name="alternativaCorreta" value="a" type="radio"
                                       onclick="M.toast({html:  'A altenativa correta vai ser a letra A'})"/>
                                <span>A</span>
                            </label>

                        <?php endif ?>


                    </div>
                    <div class="input-field col m11 s11">

                        <textarea class="materialize-textarea" placeholder="Ex. teste" id="a" name="a"
                                  onclick="M.toast({html:  'Insira uma resposta para a letra a'})"><?= $a ?></textarea>
                        <label for="a">Alternativa A</label>

                        <?php $this->incluirVisao('util/formErroCadastro.php', ['campo' => 'a']) ?>

                    </div>
                </div>

            <?php else : ?>
                <div class="row">
                    <div class="input-field col m1">

                        <label>
                            <input name="alternativaCorreta" checked value="a" type="radio"
                                   onclick="M.toast({html:  'A altenativa correta vai ser a letra A'})"/>
                            <span>A</span>
                        </label>


                    </div>
                    <div class="input-field col m11 s11">

                        <textarea id="a" name="a" class="materialize-textarea"
                                  onclick="M.toast({html:  'Insira uma resposta para a letra a'})"></textarea>
                        <label for="a">Alternativa A</label>

                        <?php $this->incluirVisao('util/formErroCadastro.php', ['campo' => 'a']) ?>

                    </div>

                </div>
            <?php endif ?>
            <!--Alternativas A-->


            <!--Alternativas B -->


            <?php if (isset($b)) : ?>
                <div class="row">
                    <div class="input-field col m1">


                        <?php if ($alternativaCorreta === 'b') : ?>
                            <label>
                                <input name="alternativaCorreta" checked value="b" type="radio"
                                       onclick="M.toast({html:  'A altenativa correta vai ser a letra B'})"/>
                                <span>B</span>
                            </label>
                        <?php else : ?>
                            <label>
                                <input name="alternativaCorreta" value="b" type="radio"
                                       onclick="M.toast({html:  'A altenativa correta vai ser a letra B'})"/>
                                <span>B</span>
                            </label>

                        <?php endif ?>


                        <label>
                            <input name="alternativaCorreta" value="b" type="radio"
                                   onclick="M.toast({html:  'A altenativa correta vai ser a letra B'})"/>
                            <span>B</span>
                        </label>


                    </div>
                    <div class="input-field col m11 s11">

                        <textarea class="materialize-textarea" placeholder="Ex. teste" id="b" name="b"
                                  onclick="M.toast({html:  'Insira uma resposta para a letra b'})"><?= $b ?></textarea>
                        <label for="b">Alternativa B</label>

                        <?php $this->incluirVisao('util/formErroCadastro.php', ['campo' => 'b']) ?>

                    </div>
                </div>

            <?php else : ?>
                <div class="row">
                    <div class="input-field col m1">

                        <label>
                            <input name="alternativaCorreta" value="b" type="radio"
                                   onclick="M.toast({html:  'A altenativa correta vai ser a letra B'})">
                            <span>B</span>
                        </label>


                    </div>
                    <div class="input-field col m11 s11">

                        <textarea id="b" name="b" class="materialize-textarea"
                                  onclick="M.toast({html:  'Insira uma resposta para a letra b'})"></textarea>
                        <label for="b">Alternativa B</label>

                        <?php $this->incluirVisao('util/formErroCadastro.php', ['campo' => 'b']) ?>

                    </div>

                </div>
            <?php endif ?>
            <!--Alternativas B-->


            <!--Alternativas C -->


            <?php if (isset($c)) : ?>
                <div class="row">
                    <div class="input-field col m1">

                        <?php if ($alternativaCorreta === 'c') : ?>
                            <label>
                                <input name="alternativaCorreta" checked value="c" type="radio"
                                       onclick="M.toast({html:  'A altenativa correta vai ser a letra C'})"/>
                                <span>C</span>
                            </label>
                        <?php else : ?>
                            <label>
                                <input name="alternativaCorreta" value="c" type="radio"
                                       onclick="M.toast({html:  'A altenativa correta vai ser a letra C'})"/>
                                <span>C</span>
                            </label>

                        <?php endif ?>


                    </div>
                    <div class="input-field col m11 s11">

                        <textarea class="materialize-textarea" placeholder="Ex. teste" id="c" name="c"
                                  onclick="M.toast({html:  'Insira uma resposta para a letra c'})"><?= $c ?></textarea>
                        <label for="c">Alternativa C</label>

                        <?php $this->incluirVisao('util/formErroCadastro.php', ['campo' => 'c']) ?>

                    </div>
                </div>

            <?php else : ?>
                <div class="row">
                    <div class="input-field col m1">

                        <label>
                            <input name="alternativaCorreta" value="c" type="radio"
                                   onclick="M.toast({html:  'A altenativa correta vai ser a letra C'})"/>
                            <span>C</span>
                        </label>


                    </div>
                    <div class="input-field col m11 s11">

                        <textarea id="c" name="c" class="materialize-textarea"
                                  onclick="M.toast({html:  'Insira uma resposta para a letra c'})"></textarea>
                        <label for="c">Alternativa C</label>

                        <?php $this->incluirVisao('util/formErroCadastro.php', ['campo' => 'c']) ?>

                    </div>

                </div>
            <?php endif ?>
            <!--Alternativas C-->


            <!--Alternativas D -->


            <?php if (isset($d)) : ?>
                <div class="row">
                    <div class="input-field col m1">

                        <?php if ($alternativaCorreta === 'd') : ?>
                            <label>
                                <input name="alternativaCorreta" checked value="d" type="radio"
                                       onclick="M.toast({html:  'A altenativa correta vai ser a letra D'})"/>
                                <span>D</span>
                            </label>
                        <?php else : ?>
                            <label>
                                <input name="alternativaCorreta" value="d" type="radio"
                                       onclick="M.toast({html:  'A altenativa correta vai ser a letra D'})"/>
                                <span>D</span>
                            </label>

                        <?php endif ?>

                    </div>
                    <div class="input-field col m11 s11">

                        <textarea class="materialize-textarea" placeholder="Ex. teste" id="d" name="d"
                                  onclick="M.toast({html:  'Insira uma resposta para a letra d'})"><?= $d ?></textarea>
                        <label for="d">Alternativa D</label>

                        <?php $this->incluirVisao('util/formErroCadastro.php', ['campo' => 'd']) ?>

                    </div>
                </div>

            <?php else : ?>
                <div class="row">
                    <div class="input-field col m1">

                        <label>
                            <input name="alternativaCorreta" value="d" type="radio"
                                   onclick="M.toast({html:  'A altenativa correta vai ser a letra D'})"/>
                            <span>D</span>
                        </label>


                    </div>
                    <div class="input-field col m11 s11">

                        <textarea id="d" name="d" class="materialize-textarea"
                                  onclick="M.toast({html:  'Insira uma resposta para a letra d'})"></textarea>
                        <label for="d">Alternativa D</label>

                        <?php $this->incluirVisao('util/formErroCadastro.php', ['campo' => 'd']) ?>

                    </div>

                </div>
            <?php endif ?>
            <!--Alternativas D-->


            <!--Alternativas E -->


            <?php if (isset($e)) : ?>
                <div class="row">
                    <div class="input-field col m1">
                        <?php if ($alternativaCorreta === 'e') : ?>
                            <label>
                                <input name="alternativaCorreta" checked value="e" type="radio"
                                       onclick="M.toast({html:  'A altenativa correta vai ser a letra E'})"/>
                                <span>E</span>
                            </label>
                        <?php else : ?>
                            <label>
                                <input name="alternativaCorreta" value="e" type="radio"
                                       onclick="M.toast({html:  'A altenativa correta vai ser a letra E'})"/>
                                <span>E</span>
                            </label>

                        <?php endif ?>
                    </div>
                    <div class="input-field col m11 s11">

                        <textarea class="materialize-textarea" placeholder="Ex. teste" id="e" name="e"
                                  onclick="M.toast({html:  'Insira uma resposta para a letra e'})"><?= $e ?></textarea>
                        <label for="e">Alternativa E</label>

                        <?php $this->incluirVisao('util/formErroCadastro.php', ['campo' => 'e']) ?>

                    </div>
                </div>

            <?php else : ?>
                <div class="row">
                    <div class="input-field col m1">

                        <label>
                            <input name="alternativaCorreta" value="e" type="radio"
                                   onclick="M.toast({html:  'A altenativa correta vai ser a letra E'})"/>
                            <span>E</span>
                        </label>


                    </div>
                    <div class="input-field col m11 s11">

                        <textarea id="e" name="e" class="materialize-textarea"
                                  onclick="M.toast({html:  'Insira uma resposta para vai a letra e'})"></textarea>
                        <label for="e">Alternativa E</label>

                        <?php $this->incluirVisao('util/formErroCadastro.php', ['campo' => 'e']) ?>

                    </div>

                </div>
            <?php endif ?>
            <!--Alternativas D-->

            <!--enviar para banco-->
            <div class="center form">

                <button class="btn waves-effect waves-light pulse" type="submit" name="action">Salvar questão
                    <i class="material-icons right"> <img class=icons-buttons src="<?= URL_IMG . 'icons/cloud.svg' ?>">
                    </i>
                </button>
            </div>


            </form>


        </div>

    </div>
</div>
