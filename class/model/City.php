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
        $dbase = new DB("mysql:host=localhost;dbname=akio");
        $array = $dbase->select("city",null,null,"name",null,null);
        return $array;
    }
    public function getCity($id)
    {
        $dbase = new DB("mysql:host=localhost;dbname=akio");
        $city = $dbase->select("city",null,['id'=>$id],"name",null,[0,1])[0]['nanme'];
        return $city;
    }
}