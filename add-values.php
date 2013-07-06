<?php
include 'layout/header.php';

$description = "";
$val = "";
$route = "";

if (isset($_POST["reg"])) {

    $description = $_POST["description"];
    $val = str_replace(',', '.', $_POST["value"]);
    $route = $_POST["route"];

    if ($description == "" || $val == "" || $route == 0) {
        echo '<script>$(function(){fields();});</script>';
    } else {
        if(!is_numeric($val)) {
            echo '<script>var field = "Valor"; $(function(){numeric(field);});</script>';
        } else {
            require_once 'classes/values.php';

            $value = new Values();
            $value->setDesc($description);
            $value->setVal($val);
            $value->setRou($route);

            if ($value->insert($value)) {
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
            <li>Preencha o campo "Descrição" com uma descrilçao do valor a ser cadastrado, por exemplo: Mensalidade integral</li>
            <li>Preencha o campo "Valor" com o valor em reais (R$) da mensalidade. Este valor deve ser numérico e as casas decimais podem ser separadas por ponto (.) ou virgula (,). Exemplo: <strong>180,00</strong> ou <strong>180.00</strong>. Ou ainda podem ser cadastrados sem casas decimais como por exemplo: <strong>180</strong>, que equivale a R$ 180,00.</li>
            <li>No campo "Rota" escolha a rota na qual o valor deve ser adicionado.</li>
            <li>Caso tenha preenchido todos os campos e queira cadastrar, clique no botão "Cadastrar".</li>
            <li>Uma mensagem será exibida dizendo se o cadastro foi efetuado com sucesso ou se ocorreu algum erro.</li>
            <li>Caso queira cancelar, clique no botão "Cancelar".</li>
        </ul>
    </div>

    <h1>Cadastro de valores</h1>

    <?php include 'layout/msg.php'; ?>

    <form method="post" enctype="multpart/form-data">

        <div class="input">
            <label for="description">Descrição:</label>
            <input type="text" name="description" id="description" value="<?php echo $description; ?>" />
        </div>

        <div class="input">
            <label for="value">Valor:</label>
            <input type="text" name="value" id="value" value="<?php echo $val; ?>" />
        </div>

        <?php include 'layout/select-routes.php'; ?>

        <div class="input">
            <input type="submit" name="reg" id="reg" class="btn" value="Cadastrar" />
            <input type="reset" name="can" id="can" class="btn" value="Cancelar" />
        </div>

    </form>
</div>
<?php include 'layout/footer.php'; ?>