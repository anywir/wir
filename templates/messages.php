<?php


foreach ($thread as $comment)
{ ?>
    <div class="bs-callout bs-callout-info">
        <h4 class="text-left"><?=$comment['title']?></h4>
        <div class="text-justify"><?=$comment['text']?></div>
        <small>by <cite><?=$comment['name']." ".$comment['l_name']?>  </cite></small>
        <div class="btn-group pull-right" >
            <?php
            if(\model\User::IsTrueUser())
            {
                ?>
                <a href="#modal" class="btn btn-primary modalbtn" id="<?= $comment['id'] ?>" article_id="<?= $article['id'] ?>" role="button">Reply...</a>
                <?php
                if ( ($comment['id_user']==$_COOKIE['id'])) { ?>
                    <a href="<?= SITE ?>comment/del?id=<?= $comment['id'] ?>" class="btn btn-danger"
                       role="button">Delete this</a>
                <?php }

                if ($comment["sub"]) { ?>
                    <a href="<?= SITE ?>subs/delsubs?id=<?= $comment['id_user'] ?>" class="btn btn-default"
                       role="button">Unsubscribe</a>
                    <?php
                } elseif ($_COOKIE['id'] != $comment['id_user']) { ?>
                    <a href="<?= SITE ?>subs/addsubs?id=<?= $comment['id_user'] ?>" class="btn btn-success"
                       role="button">Subscribe</a>
                    <?php
                }
            }?>
        </div>
    </div>
<?php }

?>



<ul class="pagination">
    <li><a href="<?=SITE?>news/<?=($subs)?"subs":"getAll"?>?skip=<?=(($current<2)? 0: ($current-2)*$count)?><?=($idUser)?"&id=$idUser":""?>"><<</a></li>
    <?php
    for ($i=1;$i<=$pages;$i++)
    {
        ?>
        <li class="<?=($i==$current)?  "active" : "" ?>"><a href="<?=SITE?>news/<?=($subs)?"subs":"getAll"?>?skip=<?=($i-1)*$count?><?=($idUser)?"&id=$idUser":""?>"><?=$i?></a></li>
        <?php

    }
    ?>


    <li><a href="<?=SITE?>news/<?=($subs)?"subs":"getAll"?>?skip=<?=(($i-1==$current)?$current-1:$current)*$count?><?=($idUser)?"&id=$idUser":""?>">>></a></li>
</ul>
