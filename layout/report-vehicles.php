<table>
    <thead>
        <tr>
            <!--<th>Código</th>-->
            <th>Placa</th>
            <th>Autonomia</th>
            <th>Rota</th>
            <th>Motorista</th>
            <th>Despesas</th>
        </tr>
    </thead>
    <tbody>

        <?php
        require_once 'classes/vehicles.php';
        require_once 'classes/expenses.php';

        $vehicles = new Vehicles();

        $veh = $vehicles->selectAll();
        $i = 1;

        if ($veh != null) {
            foreach ($veh as $vehicle) {
                if ($i % 2 == 0) {
                    echo '<tr bgcolor="#f2f2f2">';
                } else {
                    echo '<tr>';
                }
                echo '<td>' . $vehicle->getPlate() . '</td>
                    <td>' . $vehicle->getAut() . ' Km/L</td>
                    <td>' . $vehicle->getRou() . '</td>
                    <td>' . $vehicle->getDri() . '</td>
                    <td>';
                $expenses = new Expenses();
                $sum = $expenses->selectSum($vehicle);
                foreach ($sum as $expense_sum) {
                    echo $expense_sum->getVal();
                }
                echo '</td></tr>';
                $i++;
            }
        } else {
            echo "Não existem veículos cadastrados, <a href='add-vehicle.php'>clique aqui</a> para cadastrar.<br /><br />";
        }
        ?>
    </tbody>
</table>