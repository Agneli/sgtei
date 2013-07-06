<div class="input">
    <label for="value">Valor:</label>
    <select name="value" id="value">
        <option value="0" selected="selected">Selecione um valor</option>

        <?php
        require_once 'classes/values.php';
        require_once 'classes/students.php';


        $student = new Students();
        $student->setRa($_GET["id"]);

        $values = new Values();

        $val = $values->selectValCont($student);
        foreach ($val as $value) {
            echo '<option value="' . $value->getId() . '">R$ ' . $value->getVal() . ' - ' . $value->getDesc() . '</option>';
        }
        ?>          
    </select>
</div>