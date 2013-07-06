<?php

class TypeExpensesDB extends Database {

    public function insert(TypeExpenses $type_expense) {
        $db = new Database();
        $sql = "INSERT INTO type_expenses (tex_desc) VALUES (:desc)";

        $data = array(
            ":desc" => $type_expense->getDesc()
        );

        if ($db->cud($sql, $data)) {
            return true;
        } else {
            return false;
        }
    }

    public function selectAll() {
        $list = null;

        $db = new Database();
        $sql = "SELECT * FROM type_expenses";

        $result = $db->read($sql);

        foreach ($result as $row) {
            $type_expense = new TypeExpenses();
            $type_expense->setId($row->tex_id);
            $type_expense->setDesc($row->tex_desc);
            $list[] = $type_expense;
        }
        return $list;
    }

}

?>
