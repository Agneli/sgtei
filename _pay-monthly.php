<?php
require_once 'classes/database.php';
require_once 'classes/monthlies.php';

$ra = $_GET["ra"];

$monthlies = new Monthlies();
$monthlies->setId($_GET["id"]);
$monthlies->setStatus("pg");
if($monthlies->pay($monthlies)){
    header("Location: contracts.php?id=".$ra."&pay=ok");
}else{
    header("Location: contracts.php?id=".$ra."&pay=error");
}
?>
