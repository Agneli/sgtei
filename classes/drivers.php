<?php

require_once 'peoples.php';
require_once 'driversDB.php';

class Drivers extends Peoples {

    private $cnh;
    private $peo;

    function __construct($id = null, $name = "", $email = "", $phone = "", $cel = "", $cnh = null, $peo = null) {
        parent::__construct($id, $name, $email, $phone, $cel);
        $this->cnh = $cnh;
        $this->peo = $peo;
    }

    public function getCnh() {
        return $this->cnh;
    }

    public function setCnh($cnh) {
        $this->cnh = $cnh;
    }

    public function getPeo() {
        return $this->peo;
    }

    public function setPeo($peo) {
        $this->peo = $peo;
    }

    public function insert($driver) {
        $ddb = new DriversDB();
        return $ddb->insert($driver);
    }

    public function selectAll() {
        $ddb = new DriversDB();
        return $ddb->selectAll();
    }

    public function selectVeh() {
        $ddb = new DriversDB();
        return $ddb->selectVeh();
    }

}

?>
