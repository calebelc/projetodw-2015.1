<?php

session_start();
$connection = ssh2_connect('127.0.0.1', 22);
//
if (isset($_SESSION['retorno'])) {
    unset($_SESSION['retorno']);
}


//Deslogar do sistema;
if (isset($_GET['logout'])) {
    unset($_SESSION['logado']);
    $_SESSION['retorno'] = array('status' => 'info', 'mensagem' => 'Usuario foi deslogado!.');
    header('Location:login.php');
}

//Validar login no sistema
if (isset($_POST['login']) && isset($_POST['senha'])) {
    if (@ssh2_auth_password($connection, $_POST['login'], $_POST['senha'])) {
        $_SESSION['logado'] = true;
        header('Location:index.php');
    } else {
        $_SESSION['retorno'] = array('status' => 'danger', 'mensagem' => 'Falha de autenticaçao! Usuario ou senha incorretos.');
//        var_dump($_SESSION['retorno']); die();
        header('Location:login.php');
    }
}
