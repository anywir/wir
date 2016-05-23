<?php
/**
 * Created by PhpStorm.
 * User: parhomenkoav
 * Date: 19.05.2016
 * Time: 10:07
 */

namespace controller;


use model\News;
use model\User;

class Comment
{
    public function addMessage()
    {
        $this->view = new \view\News();
        $this->view->showAddForm();
    }

    public function addAction()
    {
        if(\model\User::IsTrueUser())
        {
            $this->model = new \model\Comment();
            $this->model->addMessage($_COOKIE['id'],$_POST['id_article'],$_POST['id_reply'],$_POST['text'],$_POST['title']);
            header("Location:".$_SERVER['HTTP_REFERER']);
        }
        else
        {
            \model\User::logout();
            header("Refresh:1;url=" . SITE . "user/login?login=nolog");
        }
    }


    public function thread()
    {
        $idArticle = $_GET['id'];
        $idUser = ($_COOKIE["id"] == null)?0:$_COOKIE["id"];
        $this->model = new \model\Comment();
        $thread = $this->model->getThread($idArticle,$idUser);
        $news = new News();
        $article = $news->getOne($idArticle);
        $user = new User();
        $author = $user->getUserData($article['id_user']);
        $article['name']=$author['name'];
        $article['l_name']=$author['l_name'];
        $thread = $this->model->form_tree($thread);
        /*print_r($article);
        echo "<pre>";
        print_r($three);

        
        echo $this->model->build_tree($thread,0);


        die();*/
        $this->view = new \view\Comment();
        $this->view->thread($article,$thread,$idUser);
    }

    public function del()
    {
        //додати перевірку на всі методи редагування видалення вставки, що юзер реальний і має на це право
        if(\model\User::IsTrueUser())
        {
            $idComment = $_GET['id'];
            $this->model = new \model\Comment();
            $this->model->delete($idComment);
            header("Location:" . $_SERVER['HTTP_REFERER']);
        }
        else
        {
            \model\User::logout();
            header("Refresh:1;url=" . SITE . "user/login?login=nolog");
        }

    }
}