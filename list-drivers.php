<?php
include 'layout/header.php';

require_once 'classes/drivers.php';

$drivers = new Drivers();
?>

<div id="content">
    <a href="javascript:;" id="help" title="Ajuda"></a>
    <div id="box-help">
        <a href="javascript:;" id="close"></a>
        <ul>
            <li>Para editar as informações de um motorista, clique no link "Editar" referente ao motorista em questão.</li>
        </ul>
    </div>

    <h1>Lista de Motoristas</h1>

    <?php
    include 'layout/msg-del.php';

    $dri = $drivers->selectAll();

    if ($dri != null) {
        foreach ($dri as $driver) {
            echo '<div class="box-pes">
        <img src="images/peoples/' . $driver->getImg() . '" alt="' . $driver->getName() . '" title="' . $driver->getName() . '" />
        <div class="info">
            <span>Tipo:</span>Motorista<br />
            <span>Nome:</span>' . $driver->getName() . '<br />
            <span>E-mail:</span>' . $driver->getEmail() . '<br />
            <span>Fone:</span>' . $driver->getPhone() . '<br />
            <span>Cel:</span>' . $driver->getCel() . '<br />
            <span>CNH:</span>' . $driver->getCnh() . '
        </div>
        <div class="actions">
            <ul>
                <li><a href="add-people.php?id=' . $driver->getPeo() . '&type=driver" class="edit"><span></span>Editar</a></li>
            </ul>
        </div>
    </div>';
        }
    } else {
        echo "Não existem motoristas cadastrados, <a href='add-people.php'>clique aqui</a> para cadastrar.";
    }
    ?>

</div>
<?php include 'layout/footer.php'; ?>