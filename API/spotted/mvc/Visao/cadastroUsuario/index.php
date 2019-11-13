<h1 class="hide">cadastro_usuario</h1>


<div class="row">
    <h4 class="center">Cadastro</h4>
    <h6 class="center">Por favor entre com suas informações corretamente</h6>


    <div class="col  s12  offset-m2 m8 ">
        <div class="card  darken-1 z-depth-3">
            <div class="card-content">

                <div class="center-block site">

                    <form action="<?= URL_RAIZ . 'cadastroUsuario' ?>" method="post" class="form-inline pull-left" enctype="multipart/form-data">

                        <div class="form ">
                            <img class="img_login" src="<?= URL_IMG . 'login.png' ?>">
                        </div>
                        <!--nome e sobrenome-->
                        <div class="row">



                            <!-- inicio Imput nome -->

                            <?php if (isset($nome)) : ?>

                                <div class="input-field col m6 s12">
                                    <input placeholder="Ex: João" id="nome" name="nome" onfocusout="M.toast({html: value+' é uma belo nome'
                                })" type="text" value="<?= $nome ?>"
                                           class="validate">
                                    <label for="nome">Nome</label>

                                    <?php $this->incluirVisao('util/formErroCadastro.php', ['campo' => 'nome']) ?>

                                </div>


                            <?php else : ?>


                                <div class="input-field col m6 s12">
                                    <input placeholder="Ex: João" id="nome" name="nome" onfocusout="M.toast({html: value+' é uma belo nome'
                                })" type="text" class="validate">
                                    <label for="nome">Nome</label>

                                    <?php $this->incluirVisao('util/formErroCadastro.php', ['campo' => 'nome']) ?>

                                </div>
                            <?php endif ?>
                            <!-- fim Imput nome -->


                            <!-- inicio Imput sobrenome -->


                            <?php if (isset($sobrenome)) : ?>

                                <div class="input-field col m6 s12">
                                    <input placeholder="Ex. da Silva" name="sobrenome" id="sobrenome"
                                           value="<?= $sobrenome ?>"
                                           onfocusout="M.toast({html:  'Falta somente as senhas!'})"
                                           onblur="validaString(sobrenome , 'sobrenome')" type="text" class="validate">
                                    <label for="sobrenome">Sobrenome</label>
                                    <?php $this->incluirVisao('util/formErroCadastro.php', ['campo' => 'sobrenome']) ?>

                                </div>
                            <?php else : ?>
                                <div class="input-field col m6 s12">
                                    <input placeholder="Ex. da Silva" name="sobrenome" id="sobrenome"
                                           onfocusout="M.toast({html:  'Falta somente as senhas!'})"
                                           onblur="validaString(sobrenome , 'sobrenome')" type="text" class="validate">
                                    <label for="sobrenome">Sobrenome</label>
                                    <?php $this->incluirVisao('util/formErroCadastro.php', ['campo' => 'sobrenome']) ?>

                                </div>
                            <?php endif ?>

                            <!-- fim Imput sobrenome -->


                        </div>

                        <!--senha e re-senha-->
                        <div class="row">
                            <div class="input-field col s12 m6">
                                <input id="senha" name="senha" type="password"  onclick="M.toast({html:  'Lembrando a você, que a senha tem que ser maior que 8 digitos'})" class="validate">
                                <label for="senha">Senha</label>
                                <?php $this->incluirVisao('util/formErroCadastro.php', ['campo' => 'senha']) ?>
                                <?php $this->incluirVisao('util/formErroCadastro.php', ['campo' => 'conf']) ?>

                            </div>

                            <div class="input-field col s12 m6">
                                <input id="senha1" name="senha1" type="password" onclick="M.toast({html:  'E as senhas devem ser iguais para continuar!'})" class="validate">
                                <label for="senha1">Repita a senha</label>
                                <?php $this->incluirVisao('util/formErroCadastro.php', ['campo' => 'senha1']) ?>
                                <?php $this->incluirVisao('util/formErroCadastro.php', ['campo' => 'conf']) ?>

                            </div>
                        </div>
                        <!--email-->

                        <?php if (isset($email)) : ?>

                            <div class="row">
                                <div class="input-field col s12 ">
                                    <input placeholder="Ex: exemplo@gmail.com" name="email" onblur="M.toast({html:  'Você vai ter que utilizar esse email para se logar em nosso sistema'})" onfocusout="M.toast({html: value
                                })" value="<?= @$email ?>"
                                           id="email" type="email" class="validate">
                                    <label for="email">Email</label>
                                    <?php $this->incluirVisao('util/formErroCadastro.php', ['campo' => 'email']) ?>
                                </div>
                            </div>
                        <?php else : ?>
                            <div class="row">
                                <div class="input-field col s12 ">
                                    <input placeholder="Ex: exemplo@gmail.com" name="email" onblur= "M.toast({html:  'Você vai ter que utilizar esse email para se logar em nosso sistema'})" onfocusout="M.toast({html: value
                                })"
                                           id="email" type="email" class="validate">
                                    <label for="email">Email</label>
                                    <?php $this->incluirVisao('util/formErroCadastro.php', ['campo' => 'email']) ?>
                                </div>
                            </div>
                        <?php endif ?>

                        <!-- fim Imput email -->


                        <!--imagem perfil-->


                        <div class="row">
                            <div class="input-field col offset-s2 s12  m12  ">

                                <div class="file-field input-field">
                                    <div class="btn">
                                        <span>Imagen para o perfil</span>
                                        <input id="foto" name="foto" type="file">
                                    </div>
                                    <div class="file-path-wrapper">
                                        <input class="file-path validate" type="text">
                                    </div>
                                </div>
                            </div>

                        </div>


                        <!--enviar para banco-->
                        <div class="center form">

                            <button class="btn waves-effect waves-light" type="submit" name="action">Salvar
                                <i class="material-icons right"><img class="icons-buttons" src="<?= URL_IMG . 'icons/send.svg' ?>"></i>
                            </button>
                        </div>


                    </form>


                </div>
            </div>
        </div>
    </div>


</div>
<h6 class="center"><a href="<?= URL_RAIZ . 'login' ?>">Voltar para tela de Login</a></h6>

