<?php
/**
 * Created by PhpStorm.
 * User: User15
 * Date: 27.04.16
 * Time: 21:17
 */

namespace controller;


use core\Controller;
use model\Comment;

class News extends Controller
{
    public function getAll()
    {
        $skip = ($_GET['skip'])? $_GET['skip']: 0;
        $idUser = $_GET['id'];
        $count = COUNTINPAGE;
        $this->model = new \model\News();

        $allcount = $this->model->getAllCount($idUser,false);
        //якщо не знаходимо новин від користувача
        if ($allcount<1)
        {
            if ($idUser == $_COOKIE['id']) //і якщо залогінились
            {
                //перекидаємо на додавання новини
                header("Location:".SITE."news/addnews");
            }


        }

        if ($skip<0)
        {
            $skip = 0;
        }
        elseif($skip>=$allcount)
        {
            $skip = $allcount-$count;
        }

        $news = $this->model->getPartNews($skip,$count,$idUser);
        $pages = ceil($allcount/$count);
        $current = ceil($skip/$count)+1;
        $this->view = new \view\News();
        $this->view->showAllNews($news,$pages,$current,$count,$idUser,false);
    }

    public function index()
    {

        header("Location:".SITE."news/getAll");

    }
    public function addnews()
    {
        $this->view = new \view\News();
        $this->view->showAddForm();
    }
    public function addAction()
    {
        $this->model = new \model\News();
        $news = $this->model->addNews($_POST['title'],$_POST['text'],$_FILES['image'],$_COOKIE["auth"]);
        header("Location:".SITE."news/getAll?id=".$_COOKIE['id']);
    }

    public function delNews()
    {
        if(\model\User::IsTrueUser())
        {
            $idNews = $_GET['id'];
            $this->model = new \model\News();
            $this->model->delete($idNews);
            header("Location:" . $_SERVER['HTTP_REFERER']);
        }
        else
        {
            \model\User::logout();
            header("Refresh:1;url=" . SITE . "user/login?login=nolog");
        }

    }

    public function subs()
    {
        $idUser  = $_GET['id'];
        $skip = ($_GET['skip'])? $_GET['skip']: 0;
        $subs = true;
        $count = COUNTINPAGE;
        $this->model = new \model\News();

        $allcount = $this->model->getAllCount($idUser,$subs);

        if ($skip<0)
        {
            $skip = 0;
        }
        elseif($skip>=$allcount)
        {
            $skip = $allcount-$count;
        }
        $pages = ceil($allcount/$count);
        $current = ceil($skip/$count)+1;

        $array = $this->model->getSubs($skip,$count,$idUser);
        $this->view = new \view\News();
        $this->view->showAllNews($array,$pages,$current,$count,$idUser,$subs);
    }


    public function __call($name,$arg)
    {
        echo "page not found";
    }
}