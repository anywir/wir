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
            }
            if (isset($pathArr[$methodNum])) {
                $methodName = $pathArr[$methodNum];
                $methodName = preg_replace("/\?.*/","",$methodName);
            }

            $resultArr = [$className,$methodName];

            return $resultArr;
        }
        public static function rout()
        {
            $arr = self::getPath();
/*
            $n = 0;
            foreach ($arr as $val )
            {

                if ($n===0)
                $className = ucfirst($val?$val:"Main");
                elseif ($n===1)
                {
                    $methodName = $val?$val:"index";
                    echo $n;
                }
                else $args[] = $val;

                $n++;
                echo $n;
            }
*/
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
                else echo " page not found 404";
            }
            else echo " page not found 404";

        }
    }

}

//__call(