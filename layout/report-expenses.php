<table>
    <thead>
        <tr>
            <th>Tipo</th>
            <th>Veículo</th>
            <th>Descrição</th>
            <th>Valor</th>
        </tr>
    </thead>
    <tbody>
        <?php
        require_once 'classes/expenses.php';

        $expenses = new Expenses();
        $exp = $expenses->selectAll();

        $i = 1;
        if ($exp != null) {
            foreach ($exp as $expense) {
                if ($i % 2 == 0) {
                    echo '<tr bgcolor="#f2f2f2">';
                } else {
                    echo '<tr>';
                }
                echo '<td>' . $expense->getType() . '</td>
                    <td>' . $expense->getVeh() . '</td>
                    <td>' . $expense->getDesc() . '</td>
                    <td>' . $expense->getVal() . '</td>';
                $i++;
            }
        } else {
            echo "Não existem despesas cadastradas, <a href='add-expense.php'>clique aqui</a> para cadastrar.<br /><br />";
        }
        ?>
    </tbody>
    <tfoot>
        <tr>
            <td colspan="3" align="right">Total:</td>
            <td align="center"><?php
                $sum = $expenses->selectSumAll();
                foreach ($sum as $expense_sum) {
                    echo $expense_sum->getVal();
                }
                ?></td>
        </tr>
    </tfoot>
</table>