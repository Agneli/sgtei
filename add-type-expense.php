<?php
include 'layout/header.php';

$description = "";

if (isset($_POST["reg"])) {

    $description = $_POST["description"];

    if ($description == "") {
        echo '<script>$(function(){fields();});</script>';
    } else {
        require_once 'classes/type_expenses.php';

        $type_expenses = new TypeExpenses();
        $type_expenses->setDesc($description);

        if ($type_expenses->insert($type_expenses)) {
            echo '<script>$(function(){sucess();});</script>';
        } else {
            echo '<script>$(function(){error();});</script>';
        }
    }
}
?>
<div id="content">
    <a href="javascript:;" id="help" title="Ajuda"></a>
    <div id="box-help">
        <a href="javascript:;" id="close"></a>
        <ul>
            <li>Preencha o campo "Descrição" com uma breve descrição do tipo de despesa a ser cadastrada. Esta descrição servirá apenas para identificar as despesas cadastradas futuramente.</li>
            <li>Caso tenha preenchido todos os campos e queira cadastrar, clique no botão "Cadastrar".</li>
            <li>Uma mensagem será exibida dizendo se o cadastro foi efetuado com sucesso ou se ocorreu algum erro.</li>
            <li>Caso queira cancelar, clique no botão "Cancelar".</li>
        </ul>
    </div>
    
    <h1>Cadastro de tipo de despesa</h1>

    <?php include 'layout/msg.php'; ?>

    <form method="post" enctype="multpart/form-data">

        <div class="input">
            <label for="description">Descrição:</label>
            <input type="text" name="description" id="description" value="<?php echo $description; ?>" />
        </div>

        <div class="input">
            <input type="submit" name="reg" id="reg" class="btn" value="Cadastrar" />
            <input type="reset" name="can" id="can" class="btn" value="Cancelar" />
        </div>

    </form>
</div>
<?php include 'layout/footer.php'; ?>