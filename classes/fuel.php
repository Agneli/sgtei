<?php

require_once 'fuelDB.php';

class Fuel {

    private $id;
    private $val;
    private $date;

    function __construct($id = null, $val = null, $date = "") {
        $this->id = $id;
        $this->val = $val;
        $this->date = $date;
    }

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getVal() {
        return $this->val;
    }

    public function setVal($val) {
        $this->val = $val;
    }

    public function getDate() {
        return $this->date;
    }

    public function setDate($date) {
        $this->date = $date;
    }

    public function insert($fuel) {
        $fdb = new FuelDB();
        return $fdb->insert($fuel);
    }
    
    public function select() {
        $fdb = new FuelDB();
        return $fdb->select();
    }

}

?>
