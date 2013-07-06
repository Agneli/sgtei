<?php

require_once 'peoples.php';
require_once 'studentsDB.php';

class Students extends Peoples {

    private $ra;
    private $peo;

    public function __construct($id = null, $name = "", $email = "", $phone = "", $cel = "", $ra = null, $peo = null) {
        parent::__construct($id, $name, $email, $phone, $cel);
        $this->ra = $ra;
        $this->peo = $peo;
    }

    public function getRa() {
        return $this->ra;
    }

    public function setRa($ra) {
        $this->ra = $ra;
    }

    public function getPeo() {
        return $this->peo;
    }

    public function setPeo($peo) {
        $this->peo = $peo;
    }

    public function insert($student) {
        $sdb = new StudentsDB();
        return $sdb->insert($student);
    }

    public function selectAll() {
        $sdb = new StudentsDB();
        return $sdb->selectAll();
    }

    public function select($student) {
        $sdb = new StudentsDB();
        return $sdb->select($student);
    }

}

?>
