<div class="input">
    <label for="driver">Motorista:</label>
    <select name="driver" id="driver">
        <option value="0" selected="selected">Selecione um motorista</option>
        <?php
        require_once 'classes/drivers.php';
        $drivers = new Drivers();

        $dri = $drivers->selectVeh();
        foreach ($dri as $driver) {
            echo '<option value="' . $driver->getCnh() . '">' . $driver->getName() . '</option>';
        }
        ?>          
    </select>
</div>