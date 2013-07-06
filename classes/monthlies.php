<?php

require_once 'monthliesDB.php';

class Monthlies {

    private $id;
    private $mon;
    private $status;
    private $val;
    private $cont;
    private $ra;

    function __construct($id = null, $mon = null, $status = "", $val = null, $cont = null, $ra = "") {
        $this->id = $id;
        $this->mon = $mon;
        $this->status = $status;
        $this->val = $val;
        $this->cont = $cont;
        $this->ra = $ra;
    }

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getMon() {
        return $this->mon;
    }

    public function setMon($mon) {
        $this->mon = $mon;
    }

    public function getStatus() {
        return $this->status;
    }

    public function setStatus($status) {
        $this->status = $status;
    }

    public function getVal() {
        return $this->val;
    }

    public function setVal($val) {
        $this->val = $val;
    }

    public function getCont() {
        return $this->cont;
    }

    public function setCont($cont) {
        $this->cont = $cont;
    }

    public function getRa() {
        return $this->ra;
    }

    public function setRa($ra) {
        $this->ra = $ra;
    }

    public function insert($monthly) {
        $mdb = new MonthliesDB();
        return $mdb->insert($monthly);
    }
    
    public function selectAll() {
        $mdb = new MonthliesDB();
        return $mdb->selectAll();
    }
    
    public function selectSumAll() {
        $mdb = new MonthliesDB();
        return $mdb->selectSumAll();
    }

    public function select($monthly) {
        $mdb = new MonthliesDB();
        return $mdb->select($monthly);
    }
    
    public function pay($monthly) {
        $mdb = new MonthliesDB();
        return $mdb->pay($monthly);
    }
    
}

?>
