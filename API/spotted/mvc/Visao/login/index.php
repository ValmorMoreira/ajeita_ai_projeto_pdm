<h1 class="hide">login</h1>


<div class="row">
    <h4 class="center">Login</h4>
    <h6 class="center">Por favor entre com suas informações</h6>


    <div class="col  s12  offset-m3 m6 ">
        <div class="card  darken-1 z-depth-3">
            <div class="card-content">

                <div class="center-block site">


                    <form action="<?= URL_RAIZ . 'login' ?>" method="post" class="form-inline pull-left">


                        <div class="form ">
                            <img class="img_login" src="<?= URL_IMG . 'login.png' ?>">
                        </div>

                        <?php $this->incluirVisao('util/formErro.php', ['campo' => 'login']) ?>

                        <div class="form">

                            <?php

                            if (isset($_COOKIE['emailLogin']))  : ?>

                                <input id="usuario" name="usuario" class="form-control campo-form" autofocus
                                       placeholder="Email" value="<?= $_COOKIE['emailLogin'] ?>">

                            <?php else: ?>

                                <input id="usuario" name="usuario" class="form-control campo-form" autofocus
                                       placeholder="Email">

                            <?php endif ?>


                        </div>
                        <div class="form">
                            <input id="texto" name="senha" type="password" placeholder="Senha">
                        </div>

                        <div class="center form">

                            <button class="btn waves-effect waves-light" type="submit" name="action">Entrar
                                <i class="material-icons right"> <img class="icons-buttons" src="<?= URL_IMG . 'icons/send.svg' ?>">
                                </i>
                            </button>
                        </div>


                    </form>

                </div>
                <h6 class="center"><a href="<?= URL_RAIZ . 'cadastroUsuario' ?>">Crie sua conta gratuitamente!</a></h6>

            </div>
        </div>
    </div>


</div>

