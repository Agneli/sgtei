<?php
include 'layout/header.php';
require_once 'classes/vehicles.php';

$vehicles = new Vehicles();

$plate = "";
$autonomy = "";
$driver = "";
$route = "";
$image = "";
$var = 1;

if (isset($_GET["id"])) {
    $id = $_GET["id"];
    $vehicles->setId($id);
    $veh = $vehicles->select($vehicles);

    foreach ($veh as $vehicle) {
        $plate = $vehicle->getPlate();
        $autonomy = $vehicle->getAut();
        $driver = $vehicle->getDri();
        $route = $vehicle->getRou();
        $image = $vehicle->getImg();
    }
} else {
    $id = "";
}

if (isset($_POST["reg"]) || isset($_POST['up'])) {

    $plate = strtoupper($_POST["plate"]);
    $autonomy = $_POST["autonomy"];
    $driver = $_POST["driver"];
    $route = $_POST["route"];
    $id = $_POST["id"];

    if ($plate == "" || $autonomy == "" || $driver == 0 || $route == 0) {
        echo '<script>$(function(){fields();});</script>';
    } else {
        if (!is_numeric($autonomy)) {
            echo '<script>var field = "Autonomia"; $(function(){numeric(field);});</script>';
        } else {
            //Upload imagem$img_url
            if (!empty($_FILES["image"]["tmp_name"])) {
                $image = $_FILES["image"];
                require("classes/upload.php");

                $img_folder = 'images/vehicles';
                $img_permitted = array('image/jpg', 'image/jpeg', 'image/pjpg');
                if ($image['name'] != "") {

                    $img_name = $image['name'];
                    $img_tmp = $image['tmp_name'];
                    $img_type = $image['type'];

                    if (!empty($img_name) && in_array($img_type, $img_permitted)) {
                        $img_url = md5(uniqid(rand(), true)) . '.jpg';
                        resize($img_tmp, $img_url, 113, $img_folder);
                        $var = 1;
                    } else {
                        echo "<script>alert('Envie apenas imagens no formato .jpg');</script>";
                        $var = 0;
                    }
                }
            } else {
                $img_url = "default.jpg";
            }

            if ($var == 1) {
                $vehicles->setPlate($plate);
                $vehicles->setAut($autonomy);
                $vehicles->setRou($route);
                $vehicles->setDri($driver);
                $vehicles->setImg($img_url);
                $vehicles->setId($id);

                if (isset($_POST['up'])) {
                    if ($vehicles->update($vehicles)) {
                        echo '<script>$(function(){up_sucess();});</script>';
                    } else {
                        echo '<script>$(function(){up_error();});</script>';
                    }
                } else {
                    if ($vehicles->insert($vehicles)) {
                        echo '<script>$(function(){sucess();});</script>';
                    } else {
                        echo '<script>$(function(){error();});</script>';
                    }
                }
            }
        }
    }
}

//Atualização
?>
<div id="content">
    <a href="javascript:;" id="help" title="Ajuda"></a>
    <div id="box-help">
        <a href="javascript:;" id="close"></a>
        <ul>
            <li>Preencha o campo "Placa" com a placa do veículo a ser cadastrado. Esta placa deve estar no formato AAA-9999</li>
            <li>Preencha o campo "Autonomia" com a autonomia do veículo. Este valor é referente a quantos quilometros o veículo anda com 1 litro de combustível.</li>
            <li>No campo "Motorista" escolha o nome do motorista que será responsável pelo veículo. Nesta lista só aparecem os motoristas que não estão responsáveis por nenhum veículo.</li>
            <li>No campo "Rota" escolha a rota na qual o veículo irá trafegar.</li>
            <li>No campo "Imagem", clique em "Selecionar Arquivo" e escolha uma imagem de seu computador no formato .JPG.</li>
            <li>Caso tenha preenchido todos os campos e queira cadastrar, clique no botão "Cadastrar".</li>
            <li>Uma mensagem será exibida dizendo se o cadastro foi efetuado com sucesso ou se ocorreu algum erro.</li>
            <li>Caso queira cancelar, clique no botão "Cancelar".</li>
        </ul>
    </div>

    <h1>Cadastro de Veículos</h1>

<?php include 'layout/msg.php'; ?>

    <form method="post" action="add-vehicle.php" enctype="multipart/form-data">

        <input type="hidden" name="id" value="<?php echo $id; ?>" />

        <div class="input">
            <label for="plate">Placa:</label>
            <input type="text" name="plate" id="plate" value="<?php echo $plate; ?>" />
        </div>

        <div class="input">
            <label for="autonomy">Autonomia:</label>
            <input type="text" name="autonomy" id="autonomy" value="<?php echo $autonomy; ?>" />
        </div>

        <?php include 'layout/select-drivers.php'; ?>

<?php include 'layout/select-routes.php'; ?>

        <div class="input">
            <label for="image">Imagem:</label>
            <div class="box-input box-image">
                <input type="file" name="image" id="image" accept="image/*"/>
            </div>
        </div>

        <div class="input">

            <?php
            if (isset($_GET["id"])) {
                echo '<input type="submit" name="up" id="up" class="btn" value="Atualizar" />';
            } else {
                echo '<input type="submit" name="reg" id="reg" class="btn" value="Cadastrar" />';
            }
            ?>

            <input type="reset" name="can" id="can" class="btn" value="Cancelar" />
        </div>

    </form>
</div>
<?php include 'layout/footer.php'; ?>