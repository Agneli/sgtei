<?php

require_once '../classes/database.php';
require_once '../classes/vehicles.php';

$id = $_POST["id"];
$vehicles = new Vehicles();

$vehicles->setRou($id);
$veh = $vehicles->selectCont($vehicles);

if ($veh) {
    foreach ($veh as $vehicle) {
        echo '<option value="' . $vehicle->getId() . '">' . $vehicle->getPlate() . '</option>';
    }
} else {
    if ($id == 0) {
        echo '<option value="0">Selecione um veículo</option>';
    } else {
        echo '<option value="0">Esta rota ainda não possui um veículo, cadastre um ou escolha outra rota</option>';
    }
}
?>