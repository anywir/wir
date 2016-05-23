<div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bt-navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="<?=SITE.""?>">Newsbook</a>
        </div>
        <div class="collapse navbar-collapse" id="bt-navbar-collapse">
            <ul class="nav navbar-nav">
                <li class="<?=($active == "news")? "active" : ""?>"><a href="<?=SITE ?>news">News</a></li>
                <?php
                    if(\model\User::IsTrueUser())
                    {
                    ?>
                        <li class="<?=($active == "subs")? "active" : ""?>"><a href="<?= SITE ?>news/subs?id=<?=$_COOKIE['id']?>">Subscribes</a></li>
                        <li class="<?=($active == "mynews")? "active" : ""?>"><a href="<?= SITE ?>news/getall?id=<?=$_COOKIE['id']?>">My post</a></li>
                <?php
                    } ?>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <?php
                if(\model\User::IsTrueUser())
                {
                    ?>
                    <li class="<?=($active == "user")? "active" : ""?>"><a href="<?= SITE ?>user/home"><?=$_COOKIE['auth']?></a></li>
                    <li class="<?=($active == "addnews")? "active" : ""?>"><a href="<?= SITE ?>news/addnews">New post</a></li>
                    <li><a href="<?= SITE . "user/logout" ?>">Logout</a></li>

                    <?php
                }
                else
                { ?>
                    <li class="<?=($active == "login")? "active" : ""?>"><a href="<?= SITE ?>user/login">Login</a></li>
                    <li class="<?=($active == "join")? "active" : ""?>"><a href="<?= SITE  ?>user/join" >Join</a></li>
                    <?php
                }
                ?>
            </ul>
        </div><!--/.nav-collapse -->
    </div>
</div>
<div class="container-fluid ">

    <div class="starter-template">
        <h1><s>The</s> Newsbook</h1>
        <p class="lead">It's our new portal. With Black Jack and cats</p>
    </div>