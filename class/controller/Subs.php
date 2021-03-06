<?php
/**
 * Created by PhpStorm.
 * User: parhomenkoav
 * Date: 13.05.2016
 * Time: 13:44
 */

namespace controller;



use core\Controller;


class Subs extends Controller
{
    public function index()
    {

        header("Location:".SITE."subs/getAll");

    }
    public function addSubs()
    {
        if(\model\User::IsTrueUser())
        {

            $idAuthor = $_GET['id'];
            $idUser = $_COOKIE['id'];
            $this->model = new \model\Subs();
            $this->model->addSubs($idUser,$idAuthor);
            header("Location:".$_SERVER['HTTP_REFERER']);
        }
        else
        {
            \model\User::logout();
            header("Refresh:1;url=" . SITE . "user/login?login=nolog");
        }

    }

    public function delSubs()
    {
        if(\model\User::IsTrueUser())
        {

            $idAuthor = $_GET['id'];
            $idUser = $_COOKIE['id'];
            $this->model = new \model\Subs();
            $this->model->delSubs($idUser, $idAuthor);
            header("Location:" . $_SERVER['HTTP_REFERER']);
        }
        else
        {
            \model\User::logout();
            header("Refresh:1;url=" . SITE . "user/login?login=nolog");
        }

    }
}