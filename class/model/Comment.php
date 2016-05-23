<?php
/**
 * Created by PhpStorm.
 * User: parhomenkoav
 * Date: 19.05.2016
 * Time: 10:07
 */

namespace model;

use core\DB;


class Comment
{
    public function form_tree($mess)
    {
            if (!is_array($mess)) {
                return false;
            }
            $tree = array();
            foreach ($mess as $value) {
                $tree[$value['id_reply_on']][] = $value;
            }
            return $tree;
    }

    public function  build_tree($cats, $parent_id)
    {
        if (is_array($cats) && isset($cats[$parent_id])) {
            $tree = '<ul>';
            foreach ($cats[$parent_id] as $cat) {
                $tree .= '<li>' . $cat['name'].$cat['title'];
                $tree .= $this->build_tree($cats, $cat['id']);
                $tree .= '</li>';
            }
            $tree .= '</ul>';
        } else {
        return false;
        }
    return $tree;
    }


    public function addMessage($id_user,$id_article,$id_reply,$text,$title)
    {

        $dbase = new DB();
        return $dbase->insert("comments",["title"=>$title,"text"=>$text,"create_date"=>date('Y-m-d H:i:s'),"id_user"=>$id_user,"id_article"=>$id_article,"id_reply_on"=>$id_reply]);

    }

    public function getThread($id_article,$id_user)
    {
        $dbase = new DB();
        $sql = "SELECT c.*, u.name, u.l_name , s.id_user AS sub FROM `comments` AS c
                LEFT JOIN `user_data` AS u ON c.`id_user` = u.`id`
                LEFT JOIN `subscribes` AS s ON s.`id_autor` = c.`id_user` AND s.`id_user` = ".$id_user."
                WHERE c.`id_article` = $id_article  ORDER BY `create_date` DESC  limit 0,30";

        $array = $dbase->sendQuery($sql);
        return $array;
    }

    public function delete($idArt)
    {
        $dbase = new DB();
        $dbase->delete("comments",["id"=>$idArt]);
    }
}