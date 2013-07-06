<div class="input vehicle">
    <label for="vehicle">Veículo:</label>
    <select name="vehicle" id="vehicle">
        <option value="0" selected="selected">Selecione um veículo</option>

        <?php
        require_once 'classes/vehicles.php';

        $vehicles = new Vehicles();

        $veh = $vehicles->selectAll();
        foreach ($veh as $vehicle) {
            echo '<option value="' . $vehicle->getId() . '">' . $vehicle->getPlate() . '</option>';
        }
        ?>          
    </select>
</div>