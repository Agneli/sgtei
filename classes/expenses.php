<?php

require_once 'expensesDB.php';

class Expenses {

    private $id;
    private $desc;
    private $val;
    private $veh;
    private $type;

    function __construct($id = null, $desc = "", $val = null, $veh = null, $type = null) {
        $this->id = $id;
        $this->desc = $desc;
        $this->val = $val;
        $this->veh = $veh;
        $this->type = $type;
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

    public function getVeh() {
        return $this->veh;
    }

    public function setVeh($veh) {
        $this->veh = $veh;
    }

    public function getType() {
        return $this->type;
    }

    public function setType($type) {
        $this->type = $type;
    }
    
    public function insert($expense) {
        $edb = new ExpensesDB();
        return $edb->insert($expense);
    }
    
    public function selectAll() {
        $edb = new ExpensesDB();
        return $edb->selectAll();
    }
    
    public function selectSumAll() {
        $edb = new ExpensesDB();
        return $edb->selectSumAll();
    }
    
    public function selectSum($vehicle) {
        $edb = new ExpensesDB();
        return $edb->selectSum($vehicle);
    }

}

?>
