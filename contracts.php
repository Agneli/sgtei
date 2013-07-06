<?php
include 'layout/header.php';

$period = "";
$student = "";
$route = "";
$vehicle = "";
$value = "";

if (isset($_GET["id"])) {
    $ra = $_GET["id"];
}

if (isset($_POST["reg"])) {

    $student = $_GET["id"];
    $period = $_POST["period"];
    $route = $_POST["route"];
    $vehicle = $_POST["vehicle"];
    $value = $_POST["value"];

    if ($period == "" || $student == "" || $route == 0 || $vehicle == 0 || $value == 0) {
        echo '<script>$(function(){fields();});</script>';
    } else {
        require_once 'classes/contracts.php';
        require_once 'classes/monthlies.php';

        $contract = new Contracts();
        $contract->setPer($period);
        $contract->setStu($student);
        $contract->setRou($route);
        $contract->setVeh($vehicle);
        $contract->setVal($value);

        if ($contract->insert($contract)) {

            for ($i = 1; $i <= $period; $i++) {

                $monthlies = new Monthlies();
                $monthlies->setMon($i);
                $monthlies->setStatus("pd");
                $monthlies->setVal($value);

                $monthlies->insert($monthlies);
            }

            echo '<script>$(function(){sucess();});</script>';
        } else {
            echo '<script>$(function(){error();});</script>';
        }
    }
}

//
if (isset($_GET["pay"])) {
    if ($_GET["pay"] == "ok") {
        echo "<script>alert('Mensalidade baixada com sucesso');</script>";
    } else {
        echo "<script>alert('Erro ao dar baixa em mensalidade');</script>";
    }
}
?>
<div id="content">
    <a href="javascript:;" id="help" title="Ajuda"></a>
    <div id="box-help">
        <a href="javascript:;" id="close"></a>
        <ul>
            <li>No campo "Período" marque uma das duas opções disponíveis.</li>
            <li>No campo "Rota" selecione a rota referente ao contrato a ser cadastrado.</li>
            <li>No campo "Veículo" selecione o veículo referente ao contrato a ser cadastrado.</li>
            <li>No campo "Valor" selecione o valor referente ao contrato a ser cadastrado.</li>
            <li>Caso tenha preenchido todos os campos e queira cadastrar, clique no botão "Cadastrar".</li>
            <li>Uma mensagem será exibida dizendo se o cadastro foi efetuado com sucesso ou se ocorreu algum erro.</li>
            <li>Caso queira cancelar, clique no botão "Cancelar".</li>
            <li>Após efetuar o cadastro as mensalidades serão exibidas abaixo.</li>
        </ul>
    </div>

    <h1>Novo contrato</h1>

    <?php include 'layout/msg.php'; ?>

    <form method="post">

        <div class="input">
            <label>Período:</label>
            <div class="box-input">
                <input type="radio" name="period" id="six" value="6" /><label for="six" class="radio">6 meses</label>
                <input type="radio" name="period" id="twelve" value="12" checked="checked" /><label for="twelve" class="radio">12 meses</label>
            </div>
        </div>

        <?php include 'layout/select-routes.php'; ?>

        <div class="input vehicle">
            <label for="vehicle">Veículo:</label>
            <select name="vehicle" id="vehicle">
                <option value="0" selected="selected">Selecione um veículo</option>         
            </select>
        </div>

        <?php include 'layout/select-val-cont.php'; ?>


        <div class="input">
            <input type="submit" name="reg" id="reg" class="btn" value="Cadastrar" />
            <input type="reset" name="can" id="can" class="btn" value="Cancelar" />
        </div>

    </form>
    <br /><br /><hr /><br /><br />

    <h1>Contrato vigente - <a href="pdf.php?ra=<?php echo $_GET['id']; ?>">Gerar PDF</a></h1>

    <table>
        <thead>
            <tr>
                <th>Mês</th>
                <th>Valor</th>
                <th>Situação</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>

            <?php
            require_once 'classes/monthlies.php';
            $monthlies = new Monthlies();
            $monthlies->setRa($ra);
            $mon = $monthlies->select($monthlies);

            $months = ["Janeiro", "Fevereiro", "Março", "Abril", "Maio", "Junho", "Julho", "Agosto", "Setembro", "Outubro", "Novembro", "Dezembro"];

            if ($mon != null) {
                foreach ($mon as $monthly) {

                    if ($monthly->getStatus() == "pd") {
                        $status = "Pendente";
                        $actions = '<ul>
                    <li><a href="_pay-monthly.php?id=' . $monthly->getId() . '&ra=' . $ra . '" class="ok" title="Dar baixa" onclick="return confirm(\'Confirmar pagamento desta mensalidade ?\');"><span></span></a></li>
                    <li><a href="javascript:;" class="mail" title="Enviar cobrança" onclick="return confirm(\'Confirmar envio de cobrança do mês de ' . $months[$monthly->getMon() - 1] . ' ?\');"><span></span></a></li>
                </ul>';
                    } else {
                        $status = "Pago";
                        $actions = '';
                    }

                    if ($monthly->getId() % 2 == 0) {
                        if ($monthly->getMon() == date("n")) {
                            echo '<tr bgcolor="#ff6">';
                        } else {
                            echo '<tr bgcolor="#f2f2f2">';
                        }
                    } else {
                        if ($monthly->getMon() == date("n")) {
                            echo '<tr bgcolor="#ff6">';
                        } else {
                            echo '<tr>';
                        }
                    }

                    echo '
                    <td>' . $monthly->getMon() . ' (' . $months[$monthly->getMon() - 1] . ' / ' . date("Y") . ')</td>
            <td>R$ ' . $monthly->getVal() . '</td>
            <td>' . $status . '</td>
            <td>' . $actions . '</td>
            </tr>';
                }
            }
            ?>
        </tbody>
    </table>

</div>
<?php include 'layout/footer.php'; ?>