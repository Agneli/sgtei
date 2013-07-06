<?php
if (isset($_POST["enter"])) {
    
    require_once 'classes/database.php';
    require_once 'classes/peoples.php';
    require_once 'classes/users.php';

    $login = $_POST["login"];
    $pass = $_POST["pass"];

    $users = new Users();
    $users->setLogin($login);
    $users->setPass($pass);

    if($users->login($users)){
        session_start();
        $_SESSION["login"] = $users->getLogin($login);
        header("Location: panel.php");
    }else{
        echo '<script type="text/javascript" src="js/jquery.js"></script><script>$(function(){error();});</script>';
    }
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
        <script type="text/javascript" src="js/js.js"></script>

    </head>
    <body>
        <div id="box-login">
            <div id="logo"><img src="images/logo.png" alt="SGTEI" title="SGTEI" /></div>
            <?php include 'layout/msg-login.php'; ?>
            <form method="post">
                <input type="text" name="login" id="login" value="Login" /><br />
                <input type="text" name="pass" id="pass" value="Senha" /><br />
                <input type="submit" name="enter" value="Entrar" />
            </form>
        </div>
    </body>
</html>

