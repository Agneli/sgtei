<?php

class UsersDB extends Database {

    public function insert(Users $user) {
        $db = new Database();
        /* abri a transação aqui fora, pois vou passar pra classe pessoa com a transaçaõ já aberta */
        $db->openTransaction();

        $peoplesDB = new peoplesDB();
        /* passo a variavel $db pois está com a transação aberta, e preciso usá-la na outra classe */
        $peoplesDB->insert($user, $db);
        $sql = "INSERT INTO users (use_login, use_pass, use_level, use_peo) VALUES (:login, :pass, :level, (SELECT currval('peoples_peo_id_seq') as idinsert))";
        $data = array(
            ":login" => $user->getLogin(),
            ":pass" => $user->getPass(),
            ":level" => $user->getLevel()
        );

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
        $sql = "SELECT * FROM users, peoples WHERE use_peo = peo_id";

        $result = $db->read($sql);

        foreach ($result as $row) {
            $users = new Users();
            $users->setPeo($row->use_peo);
            $users->setLevel($row->use_level);
            $users->setName($row->peo_name);
            $users->setEmail($row->peo_email);
            $users->setPhone($row->peo_phone);
            $users->setCel($row->peo_cel);
            $users->setImg($row->peo_img);
            $list[] = $users;
        }
        return $list;
    }

    public function login(Users $user) {
        $list = null;

        $db = new Database();
        $sql = "SELECT * FROM users WHERE use_login = :login AND use_pass = :pass";

        $data = array(
            ":login" => $user->getLogin(),
            ":pass" => $user->getPass()
        );

        $result = $db->read($sql, $data);

        foreach ($result as $row) {
            $user = new Users();
            $user->setId($row->use_id);
            $user->setLogin($row->use_login);
            $user->setPass($row->use_pass);
            $user->setLevel($row->use_level);
            $list[] = $user;
        }
        return $list;
    }

}

?>
