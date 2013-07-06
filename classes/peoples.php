<?php

require_once 'peoplesDB.php';

class Peoples {

    private $id;
    private $name;
    private $email;
    private $phone;
    private $cel;
    private $img;

    function __construct($id = null, $name = "", $email = "", $phone = "", $cel = "", $img = "") {
//    function __construct($id, $name, $email, $phone, $cel, $img) {
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
        $this->phone = $phone;
        $this->cel = $cel;
        $this->img = $img;
    }

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getName() {
        return $this->name;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function getEmail() {
        return $this->email;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function getPhone() {
        return $this->phone;
    }

    public function setPhone($phone) {
        $this->phone = $phone;
    }

    public function getCel() {
        return $this->cel;
    }

    public function setCel($cel) {
        $this->cel = $cel;
    }

    public function getImg() {
        return $this->img;
    }

    public function setImg($img) {
        $this->img = $img;
    }

    public function insert($people) {
        $pdb = new PeoplesDB();
        return $pdb->insert($people);
    }

    public function selectAll() {
        $pdb = new PeoplesDB();
        return $pdb->selectAll();
    }
    
    public function select($people) {
        $pdb = new PeoplesDB();
        return $pdb->select($people);
    }
    
    public function update($people) {
        $pdb = new PeoplesDB();
        return $pdb->update($people);
    }

    public function selectMaxId() {
        $pdb = new PeoplesDB();
        return $pdb->selectMaxId();
    }

}

?>
