<?php

class PeoplesDB extends Database {

    public function insert(Peoples $people, $db = null) {

        /* verifico se passou a variavel $db por parametro, para que eu possa usá-la na transação */
        $db = ($db != null) ? $db : new Database();

        $sql = "INSERT INTO peoples (peo_name, peo_email, peo_phone, peo_cel, peo_img) VALUES (:name, :email, :phone, :cel, :img)";
        $data = array(
            ":name" => $people->getName(),
            ":email" => $people->getEmail(),
            ":phone" => $people->getPhone(),
            ":cel" => $people->getCel(),
            ":img" => $people->getImg()
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
        $sql = "SELECT * FROM peoples";

        $result = $db->read($sql);

        foreach ($result as $row) {
            $people = new Peoples();
            $people->setName($row->peo_name);
            $people->setEmail($row->peo_email);
            $people->setPhone($row->peo_phone);
            $people->setCel($row->peo_cel);

            $list[] = $people;
        }
        return $list;
    }

    public function select(Peoples $people) {
        $list = null;

        $db = new Database();
        $sql = "SELECT * FROM peoples WHERE peo_id = :id";

        $data = array(":id" => $people->getId());

        $result = $db->read($sql, $data);

        foreach ($result as $row) {
            $people = new Peoples();
            $people->setId($row->peo_id);
            $people->setName($row->peo_name);
            $people->setEmail($row->peo_email);
            $people->setPhone($row->peo_phone);
            $people->setCel($row->peo_cel);
            $list[] = $people;
        }
        return $list;
    }

    public function selectMaxId() {
        $list = null;

        $db = new Database();
        $sql = "SELECT MAX(peo_id) AS max FROM peoples";

        $result = $db->read($sql);

        foreach ($result as $row) {
            $people = new Peoples();
            $people->setId($row->max);
            $list[] = $people;
        }
        return $list;
    }

    public function update(Peoples $people) {
        $db = new Database();
        $sql = "UPDATE peoples SET peo_name = :name, peo_email = :email, peo_phone = :phone, peo_cel = :cel WHERE peo_id = :id";

        $data = array(
            ":id" => $people->getId(),
            ":name" => $people->getName(),
            ":email" => $people->getEmail(),
            ":phone" => $people->getPhone(),
            ":cel" => $people->getCel()
        );

        if ($db->cud($sql, $data)) {
            return true;
        } else {
            return false;
        }
    }

}

?>
