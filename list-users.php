<?php
include 'layout/header.php';

require_once 'classes/users.php';

$users = new Users();
?>

<div id="content">
    <a href="javascript:;" id="help" title="Ajuda"></a>
    <div id="box-help">
        <a href="javascript:;" id="close"></a>
        <ul>
            <li>Para editar as informações de um usuário, clique no link "Editar" referente ao usuário em questão.</li>
        </ul>
    </div>

    <h1>Lista de Usuários</h1>

    <?php
    include 'layout/msg-del.php';

    $use = $users->selectAll();

    if ($use != null) {
        foreach ($use as $user) {

            $user->getLevel() == "a" ? $_level = "Administrador" : $_level = "Usuário";

            echo '<div class="box-pes">
        <img src="images/peoples/' . $user->getImg() . '" alt="' . $user->getName() . '" title="' . $user->getName() . '" />
        <div class="info">
            <span>Tipo:</span>Usuário do sistema<br />
            <span>Nível:</span>' . $_level . '<br />
            <span>Nome:</span>' . $user->getName() . '<br />
            <span>E-mail:</span>' . $user->getEmail() . '<br />
            <span>Fone:</span>' . $user->getPhone() . '<br />
            <span>Cel:</span>' . $user->getCel() . '<br />
        </div>
        <div class="actions">
            <ul>
                <li><a href="add-people.php?id=' . $user->getPeo() . '&type=user&level=' . $user->getLevel() . '" class="edit"><span></span>Editar</a></li>
            </ul>
        </div>
    </div>';
        }
    } else {
        echo "Não existem usuários cadastrados, <a href='add-people.php'>clique aqui</a> para cadastrar.";
    }
    ?>

</div>
<?php include 'layout/footer.php'; ?>