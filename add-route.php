<?php
include 'layout/header.php';

$origin = "";
$destination = "";
$distance = "";

if (isset($_POST["reg"])) {

    if (isset($_GET["distance"])) {
        $distance = $_GET["distance"];
    }

    $origin = $_POST["origin"];
    $destination = $_POST["destination"];

    $ori = str_replace(" ", "+", $_POST["origin"]);
    $dest = str_replace(" ", "+", $_POST["destination"]);

    if ($origin == "" || $destination == "") {
        echo '<script>$(function(){fields();});</script>';
    } else {

        // Função que calcula a distância e o tempo entre duas cidades
        function distance($url, $data = null) {
            $cURL = curl_init();
            curl_setopt($cURL, CURLOPT_URL, $url . '?' . $data);
            curl_setopt($cURL, CURLOPT_RETURNTRANSFER, TRUE);
            $response = trim(curl_exec($cURL));
            curl_close($cURL);
            return $response;
        }

        $response = distance('http://maps.googleapis.com/maps/api/distancematrix/json', 'origins=' . $ori . '&destinations=' . $dest . '&mode=driving&language=pt-BR&sensor=false');
        $json = json_decode($response);
        if ($json->status == 'OK') {
            $distance = str_replace(' km', '', $json->rows[0]->elements[0]->distance->text);
            $distance = str_replace(',', '.', $distance);
            $time = $json->rows[0]->elements[0]->duration->text;
        } else {
            $distance = 0;
        }

        require_once 'classes/routes.php';

        $route = new Routes();
        $route->setOri($origin);
        $route->setDest($destination);
        $route->setDis($distance);
        $route->setTime($time);

        if ($route->insert($route)) {
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
            <li>Preencha o campo "Origem" com o nome da cidade de origem da rota. Este nome deve ser o nome completo e exato da cidade, caso o nome seja digitado de forma incorreta pode haver incoerência nos dados futuramente.</li>
            <li>Preencha o campo "Destino" com o nome da cidade de destino da rota. Este nome deve ser o nome completo e exato da cidade, caso o nome seja digitado de forma incorreta pode haver incoerência nos dados futuramente.</li>
            <li>Caso tenha preenchido todos os campos e queira cadastrar, clique no botão "Cadastrar".</li>
            <li>Uma mensagem será exibida dizendo se o cadastro foi efetuado com sucesso ou se ocorreu algum erro.</li>
            <li>Caso queira cancelar, clique no botão "Cancelar".</li>
        </ul>
    </div>
    
    <h1>Cadastro de Rotas</h1>

    <?php include 'layout/msg.php'; ?>

    <form method="post" enctype="multpart/form-data">
        <div class="input">
            <label for="origin">Origem:</label>
            <input type="text" name="origin" id="origin" value="<?php echo $origin; ?>" />
        </div>

        <div class="input">
            <label for="destination">Destino:</label>
            <input type="text" name="destination" id="destination" value="<?php echo $destination; ?>" />
        </div>

        <div class="input">
            <input type="submit" name="reg" id="reg" class="btn" value="Cadastrar" />
            <input type="reset" name="can" id="can" class="btn" value="Cancelar" />
        </div>

    </form>
</div>
<?php include 'layout/footer.php'; ?>