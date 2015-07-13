<?php
//
session_start();
//Se nao estiver logado, redireciona para pagina de login
if (!isset($_SESSION['logado'])) {
    header('Location:login.php');
}

//Informacoes do menu
$page = (isset($_GET['page'])) ? $_GET['page'] : "monitoramento";
?>


<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="content-type" content="text/html; charset=UTF-8">
        <meta charset="utf-8">
        <title>HostView</title>
        <meta name="generator" content="Bootply" />
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <!--[if lt IE 9]>
                <script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->
        <link href="css/styles.css" rel="stylesheet">
    </head>
    <body>
        <div class="navbar navbar-inverse navbar-fixed-top">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" class="active" href="index.php?page=monitoramento">Hostview</a>
                </div>
                <div class="collapse navbar-collapse">
                    <ul class="nav navbar-nav" class="pagination">
                        <li><a href="index.php?page=host">Hosts</a></li>
                        <li><a href="index.php?page=monitoramento">Monitoramento</a></li>
                        <li><a href="index.php?page=ferramentas">Ferramentas</a></li>
                        <li><a href="index.php?page=relatorios">Relatórios</a></li>
                        <li><a href="index.php?page=about">About</a></li>
                    </ul>
                    <ul class="nav navbar-nav pull-right">
                        <li class="" id="">
                            <a href="validar.php?logout=1">Logout</a>
                        </li>
                    </ul>
                </div><!--/.nav-collapse -->
            </div>
        </div>
<div class="container">
