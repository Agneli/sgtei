<?php

class ContractsDB extends Database {

    public function insert(Contracts $contract) {
        $db = new Database();

        $sql = "INSERT INTO contracts (con_per, con_stu, con_rou, con_veh, con_val) VALUES (:per, :stu, :rou, :veh, :val)";
        $data = array(
            ":per" => $contract->getPer(),
            ":stu" => $contract->getStu(),
            ":rou" => $contract->getRou(),
            ":veh" => $contract->getVeh(),
            ":val" => $contract->getVal()
        );

        if ($db->cud($sql, $data)) {
            return true;
        } else {
            return false;
        }
    }
    
    public function select(Contracts $contract) {
        $list = null;

        $db = new Database();
        $sql = "SELECT * FROM contracts WHERE con_stu = :stu";
        
        $data = array(":stu" => $contract->getStu());

        $result = $db->read($sql, $data);

        foreach ($result as $row) {
            $contract = new Contracts();
            $contract->setId($row->con_id);
            $contract->setVal($row->con_val);
            $contract->setRou($row->con_rou);
            $contract->setVeh($row->con_veh);

            $list[] = $contract;
        }
        return $list;
    }

}

?>
