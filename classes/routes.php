<?php

require_once 'routesDB.php';

class Routes {

    private $id;
    private $ori;
    private $dest;
    private $dis;
    private $time;

    function __construct($id = null, $ori = "", $dest = "", $dis = null, $time = "") {
        $this->id = $id;
        $this->ori = $ori;
        $this->dest = $dest;
        $this->dis = $dis;
        $this->time = $time;
    }

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getOri() {
        return $this->ori;
    }

    public function setOri($ori) {
        $this->ori = $ori;
    }

    public function getDest() {
        return $this->dest;
    }

    public function setDest($dest) {
        $this->dest = $dest;
    }

    public function getDis() {
        return $this->dis;
    }

    public function setDis($dis) {
        $this->dis = $dis;
    }

    public function getTime() {
        return $this->time;
    }

    public function setTime($time) {
        $this->time = $time;
    }

    public function insert($route) {
        $rdb = new RoutesDB();
        return $rdb->insert($route);
    }

    public function selectAll() {
        $rdb = new RoutesDB();
        return $rdb->selectAll();
    }

    public function select($route) {
        $rdb = new RoutesDB();
        return $rdb->select($route);
    }

}

?>
