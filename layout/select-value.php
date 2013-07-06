<?php

require_once '../classes/database.php';
require_once '../classes/values.php';

$id = $_POST["id"];
$values = new Values();

$values->setId($id);
$val = $values->select($values);

if ($val) {
    foreach ($val as $value) {
        echo '<option value="' . $value->getId() . '">R$ ' . $value->getVal() . ' - ' . $value->getDesc() . '</option>';
    }
} else {
    if ($id == 0) {
        echo '<option value="0">Selecione um valor</option>';
    } else {
        echo '<option value="0">Esta rota ainda não possui um valor, cadastre um ou escolha outra rota</option>';
    }
}
?>