<?php

class RoutesDB extends Database {

    public function insert(Routes $route) {
        $db = new Database();
        $sql = "INSERT INTO routes (rou_ori, rou_dest, rou_dis, rou_time) VALUES (:ori, :dest, :dis, :time)";

        $data = array(
            ":ori" => $route->getOri(),
            ":dest" => $route->getDest(),
            ":dis" => $route->getDis(),
            ":time" => $route->getTime()
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
        $sql = "SELECT * FROM routes";

        $result = $db->read($sql);

        foreach ($result as $row) {
            $route = new Routes();
            $route->setId($row->rou_id);
            $route->setOri($row->rou_ori);
            $route->setDest($row->rou_dest);
            $route->setDis($row->rou_dis);
            $route->setTime($row->rou_time);
            $list[] = $route;
        }
        return $list;
    }

    public function select(Routes $route) {
        $list = null;

        $db = new Database();
        $sql = "SELECT * FROM routes WHERE rou_id = :id";

        $data = array(":id" => $route->getId());

        $result = $db->read($sql, $data);

        foreach ($result as $row) {
            $route = new Routes();
            $route->setId($row->rou_id);
            $route->setOri($row->rou_ori);
            $route->setDest($row->rou_dest);
            $route->setDis($row->rou_dis);
            $route->setTime($row->rou_time);
            $list[] = $route;
        }
        return $list;
    }

}

?>
