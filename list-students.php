<?php
include 'layout/header.php';

require_once 'classes/students.php';

$students = new Students();
?>

<div id="content">
    <a href="javascript:;" id="help" title="Ajuda"></a>
    <div id="box-help">
        <a href="javascript:;" id="close"></a>
        <ul>
            <li>Para editar as informações de um aluno, clique no link "Editar" referente ao aluno em questão.</li>
            <li>Para acessar a página de contrato do aluno aluno, clique no link "Contrato" referente ao aluno em questão.</li>
        </ul>
    </div>

    <h1>Lista de Alunos</h1>

    <?php
    include 'layout/msg-del.php';

    $stu = $students->selectAll();

    if ($stu != null) {
        foreach ($stu as $student) {
            echo '<div class="box-pes">
        <img src="images/peoples/' . $student->getImg() . '" alt="' . $student->getName() . '" title="' . $student->getName() . '" />
        <div class="info">
            <span>Tipo:</span>Aluno<br />
            <span>Nome:</span>' . $student->getName() . '<br />
            <span>E-mail:</span>' . $student->getEmail() . '<br />
            <span>Fone:</span>' . $student->getPhone() . '<br />
            <span>Cel:</span>' . $student->getCel() . '<br />
            <span>R.A:</span>' . $student->getRa() . '
        </div>
        <div class="actions">
            <ul>
                <li><a href="add-people.php?id=' . $student->getPeo() . '&type=student" class="edit"><span></span>Editar</a></li>
                <li><a href="contracts.php?id=' . $student->getRa() . '" class="contract"><span></span>Contrato</a></li>
            </ul>
        </div>
    </div>';
        }
    } else {
        echo "Não existem alunos cadastrados, <a href='add-people.php'>clique aqui</a> para cadastrar.";
    }
    ?>

</div>
<?php include 'layout/footer.php'; ?>