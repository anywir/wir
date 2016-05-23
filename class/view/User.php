<?php
/**
 * Created by PhpStorm.
 * User: parhomenkoav
 * Date: 06.05.2016
 * Time: 12:18
 */

namespace view;


class User
{

    public function showLoginform($login)
    {
        include_once "templates/head.php";
        $active = "login";
        include_once "templates/menu.php";
        if ($login=="error")
        {
            $title = "Acces denied!";
            $warning = "EMail or password is wrong!";
            include_once "templates/warning.php";
        }
        include_once "templates/userlogin.php";

        include_once "templates/footer.php";
    }

    public function showJoinform($cities,$user)
    {
        include_once "templates/head.php";
        $active = "join";
        include_once "templates/menu.php";
        if ($user=="exist")
        {
            $title = "Error!";
            $warning = "User is exist!";
            include_once "templates/warning.php";
        }
        include_once "templates/adduser.php";

        include_once "templates/footer.php";

    }

    public function  showUser($cities,$userData,$subs,$edit)
    {
        include_once "templates/head.php";
        $active = "user";
        include_once "templates/menu.php";
        if ($edit)
        {
            if ($userData)
            {
                include_once "templates/edituser.php";
            }
            else
            {
                $title = "Error!";
                $warning = "User is not logon";
                include_once "templates/warning.php";
            }
        }
        else
        {
            include_once "templates/showuser.php";
        }

        include_once "templates/footer.php";
    }
}