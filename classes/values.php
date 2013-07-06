<?php

require_once 'valuesDB.php';

class Values {

    private $id;
    private $desc;
    private $val;
    private $rou;

    function __construct($id = null, $desc = "", $val = null, $rou = null) {
        $this->id = $id;
        $this->desc = $desc;
        $this->val = $val;
        $this->rou = $rou;
    }

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getDesc() {
        return $this->desc;
    }

    public function setDesc($desc) {
        $this->desc = $desc;
    }

    public function getVal() {
        return $this->val;
    }

    public function setVal($val) {
        $this->val = $val;
    }

    public function getRou() {
        return $this->rou;
    }

    public function setRou($rou) {
        $this->rou = $rou;
    }

    public function insert($value) {
        $vdb = new ValuesDB();
        return $vdb->insert($value);
    }

    public function selectAll() {
        $vdb = new ValuesDB();
        return $vdb->selectAll();
    }

    public function select($value) {
        $vdb = new ValuesDB();
        return $vdb->select($value);
    }
    
    public function selectValRou($value) {
        $vdb = new ValuesDB();
        return $vdb->selectValRou($value);
    }
    
    public function selectValCont($value) {
        $vdb = new ValuesDB();
        return $vdb->selectValCont($value);
    }

}

?>
