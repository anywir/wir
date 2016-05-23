<?php
/**
 * Created by PhpStorm.
 * User: parhomenkoav
 * Date: 19.05.2016
 * Time: 10:07
 */

namespace view;


class Comment
{
    public function showAddForm()
    {

        include_once "templates/head.php";
        $active = "addnews";
        include_once "templates/menu.php";

        include_once "templates/addmessage.php";


        include_once "templates/footer.php";

    }

    public function thread($article,$thread,$idUser)
    {

        include_once "templates/head.php";

        include_once "templates/menu.php";

        include_once "templates/onenews.php";
        include_once "templates/messagesthree.php";
        include_once "templates/modaladdmesage.php";
        include_once "templates/footer.php";

    }


}