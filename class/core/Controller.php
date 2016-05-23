<?php
/**
 * Created by PhpStorm.
 * User: User15
 * Date: 04.05.16
 * Time: 19:16
 */

namespace core;


abstract class Controller
{
    public $model;
    public $view;
    abstract function index();
/*    добавить перевірку користувача  в конструктоорі
а в юзері перегрузити конструктор
*/
} 