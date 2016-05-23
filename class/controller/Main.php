<?php
/**
 * Created by PhpStorm.
 * User: User15
 * Date: 04.05.16
 * Time: 19:27
 */

namespace controller;


use core\Controller;

class Main extends Controller
{
    public function index()
    {

        $this->model = new \model\Main();
        $data = $this->model->GetData();
        $this->view = new \view\News();
        $this->view->showMainSlide($data);
    }
} 