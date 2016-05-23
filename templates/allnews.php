<div>

<?php

foreach ($news as $arrt)
{ ?>
    <blockquote>
        <p class="text-center"><?=$arrt['title']?><p>
        <img class="center-block" src="<?=SITE?>files/<?=$arrt['image']?>"width="280" >
        <div class="text-justify"><?=$arrt['text']?></div>
        <small>by <cite><?=$arrt['name']." ".$arrt['l_name']?>  </cite>
            <a href="<?= SITE ?>comment/thread?id=<?= $arrt['id'] ?>">Read comment</a>
        </small>
        <div class="btn-group pull-right " >
        <?php
        if(\model\User::IsTrueUser())
        {
            if (($idUser == $arrt['id_user'])&&($_COOKIE['id'] == $idUser)) { ?>
                <a href="<?= SITE ?>news/delnews?id=<?= $arrt['id'] ?>" class="btn btn-danger"
                                         role="button">Delete this</a>
            <?php }
            elseif ($arrt['id_user']!=$_COOKIE['id'])
            {
                ?>
                <a href="#modal" class="btn btn-primary modalbtn" id="0" article_id="<?= $arrt['id'] ?>" role="button">Comment this...</a>
                <?php
            }
            if ($arrt["sub"]) { ?>
                <a href="<?= SITE ?>subs/delsubs?id=<?= $arrt['id_user'] ?>" class="btn btn-default"
                                         role="button">Unsubscribe</a>
                <?php
            } elseif ($_COOKIE['id'] != $arrt['id_user']) { ?>
                <a href="<?= SITE ?>subs/addsubs?id=<?= $arrt['id_user'] ?>" class="btn btn-success"
                                         role="button">Subscribe</a>
                <?php
            }
        }?>
        </div>
    </blockquote>
<?php } ?>

</div>

<ul class="pagination">
    <li><a href="<?=SITE?>news/<?=($subs)?"subs":"getAll"?>?skip=<?=(($current<2)? 0: ($current-2)*$count)?><?=($idUser)?"&id=$idUser":""?>"><<</a></li>
    <?php // тут треба якось змінити посилання для того щоб одним методом виводить і всі новини і підписку.
        for ($i=1;$i<=$pages;$i++)
        {
            ?>
            <li class="<?=($i==$current)?  "active" : "" ?>"><a href="<?=SITE?>news/<?=($subs)?"subs":"getAll"?>?skip=<?=($i-1)*$count?><?=($idUser)?"&id=$idUser":""?>"><?=$i?></a></li>
    <?php

        }
    ?>


    <li><a href="<?=SITE?>news/<?=($subs)?"subs":"getAll"?>?skip=<?=(($i-1==$current)?$current-1:$current)*$count?><?=($idUser)?"&id=$idUser":""?>">>></a></li>
</ul>