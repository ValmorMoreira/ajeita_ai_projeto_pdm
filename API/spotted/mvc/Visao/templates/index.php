<!DOCTYPE html>
<html>
<head>
    <title><?= APLICACAO_NOME ?></title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <link rel="stylesheet" href="<?= URL_CSS . 'geral.css' ?>">
    <link rel="stylesheet" href="<?= URL_CSS . 'footer.css' ?>">
    <!--Import Google Icon Font-->
    <!--Import materialize.css-->
    <link type="text/css" rel="stylesheet" href="<?= URL_CSS . 'materialize.min.css' ?>" media="screen,projection"/>
    <link href="https://fonts.googleapis.com/css?family=Fredericka+the+Great&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?= URL_CSS . 'cores.css' ?>">
    <link rel="stylesheet" href="<?= URL_CSS . 'animate.css' ?>">

    <!--Let browser know website is optimized for mobile-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>


</head>
<body>
<header>


    <nav>
        <div class="container">
            <div class=" navbar-fixed ">
                <a href="#" data-target="mobile-demo" class="sidenav-trigger"><i class="material-icons">menu</i></a>

                <a href="#" id="logo" class="brand-logo ">Spotted UTFPR-GP</a>
                <ul id="nav-mobile" class="right hide-on-med-and-down">
                    <li><a href="<?= URL_RAIZ ?>">home</a></li>
                    <li><a href="<?= URL_RAIZ . 'login' ?>">login</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <ul class="sidenav" id="mobile-demo">
        <li><a href="<?= URL_RAIZ ?>">home</a></li>
        <li><a href="<?= URL_RAIZ . 'login' ?>">login</a></li>
    </ul>
</header>
<main>


    <div class="container">

        <?php $this->imprimirConteudo() ?>


    </div>
</main>


<footer class=" page-footer">


    <div class="footer-copyright">
        <div class="container">
            © 2019 Copyright Ricardo de Oliveira - Universidade Tecnológica Federal do Paraná - UTFPR

            <!-- Modal Trigger -->
            <a class="grey-text text-lighten-4   modal-trigger right" data-target="modal1" href="#modal1">Mais
                Informações</a>

            <!-- Modal Structure -->

        </div>
    </div>

</footer>


<div id="modal1" class="modal text-darken-2">

    <div class="row center">
        <img class="img_perfil" src="<?php echo URL_IMG . 'login.png' ?>">
    </div>

    <div class="modal-content text-darken-2 center">
        <ul>
            <li><b>Aluno: Ricardo Martins de Oliveira</b></li>
            <li><b>Curso Tsi - Tecnologia em sistemas para internet</b></li>
            <li><b>Diciplina Web III</b></li>
            <li><b>Universidade Tecnológica Federal do Paraná - UTFPR</b></li>
        </ul>
        <hr>
        <div class="center">
            <a href="http://portal.utfpr.edu.br/" target="_blank"></a></b>
            <a class="social " id="facebook" href="https://www.facebook.com/ricardo.deoliveira.35/" target="_blank"></a>
            <a class="social" id="linkdin" href="https://www.linkedin.com/in/ricardodeoliveira96/" target="_blank"></a>
            <a class="social" id="github" href="https://github.com/Roliveira96/" target="_blank"></a>
            <a class="social"  id="instagram"href="https://www.instagram.com/ricardo_de_oliveira96/?hl=pt-br/" target="_blank"></a>

        </div>


        <div class="center" >
            <a href="http://portal.utfpr.edu.br//" target="_blank"> <img class="img_perfil" src="<?php echo URL_IMG . 'utfpr.jpeg' ?>"></a>
        </div>
    </div>
    <div class="modal-footer">
        <a href="#!" class="modal-close waves-effect waves-green btn-flat">OK</a>
    </div>
</div>


<script type="text/javascript" src="<?= URL_JS . 'jquery.js' ?>"></script>
<script type="text/javascript" src="<?= URL_JS . 'materialize.min.js' ?>"></script>
<script type="text/javascript" src="<?= URL_JS . 'main.js' ?>"></script>
</body>
</html>
