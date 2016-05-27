<?php
/**
 * Created by PhpStorm.
 * User: wir
 * Date: 06.05.2016
 * Time: 20:27
 */

namespace model;

use core\DB;


class City
{
    public function getAll()
    {
        $dbase = new DB();
        if ($_GET['city'])
        {
            $sql = "SELECT * FROM `city` WHERE `name` LIKE '".$_GET['city']."%'";
            $array = $dbase->sendQuery($sql);
        }
        else {
            $array = $dbase->select("city", null, null, "name", null, null);
        }
        return $array;
    }


    public static function getCity($id)
    {
        $dbase = new DB();
        $city = $dbase->select("city",null,['id'=>$id],"name",null,[0,1])[0]['name'];
        return $city;
    }
}