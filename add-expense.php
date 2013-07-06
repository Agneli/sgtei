<?php
include 'layout/header.php';

$type = "";
$vehicle = "";
$description = "";
$value = "";

if (isset($_POST["reg"])) {

    $type = $_POST["type"];
    $vehicle = $_POST["vehicle"];
    $description = $_POST["description"];
    $value = str_replace(',', '.', $_POST["value"]);

    if ($type == 0 || $vehicle == 0 || $description == "" || $value == "") {
        echo '<script>$(function(){fields();});</script>';
    } else {
        if (!is_numeric($value)) {
            echo '<script>var field = "Valor"; $(function(){numeric(field);});</script>';
        } else {

            require_once 'classes/expenses.php';

            $expenses = new Expenses();
            $expenses->setType($type);
            $expenses->setVeh($vehicle);
            $expenses->setDesc($description);
            $expenses->setVal($value);

            if ($expenses->insert($expenses)) {
                echo '<script>$(function(){sucess();});</script>';
            } else {
                echo '<script>$(function(){error();});</script>';
            }
        }
    }
}
?>
<div id="content">
    <a href="javascript:;" id="help" title="Ajuda"></a>
    <div id="box-help">
        <a href="javascript:;" id="close"></a>
        <ul>
            <li>No campo "Tipo" escolha o tipo de despesa a ser cadastrada.</li>
            <li>No campo "Veículo" escolha a placa do veículo referente a esta despesa.</li>
            <li>Preencha o campo "Descrição" com uma descrição da despesa a ser cadastrada.</li>
            <li>Preencha o campo "Valor" com o valor em reais (R$) da despesa. Este valor deve ser numérico e pode ser separado por ponto (.) ou virgula (,). <strong>Não utilize ponto para separar os milhares das centenas.</strong> O valor deve ser escrito da seguinte forma: <strong>1120,00</strong> ou <strong>1120.00</strong></li>
            <li>Caso tenha preenchido todos os campos e queira cadastrar, clique no botão "Cadastrar".</li>
            <li>Uma mensagem será exibida dizendo se o cadastro foi efetuado com sucesso ou se ocorreu algum erro.</li>
            <li>Caso queira cancelar, clique no botão "Cancelar".</li>
        </ul>
    </div>

    <h1>Cadastro de despesas</h1>

<?php include 'layout/msg.php'; ?>

    <form method="post" enctype="multpart/form-data">

        <div class="input">
            <label for="type">Tipo:</label>
            <select name="type" id="type">
                <option value="0" selected="selected">Selecione um tipo de despesa</option>

                <?php
                require_once 'classes/type_expenses.php';

                $type_expenses = new TypeExpenses();

                $tex = $type_expenses->selectAll();
                foreach ($tex as $type_expense) {
                    echo '<option value="' . $type_expense->getId() . '">' . $type_expense->getDesc() . '</option>';
                }
                ?>          
            </select>
        </div>

<?php include 'layout/select-vehicles.php'; ?>

        <div class="input">
            <label for="description" class="textarea">Descrição:</label>
            <textarea name="description" id="description" ><?php echo $description; ?></textarea>
        </div>

        <div class="input">
            <label for="value">Valor:</label>
            <input type="text" name="value" id="value" value="<?php echo $value; ?>" />
        </div>

        <div class="input">
            <input type="submit" name="reg" id="reg" class="btn" value="Cadastrar" />
            <input type="reset" name="can" id="can" class="btn" value="Cancelar" />
        </div>

    </form>
</div>
<?php include 'layout/footer.php'; ?>