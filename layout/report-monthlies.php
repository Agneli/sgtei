<table>
    <thead>
        <tr>
            <th>Aluno</th>
            <th>Mês</th>
            <th>Valor</th>
        </tr>
    </thead>
    <tbody>
        <?php
        require_once 'classes/monthlies.php';

        $monthlies = new Monthlies();
        $mon = $monthlies->selectAll();

        $months = ["Janeiro", "Fevereiro", "Março", "Abril", "Maio", "Junho", "Julho", "Agosto", "Setembro", "Outubro", "Novembro", "Dezembro"];

        $i = 1;

        if ($mon != null) {
            foreach ($mon as $monthly) {
                if ($i % 2 == 0) {
                    echo '<tr bgcolor="#f2f2f2">';
                } else {
                    echo '<tr>';
                }
                echo '<td>' . $monthly->getRa() . '</td>
                    <td>' . $months[$monthly->getMon() - 1] . '</td>
                    <td>' . $monthly->getVal() . '</td>';
                $i++;
            }
        } else {
            echo "Não existem mensalidades cadastradas ou pendentes<br /><br />";
        }
        ?>
    </tbody>
    <tfoot>
        <tr>
            <td colspan="2" align="right">Total:</td>
            <td align="center"><?php
                $sum = $monthlies->selectSumAll();
                foreach ($sum as $monthly_sum) {
                    echo $monthly_sum->getVal();
                }
                ?></td>
        </tr>
    </tfoot>
</table>