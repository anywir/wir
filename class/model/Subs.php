<?php
/**
 * Created by PhpStorm.
 * User: parhomenkoav
 * Date: 13.05.2016
 * Time: 13:50
 */

namespace model;

use core\DB;

class Subs
{

    public function addSubs($idUser,$idAuthor)
    {
        $dbase = new DB();
        return $dbase->insert("subscribes",["id_user"=>$idUser,"id_autor"=>$idAuthor]);
    }

    public function delSubs($idUser,$idAuthor)
    {
        $dbase = new DB();
        return $dbase->delete("subscribes",["id_user"=>$idUser,"id_autor"=>$idAuthor]);
    }

    public function getSubs($idUser)
    {
        $dbase = new DB();
        $sql = "SELECT email, id  FROM user_login as u,
                (select id_autor from subscribes WHERE id_user = $idUser) as s
                WHERE u.id = s.id_autor ";

        return $dbase->sendQuery($sql);
    }

}