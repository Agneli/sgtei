<?php

class FuelDB extends Database {

    public function insert(Fuel $fuel) {
        $db = new Database();
        $sql = "INSERT INTO fuel (fue_val, fue_date) VALUES (:val, :date)";

        $data = array(
            ":val" => $fuel->getVal(),
            ":date" => $fuel->getDate()
        );

        if ($db->cud($sql, $data)) {
            return true;
        } else {
            return false;
        }
    }

    public function select() {
        $list = null;

        $db = new Database();
        $sql = "SELECT * FROM fuel ORDER BY fue_id DESC LIMIT 1";

        if ($result = $db->read($sql)) {

            foreach ($result as $row) {
                $fuel = new Fuel();
                $fuel->setVal($row->fue_val);
                $fuel->setDate($row->fue_date);
                $list[] = $fuel;
            }
        }
        return $list;
    }

}

?>
