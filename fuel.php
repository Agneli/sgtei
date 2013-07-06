<?php
include 'layout/header.php';

$val = "";
$date = "";

if (isset($_POST["reg"])) {

    $val = str_replace(',', '.', $_POST["val"]);
    $date = date("d/m/Y");

    if ($val == "") {
        echo '<script>$(function(){fields();});</script>';
    } else {
        if (!is_numeric($val)) {
            echo '<script>var field = "Valor"; $(function(){numeric(field);});</script>';
        } else {
            require_once 'classes/fuel.php';

            $fuel = new Fuel();
            $fuel->setVal($val);
            $fuel->setDate($date);

            if ($fuel->insert($fuel)) {
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
            <li>Preencha o campo "Valor" com o valor em reais (R$) do combustível. Este valor deve ser numérico e as casas decimais podem ser separadas por ponto (.) ou virgula (,). Exemplo: <strong>2,90</strong> ou <strong>2.90</strong></li>
            <li>Caso tenha preenchido todos os campos e queira alterar, clique no botão "Alterar".</li>
            <li>Uma mensagem será exibida dizendo se a alteração foi efetuada com sucesso ou se ocorreu algum erro.</li>
            <li>Caso queira cancelar, clique no botão "Cancelar".</li>
        </ul>
    </div>

    <h1>Alterar valor do combustível</h1>

    <?php include 'layout/msg.php'; ?>

    <form method="post" enctype="multpart/form-data">

        <?php
        require_once 'classes/fuel.php';

        $fuel = new Fuel();

        $fu = $fuel->select();

        if ($fu != null) {
            foreach ($fu as $fue) {

                $data = explode("-", $fue->getDate());
                $data = $data[2] . "/" . $data[1] . "/" . $data[0];

                echo 'O valor atual do combustível é de: R$ <strong>' . $fue->getVal() . '</strong> e foi alterado no dia <strong>' . $data . '</strong>';
            }
        }
        ?>

        <div class="input">
            <label for="val">Valor:</label>
            <input type="text" name="val" id="val" value="<?php echo $val; ?>" />
        </div>

        <div class="input">
            <input type="submit" name="reg" id="reg" class="btn" value="Alterar" />
            <input type="reset" name="can" id="can" class="btn" value="Cancelar" />
        </div>

    </form>

</div>
<?php include 'layout/footer.php'; ?>