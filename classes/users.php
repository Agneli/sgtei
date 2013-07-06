<?php

require_once 'peoples.php';
require_once 'usersDB.php';

class Users extends Peoples {

    private $login;
    private $pass;
    private $level;
    private $peo;

    function __construct($id = null, $name = "", $email = "", $phone = "", $cel = "", $login = "", $pass = "", $level = "", $peo = null) {
        parent::__construct($id, $name, $email, $phone, $cel);
        $this->login = $login;
        $this->pass = $pass;
        $this->level = $level;
        $this->peo = $peo;
    }

    public function getLogin() {
        return $this->login;
    }

    public function setLogin($login) {
        $this->login = $login;
    }

    public function getPass() {
        return $this->pass;
    }

    public function setPass($pass) {
        $this->pass = $pass;
    }

    public function getLevel() {
        return $this->level;
    }

    public function setLevel($level) {
        $this->level = $level;
    }

    public function getPeo() {
        return $this->peo;
    }

    public function setPeo($peo) {
        $this->peo = $peo;
    }
    
    public function insert($user) {
        $udb = new UsersDB();
        return $udb->insert($user);
    }
    
    public function selectAll() {
        $udb = new UsersDB();
        return $udb->selectAll();
    }

    public function login($user) {
        $udb = new UsersDB();
        return $udb->login($user);
    }

}

?>
