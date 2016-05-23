<?php

namespace view;


class News
{

    public function  showMainSlide($news)
    {
        include_once "templates/head.php";
        include_once "templates/menu.php";
        include_once "templates/slidenews.php";
        include_once "templates/footer.php";
    }
    public function showAllNews($news,$pages,$current,$count,$idUser,$subs)
    {
        include_once "templates/head.php";

        $active = ($idUser)?"mynews":"news";
        $active = ($subs)?"subs":$active;
        include_once "templates/menu.php";

        if ($news ==null)
        {
           
            $title = "Error!";
            $warning = "Articles not found";
            include_once "templates/warning.php";
        }
        else
        {
            include_once "templates/allnews.php";
        }

        include_once "templates/modaladdmesage.php";
        include_once "templates/footer.php";
    }
    public function showAddForm()
    {
        include_once "templates/head.php";
        $active = "addnews";
        include_once "templates/menu.php";

        include_once "templates/addnews.php";


        include_once "templates/footer.php";

    }
} 