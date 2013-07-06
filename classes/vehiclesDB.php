<?php

class VehiclesDB extends Database {

    public function insert(Vehicles $vehicle) {
        $db = new Database();

        $sql = "INSERT INTO vehicles (veh_plate, veh_aut, veh_rou, veh_dri, veh_img) VALUES (:plate, :aut, :rou, :dri, :img)";

        $data = array(
            ":plate" => $vehicle->getPlate(),
            ":aut" => $vehicle->getAut(),
            ":rou" => $vehicle->getRou(),
            ":dri" => $vehicle->getDri(),
            ":img" => $vehicle->getImg()
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
        $sql = "SELECT V.*, P.peo_name, R.* FROM vehicles V, drivers D, peoples P, routes R WHERE V.veh_dri = D.dri_cnh AND D.dri_peo = P.peo_id AND V.veh_rou = R.rou_id";

        $result = $db->read($sql);

        foreach ($result as $row) {
            $vehicle = new Vehicles();
            $vehicle->setId($row->veh_id);
            $vehicle->setPlate($row->veh_plate);
            $vehicle->setAut($row->veh_aut);
            $vehicle->setImg($row->veh_img);
            $vehicle->setRou($row->rou_ori." &rarr; ".$row->rou_dest);
            $vehicle->setDri($row->peo_name);
            $list[] = $vehicle;
        }
        return $list;
    }

    public function selectExpense(Vehicles $vehicle) {
        $list = null;

        $db = new Database();
        $sql = "SELECT ((rou_dis / veh_aut) * (SELECT fue_val FROM fuel ORDER BY fue_id DESC LIMIT 1)) AS expense FROM vehicles, routes WHERE veh_id = :id AND veh_rou = rou_id";

        $data = array(":id" => $vehicle->getId());

        $result = $db->read($sql, $data);

        foreach ($result as $row) {
            $vehicle = new Vehicles();
            $vehicle->setExp($row->expense);
            $list[] = $vehicle;
        }
        return $list;
    }

    public function select(Vehicles $vehicle) {
        $list = null;

        $db = new Database();
        $sql = "SELECT * FROM vehicles WHERE veh_id = :id";

        $data = array(":id" => $vehicle->getId());

        $result = $db->read($sql, $data);

        foreach ($result as $row) {
            $vehicle = new Vehicles();
            $vehicle->setId($row->veh_id);
            $vehicle->setPlate($row->veh_plate);
            $vehicle->setAut($row->veh_aut);
            $vehicle->setDri($row->veh_dri);
            $vehicle->setimg($row->veh_img);
            $vehicle->setRou($row->veh_rou);
            $list[] = $vehicle;
        }
        return $list;
    }

    public function selectCont(Vehicles $vehicle) {
        $list = null;

        $db = new Database();
        $sql = "SELECT * FROM vehicles WHERE veh_rou = :rou";

        $data = array(":rou" => $vehicle->getRou());

        $result = $db->read($sql, $data);

        foreach ($result as $row) {
            $vehicle = new Vehicles();
            $vehicle->setId($row->veh_id);
            $vehicle->setPlate($row->veh_plate);
            $vehicle->setAut($row->veh_aut);
            $vehicle->setDri($row->veh_dri);
            $vehicle->setimg($row->veh_img);
            $vehicle->setRou($row->veh_rou);
            $list[] = $vehicle;
        }
        return $list;
    }

    public function update($vehicle) {
        $db = new Database();
        $sql = "UPDATE vehicles SET veh_plate = :plate, veh_aut = :aut, veh_rou = :rou, veh_dri = :dri, veh_img = :img WHERE veh_id = :id";

        $data = array(
            ":plate" => $vehicle->getPlate(),
            ":aut" => $vehicle->getAut(),
            ":rou" => $vehicle->getRou(),
            ":dri" => $vehicle->getDri(),
            ":img" => $vehicle->getImg(),
            ":id" => $vehicle->getId()
        );

        if ($db->cud($sql, $data)) {
            return(true);
        } else {
            return(false);
        }
    }

    public function delete($id) {
        $db = new Database();

        $sql = "DELETE FROM vehicles WHERE veh_id = :id";

        $data = array(":id" => $id);

        if ($db->cud($sql, $data)) {
            return(true);
        } else {
            return(false);
        }
    }

}

?>
