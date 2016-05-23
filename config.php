<?php

define("DEVMODE", '0'); // 1 - на курсах 0- дома  CKeditor
define ("COUNTINPAGE", 4);//кількість новин на сторінку
if (DEVMODE) {
    define("SITE", "http://xxi-lnx/users/phpStart/wir/oop/oop_prj/");
    define("P_METOD","7");
    define("P_CLASS","6");
}
else{
    define("SITE", "http://localhost/kurs/oop_prj/");
    define("P_METOD","4");
    define("P_CLASS","3");
}

function __autoload($className)
{
    $className = preg_replace("/\\\\/","/",$className);
    if (file_exists("class/".$className.".php"))
    {
        include_once "class/".$className.".php";
    }
}
