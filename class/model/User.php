<?php

namespace model;

use core\DB;

interface UserInterface {

    /**
     * метод має логінити юзера, створюючи два значення куккі
     * auth - email user
     * token - md5("security_key".email_user)
     *
     * @param string $email - емейл юзера
     * @param string $pass - пароль юзера (не в md5)
     * @return mixed - має повертати true якщо вдалось залогінитись
     * та код помилки, якщо виникла помилка
     */

    public function login($email = "",$pass = "");

    /**
     * метод має очищати кукі, які створюються при реєстрації
     *
     * @return mixed - має повернути true, якщо вихід відбувся вдало
     */

    public static function logout();

    /**
     * @param string $email - mail
     * @param string $pass - password (not md5)
     * @param string $name - name new user
     * @param string $surname - surname new user
     * @return mixed - must return true if registration is successful
     */

    public function registrUser($email = "", $pass = "", $name = "", $l_name = "", $birthdate = "", $idCity = "", $phone = "", $avatar);

}


class User implements UserInterface
{
    private $auth;
    private $token;
    private $userDB;
    private $usertable;
    public static $username;
    
    /**
     * метод має логінити юзера, створюючи два значення куккі
     * auth - email user
     * token - md5("security_key".email_user)
     *
     * @param string $email - емейл юзера
     * @param string $pass - пароль юзера (не в md5)
     * @return mixed - має повертати true якщо вдалось залогінитись
     * та код помилки, якщо виникла помилка
     * повертає ID користувача
     */

    public function login($email = "",$pass = "")
    {
        $DBase = new DB(null);
        $res =  $DBase->select("user_login",null,["email"=>$email,"pass"=>hash("md5",$pass)],null,null,null)[0];
        //print_r($res);
        if ($res)
        {
            $this->auth = $res['email'];
            $this->token = md5("supersecuritykey".$res['email'].$res['id']);
            self::$username = $this->auth;
            setcookie("auth",$this->auth,time()+60*60*24,"/");
            setcookie("token",$this->token,time()+60*60*24,"/");
            setcookie("id",$res['id'],time()+60*60*24,"/");
            return $res['id'];
        }
        else
        {
            return "-1";
        }
            
    }
    
      /**
     * метод має очищати кукі, які створюються при реєстрації
     *
     * @return mixed - має повернути true, якщо вихід відбувся вдало
     */

    public static function logout()
    {
        setcookie("auth","",time()-600,"/");
        setcookie("token","",time()-600,"/");
        setcookie("id","",time()-600,"/");
        return true;
    }



    public function registrUser($email = "", $pass = "", $name = "", $l_name = "",$birthdate = "",$idCity = "",$phone = "",$avatar)
    {
        
        $userExist = $this->isExistUser($email); // перевірка чи є такий юззер
        if (!$userExist)
        {
            $DBase = new DB(null);
            $id = $DBase->insert("user_login", ["email" => $email, "pass" => hash("md5", $pass)]);
            if ($avatar)
            {
                $filename = preg_replace("/imgtmp/i",$id."userava",$avatar);
                rename("avatares/".$avatar,"avatares/".$filename);
            }
            else
            {
                $filename = "default.png";
            }
            $DBase->insert("user_data",
                ["id" => $id, "name" => $name, "l_name" => $l_name, "birthdate" => $birthdate,
                    "idCity" => $idCity, "phone" => $phone, "avatar" => $filename, "regDate" => date('Y-m-d H:i:s')]);
            return $id;
        }
        else
        {
            return null;
        }

    }

    public function getUserData($id)
    {
        $DBase = new DB(null);
        $userData = $DBase->select("user_data",false,['id'=>$id],false,false,[0,1])[0];
        $userData['city'] = City::getCity($userData['idCity']);//вибираємо місто для користувача
        return $userData;
    }

    public static function IsTrueUser()
    {
        return (md5("supersecuritykey".$_COOKIE['auth'].$_COOKIE['id'])==$_COOKIE['token']);
    }


    public function isExistUser($login=null)
    {
        $DBase = new DB(null);
        $login = ($login?$login:$_GET['email']);
        $users = $DBase->select("user_login",["count(id)"],['email'=>$login])[0];
        if ($users['count']>0)
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    public function userUpdate($idUser, $name = "", $l_name = "",$birthdate = "",$idCity = "",$phone = "",$avatar)
    {
        if ($avatar['name'])
        {
            $filename = $idUser . $avatar['name'];
            //$imginf=(getimagesize($avatar['tmp_name']));
            //print_r($imginf);
            copy($avatar['tmp_name'],"avatares/" . $filename);
        }
        else
        {
            $filename = "";
        }
        $DBase = new DB(null);
        $DBase->update("user_data",["id"=>$idUser],["idCity"=>$idCity,"name"=>$name,"l_name"=>$l_name,"phone"=>$phone,"birthdate"=>$birthdate,$filename?["avatar"=>$filename]:null]);
    }

    public function getAll()//для апі
    {
        $DBase = new DB(null);
        $userData = $DBase->select("user_data",false);
        return $userData;
    }


    public function loadAva()
    {
        if( isset( $_GET['upload'] ) )
        {
            $error = false;
            $files = array();

            $uploaddir = 'avatares/'; // куди зберігати аватарки

            if (!is_dir($uploaddir)) mkdir($uploaddir, 0777);
            $data = json_encode(\core\Images::loadintemp($_FILES, $uploaddir));
            return $data;
        }
    }

    public function __construct()
    {

    }


}



?>