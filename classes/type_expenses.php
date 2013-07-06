<?php

require_once 'type_expensesDB.php';

class TypeExpenses {

    private $id;
    private $desc;

    function __construct($id = null, $desc = "") {
        $this->id = $id;
        $this->desc = $desc;
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
    
    public function insert($type_expense) {
        $tdb = new TypeExpensesDB();
        return $tdb->insert($type_expense);
    }
    
    public function selectAll() {
        $edb = new TypeExpensesDB();
        return $edb->selectAll();
    }

}

?>
