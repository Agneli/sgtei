<?php

class StudentsDB extends Database {

    public function insert(Students $student) {
        $db = new Database();
        /* abri a transação aqui fora, pois vou passar pra classe pessoa com a transaçaõ já aberta */
        $db->openTransaction();

        $peoplesDB = new peoplesDB();
        /* passo a variavel $db pois está com a transação aberta, e preciso usá-la na outra classe */
        $peoplesDB->insert($student, $db);

        $sql = "INSERT INTO students (stu_ra, stu_peo) VALUES (:ra, (SELECT currval('peoples_peo_id_seq') as idinsert))";
        $data = array(":ra" => $student->getRa());

        if ($db->cud($sql, $data)) {
            $db->closeTransaction();
            return true;
        } else {
            return false;
        }
    }

    public function selectAll() {
        $list = null;

        $db = new Database();
        $sql = "SELECT * FROM students, peoples WHERE stu_peo = peo_id";

        $result = $db->read($sql);

        foreach ($result as $row) {
            $student = new Students();
            $student->setRa($row->stu_ra);
            $student->setPeo($row->stu_peo);
            $student->setName($row->peo_name);
            $student->setEmail($row->peo_email);
            $student->setPhone($row->peo_phone);
            $student->setCel($row->peo_cel);
            $student->setImg($row->peo_img);
            $list[] = $student;
        }
        return $list;
    }

    public function select(Students $student) {
        $list = null;

        $db = new Database();
        $sql = "SELECT * FROM students S, peoples P WHERE S.stu_ra = :ra AND S.stu_peo = P.peo_id";

        $data = array(":ra" => $student->getRa());

        $result = $db->read($sql, $data);

        foreach ($result as $row) {
            $student = new Students();
            $student->setRa($row->stu_ra);
            $student->setPeo($row->stu_peo);
            $student->setName($row->peo_name);
            $student->setEmail($row->peo_email);
            $student->setPhone($row->peo_phone);
            $student->setCel($row->peo_cel);
            $list[] = $student;
        }
        return $list;
    }

    public function update(Students $student) {
        $db = new Database();
        if ($db->cud("UPDATE students SET stu_ra = " . $student->getRa() . ", stu_veh = " . $student->getVeh())) {
            return(true);
        } else {
            return(false);
        }
    }

}

?>
