<table>
    <thead>
        <tr>
            <th>Nome</th>
            <th>Email</th>
            <th>Telefone</th>
            <th>Celular</th>
        </tr>
    </thead>
    <tbody>

        <?php
        require_once 'classes/peoples.php';

        $peoples = new Peoples();
        $peo = $peoples->selectAll();

        $i = 1;

        if ($peo != null) {
            foreach ($peo as $people) {
                if ($i % 2 == 0) {
                    echo '<tr bgcolor="#f2f2f2">';
                } else {
                    echo '<tr>';
                }
                echo '<td>' . $people->getName() . '</td>
                    <td>' . $people->getEmail() . '</td>
                    <td>' . $people->getPhone() . '</td>
                    <td>' . $people->getCel() . '</td>';
                $i++;
            }
        } else {
            echo "Não existem pessoas cadastradas, <a href='add-people.php'>clique aqui</a> para cadastrar.<br /><br />";
        }
        ?>
    </tbody>
</table>