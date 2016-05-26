<?php
/**
 * Created by PhpStorm.
 * User: parhomenkoav
 * Date: 06.05.2016
 * Time: 12:18
 */

namespace controller;
use core\Controller;
use model\City;
use model\Subs;

class User extends Controller
{
    public function index()
    {
        header("Location:".SITE."user/login");
    }

    /**
     *
     */

    public function show() //показати корисувача
    {
        $this->model = new \model\User();
        $userData = $this->model->getUserData($_GET['id']);
        $city = new \model\City();
        $cities = $city->getCity($userData['idCity']);
        $subs = new \model\Subs();
        $userSubs = $subs->getSubs($_GET['id']);
        $this->view = new \view\User();
        $this->view->showUser($cities,$userData,$userSubs,null);
    }    
    
    public function home() //домашня сторінка користувача, редагувати
    {
        $edit = true;
        $this->model = new \model\User();
        $userData = $this->model->getUserData($_COOKIE['id']);
        $city = new \model\City();
        $cities = $city->getAll();
        $subs = new \model\Subs();
        $userSubs = $subs->getSubs($_COOKIE['id']);
        $this->view = new \view\User();
        $this->view->showUser($cities,$userData,$userSubs,$edit);

    }

    public function update()
    {// зберегти зміни
        $this->model = new \model\User();
        $this->model->userUpdate($_COOKIE['id'],$_POST['name'],$_POST['l_name'],$_POST['birthday'],$_POST['idCity'],$_POST['phone'],$_FILES['avatar']);
        header("Location:".$_SERVER['HTTP_REFERER']);
    }
    
    public function login()
    {
        $this->view = new \view\User();
        $this->view->showLoginform($_GET['login']);
    }


    public  function loginAction()
    {
        $this->model = new \model\User();
        $email = $_POST['email'];
        $pass = $_POST['pass'];
        $idlogin = $this->model->login($email,$pass);

        if ($idlogin==="-1")
        {
            header("Refresh:1;url=".SITE."user/login?login=error");
        }
        else
        {
            header("Refresh:1;url=".SITE."news/getAll?id=".$idlogin);
        }

    }

    public function join()
    {
        $city = new \model\City();
        $cities = $city->getAll();
        $this->view = new \view\User();
        $this->view->showJoinform($cities,$_GET['user']);
    }

    public function joinAction()
    {

        $this->model = new \model\User();
        $this->model->logout(); // logout поточного користувача
        $res = $this->model->registrUser($_POST['email'],$_POST['pass'],$_POST['name'],$_POST['l_name'],$_POST['birthday'],$_POST['city'],$_POST['phone'],$_POST["avatar"]);
        if ($res>0)
        {
            $this->model->login($_POST['email'], $_POST['pass']);
            header("Refresh:1;url=".SITE."news");
        }
        else
        {
            header("Refresh:1;url=".SITE."user/join?user=exist");            
        }
    }

    public function logout()
    {
        $this->model = new \model\User();
        $this->model->logout();
        header("Refresh:1;url=".SITE."news");

    }

    public function __call($name,$arg) //викликається коли ми намагаємось звернутись до методу якого немає, або він закритий ідентифікатором доступу
    {
        echo "page not found";
    }

}