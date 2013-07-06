<?php

class DriversDB extends Database {

    public function insert(Drivers $driver) {
        $db = new Database();
        /* abri a transação aqui fora, pois vou passar pra classe pessoa com a transaçaõ já aberta */
        $db->openTransaction();

        $peoplesDB = new peoplesDB();
        /* passo a variavel $db pois está com a transação aberta, e preciso usá-la na outra classe */
        $peoplesDB->insert($driver, $db);
        $sql = "INSERT INTO drivers (dri_cnh, dri_peo) VALUES (:cnh, (SELECT currval('peoples_peo_id_seq') as idinsert))";
        $data = array(":cnh" => $driver->getCnh());

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
        $sql = "SELECT * FROM drivers, peoples WHERE dri_peo = peo_id";

        $result = $db->read($sql);

        foreach ($result as $row) {
            $drivers = new Drivers();
            $drivers->setCnh($row->dri_cnh);
            $drivers->setPeo($row->dri_peo);
            $drivers->setName($row->peo_name);
            $drivers->setEmail($row->peo_email);
            $drivers->setPhone($row->peo_phone);
            $drivers->setCel($row->peo_cel);
            $drivers->setImg($row->peo_img);
            $list[] = $drivers;
        }
        return $list;
    }

    public function selectVeh() {
        $list = null;

        $db = new Database();
        $sql = "SELECT * FROM drivers, peoples WHERE dri_peo = peo_id AND dri_cnh NOT IN (SELECT veh_dri FROM vehicles)";

        $result = $db->read($sql);

        foreach ($result as $row) {
            $drivers = new Drivers();
            $drivers->setCnh($row->dri_cnh);
            $drivers->setName($row->peo_name);
            $list[] = $drivers;
        }
        return $list;
    }

}

?>
