<div class="input">
    <label for="route">Rota:</label>
    <select name="route" id="route">
        <option value="0" selected="selected">Selecione uma rota</option>

        <?php
        require_once 'classes/routes.php';

        $routes = new Routes();

        $rou = $routes->selectAll();
        foreach ($rou as $r) {
            echo '<option value="' . $r->getId() . '">' . $r->getOri() . ' &rarr; ' . $r->getDest() . '</option>';
        }
        ?>          
    </select>
</div>