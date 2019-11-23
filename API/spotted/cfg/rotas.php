<?php
$rotas = [
    '/' => [
        'GET' => '\Controlador\HomeControlador#index',

    ],


    '/login' => [

        'GET' => '\Controlador\LoginControlador#loginPage',
        'POST' => '\Controlador\LoginControlador#login',
    ],

    '/login/api' => [
        'POST' => '\Controlador\LoginControlador#loginViaApi',
    ],

    '/cadastroUsuario' => [

        'GET' => '\Controlador\UsuarioControlador#index',
        'POST' => '\Controlador\UsuarioControlador#armazenar',

    ],
    '/cadastroApi' => [
        'POST' => '\Controlador\UsuarioControlador#armazenarApi',

    ],
    '/atualizaApi' => [
        'POST' => '\Controlador\UsuarioControlador#atualizaApi',
        'GET' => '\Controlador\UsuarioControlador#atualizaApi',

    ],


    '/sair' => [
        'GET' => '\Controlador\LoginControlador#destruirLogin',
    ],

    '/questao' => [
        'GET' => '\Controlador\QuestaoControlador#index',
    ],

    '/questao_nao_logado' => [
        'GET' => '\Controlador\QuestaoControlador#naoLogado',
    ],

    '/questao/criarPagina' => [
        'GET' => '\Controlador\QuestaoControlador#criarPaginaQuestao',
        'POST' => '\Controlador\QuestaoControlador#salvarQuestao'
    ],

    '/questao/responderPagina' => [
        'GET' => '\Controlador\QuestaoControlador#responderFiltro',
        'POST' => '\Controlador\QuestaoControlador#respostaQuestao',
    ],

    '/questao/relatorioPagina' => [
        'GET' => '\Controlador\RelatorioControlador#index',
    ],

    '/questao/minhasQuestoesPagina' => [
        'GET' => '\Controlador\MinhasQuestoesControlador#index',
        'POST' => '\Controlador\MinhasQuestoesControlador#editar',
    ],

    '/questao/minhasQuestoesPagina/?' => [
        'DELETE' => '\Controlador\MinhasQuestoesControlador#destruir',
    ],
];
