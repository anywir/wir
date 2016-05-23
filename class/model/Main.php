<?php
/**
 * Created by PhpStorm.
 * User: User15
 * Date: 04.05.16
 * Time: 19:48
 */

namespace model;


class Main
{
    public function GetData()
    {
        $newsModel = new News();

        return  $newsModel->getPartNews(0,3);

    }

} 