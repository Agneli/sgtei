<?php
include 'layout/header.php';

require_once 'classes/vehicles.php';

$vehicles = new Vehicles();

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $vehicles->setId($id);

    if ($vehicles->delete($id)) {
        echo '<script>$(function(){sucess();});</script>';
    } else {
        echo '<script>$(function(){error();});</script>';
    }
}
?>
<div id="content">
    <a href="javascript:;" id="help" title="Ajuda"></a>
    <div id="box-help">
        <a href="javascript:;" id="close"></a>
        <ul>
            <li>Para editar as informações de um veículo, clique no link "Editar" referente ao veículo em questão.</li>
            <li>Para excluír um veículo, clique no link "Excluír" referente ao veículo em questão.</li>
        </ul>
    </div>

    <h1>Lista de Veículos</h1>

    <?php
    include 'layout/msg-del.php';

    $veh = $vehicles->selectAll();

    if ($veh != null) {
        foreach ($veh as $vehicle) {
            echo '<div class="box-pes">
        <img src="images/vehicles/' . $vehicle->getImg() . '" alt="' . $vehicle->getPlate() . '" title="' . $vehicle->getPlate() . '" />
        <div class="info">
            <span>Placa:</span>' . $vehicle->getPlate() . '<br />
            <span>Autonomia:</span>' . $vehicle->getAut() . ' Km/L<br />
            <span>Motorista:</span>' . $vehicle->getDri() . '<br />';

            $vehicles->setId($vehicle->getId());

            $v = $vehicles->selectExpense($vehicles);
            foreach ($v as $ve) {
                echo '<span>Despesa:</span>R$ ' . round($ve->getExp(), 2) . ' por viagem';
            }

            echo '</div>
        <div class="actions">
            <ul>
                <li><a href="add-vehicle.php?id=' . $vehicle->getId() . '" class="edit"><span></span>Editar</a></li>
                <li><a href="list-vehicle.php?id=' . $vehicle->getId() . '" class="delete" onclick="return confirm(\'Confirmar exclusão deste veículo ?\');"><span></span>Excluír</a></li>
            </ul>
        </div>
    </div>';
        }
    } else {
        echo "Não existem veículos cadastrados, <a href='add-vehicle.php'>clique aqui</a> para cadastrar.";
    }
    ?>

</div>
<?php include 'layout/footer.php'; ?>