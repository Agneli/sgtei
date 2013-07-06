<?php

require_once 'vehiclesDB.php';

class Vehicles {

    private $id;
    private $plate;
    private $aut;
    private $rou;
    private $dri;
    private $img;
    private $exp;

    function __construct($id = null, $plate = "", $aut = null, $rou = null, $dri = null, $img = "", $exp = null) {
        $this->id = $id;
        $this->plate = $plate;
        $this->aut = $aut;
        $this->rou = $rou;
        $this->dri = $dri;
        $this->img = $img;
        $this->exp = $exp;
    }

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getPlate() {
        return $this->plate;
    }

    public function setPlate($plate) {
        $this->plate = $plate;
    }

    public function getAut() {
        return $this->aut;
    }

    public function setAut($aut) {
        $this->aut = $aut;
    }

    public function getRou() {
        return $this->rou;
    }

    public function setRou($rou) {
        $this->rou = $rou;
    }

    public function getDri() {
        return $this->dri;
    }

    public function setDri($dri) {
        $this->dri = $dri;
    }

    public function getImg() {
        return $this->img;
    }

    public function setImg($img) {
        $this->img = $img;
    }

    public function getExp() {
        return $this->exp;
    }

    public function setExp($exp) {
        $this->exp = $exp;
    }

    //Métodos CRUD
    public function insert($vehicle) {
        $vdb = new VehiclesDB();
        return $vdb->insert($vehicle);
    }

    public function selectAll() {
        $vdb = new VehiclesDB();
        return $vdb->selectAll();
    }

    public function selectExpense($vehicle) {
        $vdb = new VehiclesDB();
        return $vdb->selectExpense($vehicle);
    }
    
    public function select($vehicle) {
        $vdb = new VehiclesDB();
        return $vdb->select($vehicle);
    }

    public function selectCont($vehicle) {
        $vdb = new VehiclesDB();
        return $vdb->selectCont($vehicle);
    }

    public function update($vehicle) {
        $vdb = new VehiclesDB();
        return $vdb->update($vehicle);
    }

    public function delete($id) {
        $vdb = new VehiclesDB();
        return $vdb->delete($id);
    }

}

?>
