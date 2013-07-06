<?php include 'layout/header.php'; ?>
<div id="content">
    <a href="javascript:;" id="help" title="Ajuda"></a>
    <div id="box-help">
        <a href="javascript:;" id="close"></a>
        <ul>
            <li>Para visualizar o mapa da rota clique no ícone da lupa referente á rota em questão.</li>
        </ul>
    </div>

    <h1>Lista de rotas</h1>

    <table>
        <thead>
            <tr>
                <th>Origem</th>
                <th>&rarr;</th>
                <th>Destino</th>
                <th>Distância</th>
                <th>Tempo</th>
                <th>Visualizar</th>
            </tr>
        </thead>
        <tbody>

            <?php
            require_once 'classes/routes.php';

            $routes = new Routes();

            $rou = $routes->selectAll();
            $i = 1;

            if ($rou != null) {
                foreach ($rou as $route) {
                    if ($i % 2 == 0) {
                        echo '<tr bgcolor="#f2f2f2">';
                    } else {
                        echo '<tr>';
                    }
                    echo '<td>' . $route->getOri() . '</td>
                    <td>&rarr;</td>
                    <td>' . $route->getDest() . '</td>
                    <td>' . $route->getDis() . ' Km</td>
                    <td>' . $route->getTime() . '</td>
                    <td>
                        <ul>
                            <li><a href="routes.php?id=' . $route->getId() . '" class="view" title="Visualizar rota"><span></span></a></li>
                        </ul>
                    </td>';
                    $i++;
                }
            } else {
                echo "Não existem rotas cadastradas, <a href='add-route.php'>clique aqui</a> para cadastrar.<br /><br />";
            }
            ?>
        </tbody>
    </table>

</div>
<?php include 'layout/footer.php'; ?>