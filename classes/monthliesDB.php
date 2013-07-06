<?php

class MonthliesDB extends Database {

    public function insert(Monthlies $monthly) {
        $db = new Database();

        $sql = "INSERT INTO monthlies (mon_mon, mon_status, mon_val, mon_cont) VALUES (:mon, :status, :val, (SELECT last_value FROM contracts_con_id_seq))";
        $data = array(
            ":mon" => $monthly->getMon(),
            ":status" => $monthly->getStatus(),
            ":val" => $monthly->getVal()
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
        $sql = "SELECT V.val_val, M.mon_mon, P.peo_name FROM monthlies M, values V, contracts C, students S, peoples P WHERE mon_status = 'pd' AND val_id = mon_val AND con_id = mon_cont AND con_stu = stu_ra AND stu_peo = peo_id";

        $result = $db->read($sql);

        foreach ($result as $row) {
            $monthly = new Monthlies();
            $monthly->setVal($row->val_val);
            $monthly->setMon($row->mon_mon);
            $monthly->setRa($row->peo_name);
            $list[] = $monthly;
        }
        return $list;
    }
    
    public function selectSumAll() {
        $list = null;

        $db = new Database();
        $sql = "SELECT SUM(val_val) AS val FROM monthlies M, values V, contracts C, students S, peoples P WHERE mon_status = 'pd' AND val_id = mon_val AND con_id = mon_cont AND con_stu = stu_ra AND stu_peo = peo_id";

        $result = $db->read($sql);

        foreach ($result as $row) {
            $monthly = new Monthlies();
            $monthly->setVal($row->val);
            $list[] = $monthly;
        }
        return $list;
    }

    public function select(Monthlies $monthly) {
        $list = null;

        $db = new Database();
        $sql = "SELECT * FROM monthlies M, contracts C, values V, students S WHERE M.mon_val = V.val_id AND M.mon_cont = C.con_id AND S.stu_ra = C.con_stu AND S.stu_ra = :ra AND M.mon_cont = (SELECT MAX(con_id) FROM contracts WHERE con_stu = :ra) ORDER BY M.mon_mon ASC";

        $data = array(":ra" => $monthly->getRa());

        if ($result = $db->read($sql, $data)) {
            foreach ($result as $row) {
                $monthly = new Monthlies();
                $monthly->setId($row->mon_id);
                $monthly->setMon($row->mon_mon);
                $monthly->setVal($row->val_val);
                $monthly->setStatus($row->mon_status);
                $list[] = $monthly;
            }
        }
        return $list;
    }

    public function pay(Monthlies $monthly) {
        $db = new Database();
        $sql = "UPDATE monthlies SET mon_status = :status WHERE mon_id = :id";

        $data = array(
            ":id" => $monthly->getId(),
            ":status" => $monthly->getStatus()
        );

        if ($db->cud($sql, $data)) {
            return(true);
        } else {
            return(false);
        }
    }

}
?>
