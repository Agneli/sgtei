<?php

class ValuesDB extends Database {

    public function insert(Values $value) {
        $db = new Database();
        $sql = "INSERT INTO values (val_desc, val_val, val_rou) VALUES (:desc, :val, :rou)";

        $data = array(
            ":desc" => $value->getDesc(),
            ":val" => $value->getVal(),
            ":rou" => $value->getRou()
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
        $sql = "SELECT * FROM values";

        $result = $db->read($sql);

        foreach ($result as $row) {
            $value = new Values();
            $value->setId($row->val_id);
            $value->setVal($row->val_val);
            $value->setDesc($row->val_desc);
            $list[] = $value;
        }
        return $list;
    }

    public function select(Values $value) {
        $list = null;

        $db = new Database();
        $sql = "SELECT * FROM values WHERE val_rou = :id";

        $data = array(":id" => $value->getId());

        $result = $db->read($sql, $data);

        foreach ($result as $row) {
            $value = new Values();
            $value->setId($row->val_id);
            $value->setDesc($row->val_desc);
            $value->setVal($row->val_val);
            $value->setRou($row->val_rou);
            $list[] = $value;
        }
        return $list;
    }

    public function selectValRou(Values $value) {
        $list = null;

        $db = new Database();
        $sql = "SELECT * FROM values WHERE val_rou = :rou";

        $data = array(":rou" => $value->getRou());

        $result = $db->read($sql, $data);

        foreach ($result as $row) {
            $value = new Values();
            $value->setId($row->val_id);
            $value->setDesc($row->val_desc);
            $value->setVal($row->val_val);
            $value->setRou($row->val_rou);
            $list[] = $value;
        }
        return $list;
    }

    public function selectValCont(Students $student) {
        $list = null;

        $db = new Database();
        $sql = "SELECT * FROM students, vehicles, values, routes WHERE veh_rou = rou_id AND val_rou = rou_id AND stu_veh = veh_id AND stu_ra = :ra";

        $data = array(":ra" => $student->getRa());

        $result = $db->read($sql, $data);

        foreach ($result as $row) {
            $value = new Values();
            $value->setId($row->val_id);
            $value->setDesc($row->val_desc);
            $value->setVal($row->val_val);
            $value->setRou($row->val_rou);
            $list[] = $value;
        }
        return $list;
    }

}

?>
