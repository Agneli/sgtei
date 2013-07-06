<?php
require_once 'classes/database.php';

session_start();
if (!isset($_SESSION["login"])) {
    header("Location: logout.php");
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Sistema Gerenciador de Transporte Escolar Intermunicipal - SGTEI</title>

        <link rel="shortcut icon" type="image/x-icon" href="images/favicon.png" />
        <link rel="stylesheet" type="text/css" href="css/style.css" />

        <script type="text/javascript" src="js/jquery.js"></script>
        <script type="text/javascript" src="js/mask.js"></script>
        <script type="text/javascript" src="js/js.js"></script>

    </head>
    <body>
        <header>
            <div class="content">
                <a href="panel.php" id="logo"><img src="images/logo.png" alt="SGTEI" title="SGTEI" /></a>
                <h1>Sistema Gerenciador de Transporte Escolar Intermunicipal</h1>
            </div>
        </header>
        <main>
            <div class="content">
                <?php include 'layout/menu.php'; ?>