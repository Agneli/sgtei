<?php

require_once 'contractsDB.php';

class Contracts {

    private $id;
    private $per;
    private $stu;
    private $rou;
    private $veh;
    private $val;

    function __construct($id = null, $per = null, $stu = null, $rou = null, $veh = null, $val = null) {
        $this->id = $id;
        $this->per = $per;
        $this->stu = $stu;
        $this->rou = $rou;
        $this->veh = $veh;
        $this->val = $val;
    }

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getPer() {
        return $this->per;
    }

    public function setPer($per) {
        $this->per = $per;
    }

    public function getStu() {
        return $this->stu;
    }

    public function setStu($stu) {
        $this->stu = $stu;
    }

    public function getRou() {
        return $this->rou;
    }

    public function setRou($rou) {
        $this->rou = $rou;
    }

    public function getVeh() {
        return $this->veh;
    }

    public function setVeh($veh) {
        $this->veh = $veh;
    }

    public function getVal() {
        return $this->val;
    }

    public function setVal($val) {
        $this->val = $val;
    }
    
    public function insert($contract){
        $cdb = new ContractsDB();
        return $cdb->insert($contract);
    }
    
    public function select($contract){
        $cdb = new ContractsDB();
        return $cdb->select($contract);
    }

}

?>
