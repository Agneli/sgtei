<?php

class ExpensesDB extends Database {

    public function insert(Expenses $expense) {
        $db = new Database();
        $sql = "INSERT INTO expenses (exp_type, exp_veh, exp_desc, exp_val) VALUES (:type, :veh, :desc, :val)";

        $data = array(
            ":type" => $expense->getType(),
            ":veh" => $expense->getVeh(),
            ":desc" => $expense->getDesc(),
            ":val" => $expense->getVal()
        );

        if ($db->cud($sql, $data)) {
            return(true);
        } else {
            return(false);
        }
    }

    public function selectAll() {
        $list = null;

        $db = new Database();
        $sql = "SELECT E.*, V.veh_plate, T.tex_desc FROM expenses E, vehicles V, type_expenses T WHERE E.exp_veh = V.veh_id AND E.exp_type = T.tex_id";

        $result = $db->read($sql);

        foreach ($result as $row) {
            $expense = new Expenses();
            $expense->setId($row->exp_id);
            $expense->setDesc($row->exp_desc);
            $expense->setVal($row->exp_val);
            $expense->setVeh($row->veh_plate);
            $expense->setType($row->tex_desc);
            $list[] = $expense;
        }
        return $list;
    }

    public function selectSumAll() {
        $list = null;

        $db = new Database();
        $sql = "SELECT SUM(exp_val) AS val FROM expenses";

        $result = $db->read($sql);

        foreach ($result as $row) {
            $expense = new Expenses();
            $expense->setVal($row->val);
            $list[] = $expense;
        }
        return $list;
    }

    public function selectSum(Vehicles $vehicle) {
        $list = null;

        $db = new Database();
        $sql = "SELECT SUM(exp_val) AS val FROM expenses WHERE exp_veh = :id";

        $data = array(":id" => $vehicle->getId());

        $result = $db->read($sql, $data);

        foreach ($result as $row) {
            $expense = new Expenses();
            $expense->setVal($row->val);
            $list[] = $expense;
        }
        return $list;
    }

}

?>
