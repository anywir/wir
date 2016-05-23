<?php
/**
 * Created by PhpStorm.
 * User: parhomenkoav
 * Date: 12.05.2016
 * Time: 13:37
 */

namespace controller;


class Api
{
    public function __call($name,$arg) 
    {
        $classname="\\model\\".ucfirst($name);
        $json = null;
        $methodName = $arg[0];
        $this->model = new $classname();
        if (method_exists($this->model , $methodName))
        {
            $res = $this->model->$methodName();
            $json = json_encode($res);
        }
        header('Content-type: application/json');
        echo $json;

        // для кожного апі треба в моделі робити метод під апі, де парситься POST чи GET
   }

}