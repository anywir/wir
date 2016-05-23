<div>
    <h4 class="text-center"><?=$article['title']?></h4>
    <img class="center-block" src="<?=SITE?>files/<?=$article['image']?>"width="280" >
    <div class="text-justify"><?=$article['text']?></div>
    <small>by <cite><?=$article['name']." ".$article['l_name']?>  </cite>
    </small>
    <?php
    if(\model\User::IsTrueUser()) {
        ?>

            <a href="#modal" class="btn btn-primary pull-right modalbtn" id="0"
               article_id="<?= $article['id'] ?>" role="button">Comment this...</a>
            <?php

    }?>


</div>

