<?php
include 'layout/header.php';
require_once 'classes/peoples.php';

$peoples = new Peoples();

$type = "";
$level = "";
$name = "";
$email = "";
$phone = "";
$cellular = "";
$document = "";
$image = "";
$var = 1;
$id = "";
$_type = "student";

if (isset($_GET["id"]) && isset($_GET["type"])) {
    $id = $_GET["id"];
    $_type = $_GET["type"];
    $peoples->setId($id);
    $peo = $peoples->select($peoples);

    foreach ($peo as $people) {
        $name = $people->getName();
        $email = $people->getEmail();
        $phone = $people->getPhone();
        $cellular = $people->getCel();
    }
} else {
    $id = "";
}

if (isset($_POST["reg"])) {

    $type = $_POST["type"];
    $level = $_POST["level"];
    $name = $_POST["name"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $cellular = $_POST["cellular"];
    $document = $_POST["document"];

    if ($type == "" || $name == "" || $email == "" || $phone == "" || $cellular == "" || $document == "") {
        echo '<script>$(function(){fields();});</script>';
    } else {
        if (!preg_match('/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/', $email)) {
            echo '<script>var field = "Ra"; $(function(){email();});</script>';
        } else {
            //Upload imagem$img_url
            if (!empty($_FILES["image"]["tmp_name"])) {
                $image = $_FILES["image"];
                require("classes/upload.php");

                $img_folder = 'images/peoples';
                $img_permitted = array('image/jpg', 'image/jpeg', 'image/pjpg');
                if ($image['name'] != "") {

                    $img_name = $image['name'];
                    $img_tmp = $image['tmp_name'];
                    $img_type = $image['type'];

                    if (!empty($img_name) && in_array($img_type, $img_permitted)) {
                        $img_url = md5(uniqid(rand(), true)) . '.jpg';
                        resize($img_tmp, $img_url, 85, $img_folder);
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

                if ($type == "s") {

                    require_once 'classes/students.php';
                    $students = new Students();

                    $students->setName($name);
                    $students->setEmail($email);
                    $students->setPhone($phone);
                    $students->setCel($cellular);
                    $students->setImg($img_url);
                    $students->setRa($document);

                    $sql_stu = $students->insert($students);

                    if ($sql_stu) {
                        echo '<script>$(function(){sucess();});</script>';
                    } else {
                        echo '<script>$(function(){error();});</script>';
                    }
                }
            }

            if ($type == "d") {

                require_once 'classes/drivers.php';
                $drivers = new Drivers();

                $drivers->setName($name);
                $drivers->setEmail($email);
                $drivers->setPhone($phone);
                $drivers->setCel($cellular);
                $drivers->setImg($img_url);
                $drivers->setCnh($document);

                $sql_dri = $drivers->insert($drivers);

                if ($sql_dri) {
                    echo '<script>$(function(){sucess();});</script>';
                } else {
                    echo '<script>$(function(){error();});</script>';
                }
            }

            if ($type == "u") {

                if ($level == "") {
                    echo '<script>$(function(){fields();});</script>';
                } else {

                    require_once 'classes/users.php';
                    $users = new Users();

                    $users->setName($name);
                    $users->setEmail($email);
                    $users->setPhone($phone);
                    $users->setCel($cellular);
                    $users->setImg($img_url);
                    $users->setLogin($email);
                    $users->setPass($document);
                    $users->setLevel($level);

                    if ($users->insert($users)) {
                        echo '<script>$(function(){sucess();});</script>';
                    } else {
                        echo '<script>$(function(){error();});</script>';
                    }
                }
            }
        }
    }
}
if (isset($_POST["up"])) {

    $id = $_POST["id"];
    $name = $_POST["name"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $cellular = $_POST["cellular"];

    if ($name == "" || $email == "" || $phone == "" || $cellular == "") {
        echo '<script>$(function(){fields();});</script>';
    } else {
        if (!preg_match('/^[^\W][a-zA-Z0-9_]+(\.[a-zA-Z0-9_]+)*\@[a-zA-Z0-9_]+(\.[a-zA-Z0-9_]+)*\.[a-zA-Z]{2,4}$/', $email)) {
            echo '<script>var field = "Ra"; $(function(){email();});</script>';
        } else {
            require_once 'classes/peoples.php';
            $peoples = new Peoples();

            $peoples->setId($id);
            $peoples->setName($name);
            $peoples->setEmail($email);
            $peoples->setPhone($phone);
            $peoples->setCel($cellular);

            if ($peoples->update($peoples)) {
                echo '<script>$(function(){up_sucess();});</script>';
            } else {
                echo '<script>$(function(){up_error();});</script>';
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
            <li>No campo "Tipo" marque uma das três opções disponíveis.</li>
            <li>Preencha o campo "Nome" com o nome da pessoa a ser cadastrada.</li>
            <li>Preencha o campo "E-mail" com o email da pessoa. Este deve ser um e-mail válido.</li>
            <li>Preencha o campo "Telefone" com um número no formato (99)9999-9999</li>
            <li>Preencha o campo "Celular" com um número no formato (99)9999-9999</li>

        </ul>

        <strong>Caso a opção escolhida no campo "Tipo" seja "Aluno", siga os seguintes passos:</strong>
        <ul>
            <li>Preencha o campo "RA" com o número do registro acadêmico do aluno. Este número deve conter 10 dígitos.</li>
        </ul>

        <strong>Caso a opção escolhida no campo "Tipo" seja "Motorista", siga os seguintes passos:</strong>
        <ul>
            <li>Preencha o campo "CNH" com o número da Carteira Nacional de Habilitação do motorista. Este número deve conter 11 dígitos.</li>
        </ul>

        <strong>Caso a opção escolhida no campo "Tipo" seja "Usuário", siga os seguintes passos:</strong>
        <ul>
            <li>No campo "Nível" marque uma das duas opções disponíveis.</li>
            <li>Preencha o campo "Senha" com uma sequência de caracteres de sua escolha.</li>
        </ul>
        <hr />
        <ul>
            <li>No campo "Imagem", clique em "Selecionar Arquivo" e escolha uma imagem de seu computador no formato .JPG.</li>
            <li>Caso tenha preenchido todos os campos e queira cadastrar, clique no botão "Cadastrar".</li>
            <li>Uma mensagem será exibida dizendo se o cadastro foi efetuado com sucesso ou se ocorreu algum erro.</li>
            <li>Caso queira cancelar, clique no botão "Cancelar".</li>
        </ul>
    </div>

    <h1>Cadastro de Pessoas</h1>

    <?php include 'layout/msg.php'; ?>

    <form method="post" action="add-people.php" enctype="multipart/form-data">

        <div class="input">
            <input type="hidden" name="id" value="<?php echo $id ?>" />
            <label>Tipo:</label>
            <div class="box-input">
                <input type="radio" name="type" id="s" value="s" <?php
                if ($_type == "student") {
                    echo 'checked="checked"';
                }
                ?> /><label for="s" class="radio">Aluno</label>
                <input type="radio" name="type" id="d" value="d" <?php
                if ($_type == "driver") {
                    echo 'checked="checked"';
                }
                ?> /><label for="d" class="radio">Motorista</label>
                <input type="radio" name="type" id="u" value="u" <?php
                if ($_type == "user") {
                    echo 'checked="checked"';
                }
                ?> /><label for="u" class="radio">Usuário</label>
            </div>
        </div>

        <div class="input level">
            <label>Nível:</label>
            <div class="box-input">
                <input type="radio" name="level" id="a" value="a" checked="checked" /><label for="a" class="radio">Adinistrador</label>
                <input type="radio" name="level" id="us" value="u" /><label for="u" class="radio">Usuário</label>
            </div>
        </div>

        <div class="input">
            <label for="name">Nome:</label>
            <input type="text" name="name" id="name" value="<?php echo $name; ?>" />
        </div>

        <div class="input">
            <label for="email">E-mail:</label>
            <input type="text" name="email" id="email" value="<?php echo $email; ?>" />
        </div>

        <div class="input">
            <label for="phone">Telefone:</label>
            <input type="text" name="phone" id="phone" value="<?php echo $phone; ?>" />

            <label for="cellular">Celular:</label>
            <input type="text" name="cellular" id="cellular" value="<?php echo $cellular; ?>" />
        </div>

        <?php
        if (!isset($_GET["id"])) {

            echo '<div class="input">
            <label id="lb-document">R.A:</label>
            <input type="text" name="document" id="ra" />
        </div>

        <div class="input">
            <label for="image">Imagem:</label>
            <div class="box-input box-image">
                <input type="file" name="image" id="image" accept="image/*"/>
            </div>
        </div>';
        }
        ?>

        <div class = "input">

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