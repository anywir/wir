<?php


namespace core
{
    class Routing
    {

        public static  function getPath()
        {
            $pathArr = explode("/",$_SERVER['REQUEST_URI']);
            $methodName = false;
            $methodNum = P_METOD;
            $className = false;
            $classNum = P_CLASS;

            if (isset($pathArr[$classNum])) {
                $className = $pathArr[$classNum];
                $className = preg_replace("/\?.*/","",$className);
            }
            if (isset($pathArr[$methodNum])) {
                $methodName = $pathArr[$methodNum];
                $methodName = preg_replace("/\?.*/","",$methodName);
            }
            $resultArr = [$className,$methodName];
            for ($n=P_METOD+1;$n<count($pathArr);$n++)
            {
                $resultArr[] = preg_replace("/\?.*/","",$pathArr[$n]);
            }


            return $resultArr;
        }
        public static function rout()
        {
            $arr = self::getPath();
            $className = ucfirst($arr[0]?$arr[0]:"Main");
            $methodName = $arr[1]?$arr[1]:"index";
            $className = "\\controller\\".$className;

            if (class_exists($className))
            {
                $obj = new $className();
                if (method_exists($obj, $methodName))
                {
                    $obj->$methodName();
                }
                elseif ($className=='\\controller\\Api') $obj->$methodName($arr[2]);
                else echo " page not found 404";
            }
            else echo " page not found 404";

        }
    }

}

//__call(