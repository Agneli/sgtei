<?php
include 'layout/header.php';
require_once 'classes/routes.php';

$id = $_GET["id"];

$routes = new Routes();
$routes->setId($id);
$rou = $routes->select($routes);

foreach ($rou as $route) {
    $route->getOri();
    $route->getDest();
}
?>

<div id="content">
    <h1><?php echo $route->getOri() . " &rarr; " . $route->getDest() ?></h1>
    <?php include 'layout/mapa.php'; ?>
</div>
<?php include 'layout/footer.php'; ?>