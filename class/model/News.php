<?php
/**
 * Created by PhpStorm.
 * User: User15
 * Date: 04.05.16
 * Time: 19:34
 */

namespace model;


use core\DB;

class News
{
    public function getAllCount($id=null,$subs=null)
    {
        $dbase = new DB();
        if ($subs)
        {
            $sql = "select count(*) as count from `articles` as a inner join `subscribes` as s on a.`id_user` = s.`id_autor` and s.`id_user` = ".$id." limit 1";
            //echo $sql;
            $ret = $dbase->sendQuery($sql)[0]['count'];
        }
        else
        {
            $ret = $dbase->select('articles', ['COUNT(*)'], ($id) ? ['id_user' => $id] : "",false,false,[0,1])[0]['count'];
        }
        return $ret;
    }

    public function getAll($limit=null,$id=null)
    {
        $id_user = ($_COOKIE["id"] == null)?0:$_COOKIE["id"];
        $where_user = false;
        if ($id)
        {
            $where_user = ["id_user"=>$id];
        }
        if ($limit)
        {
            $limit = " LIMIT ".$limit;
        }

        $sql = "select a.* , s.id_user as sub from `articles` as a  
                left join `subscribes` as s on  a.`id_user` =  s.`id_autor` and s.`id_user` = ".$id_user."
                ".$where_user." order by a.create_date desc".$limit;

        $dbase = new DB();
        $array = $dbase->sendQuery($sql);
        return $array;
    }

    public function getPartNews($shift=0,$count=30,$id=null)
    {
        $id_user = ($_COOKIE["id"] == null)?0:$_COOKIE["id"];
        $where_user = false;
        if ($id)
        {
            $where_user = "WHERE a.id_user = ".$id;
        }



        $sql = "SELECT a.* , s.id_user AS sub, u.name, u.l_name, u.avatar from `articles` AS a 
                LEFT JOIN `user_data` AS u ON a.`id_user` = u.`id` 
                LEFT JOIN `subscribes` AS s ON s.`id_autor` = a.`id_user` AND s.`id_user` = ".$id_user."
                 ".$where_user." order by a.create_date desc limit ".$shift.",".$count;

        $dbase = new DB();
        $array = $dbase->sendQuery($sql);
        return $array;
    }

    public function addNews($title,$text,$file,$author)
    {

        if ($file["name"])
        {
            $filename = $file['name'];
            copy($file['tmp_name'],"files/".$filename );
        }
        else
        {
            $filename = "";
        }

        $dbase = new DB();//"mysql:host=localhost;dbname=akio"
        $id_user = $dbase->select("user_login",["id"],['email'=>$author])[0]['id'];
        
        return $dbase->insert("articles",["title"=>$title,"text"=>$text,"create_date"=>date('Y-m-d H:i:s'),"id_user"=>$id_user,"image"=>$filename]);


    }

    public function getSubs($shift=0,$count=30,$idUser)
    {
        $dbase = new DB();
        $sql = "SELECT a.* , s.id_user AS sub, u.name, u.l_name, u.avatar  FROM `articles` AS a 
                INNER JOIN `subscribes` AS s ON a.`id_user` = s.`id_autor` AND s.`id_user` = ".$idUser."
                LEFT JOIN `user_data` AS u ON a.`id_user` = u.`id` ORDER BY a.create_date DESC  limit ".$shift.",".$count;
        
        $array = $dbase->sendQuery($sql);
        return $array;
    }

    public function getOne($id_article)
    {
        $dbase = new DB();
        $array = $dbase->select("articles",null,['id'=>$id_article],null,null,[0,1])[0];
        return $array;
    }


    public function delete($idArt)
    {
        $dbase = new DB();
        $dbase->delete("articles",["id"=>$idArt]);
    }
} 