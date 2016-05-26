
<div class="bs-reply bs-callout-info">
    <?php
    foreach ($items[$parent_id] as $comment)
    {?>
        <div>
            <h4 class="text-left"><?= $comment['title'] ?></h4>
            <div class="text-justify"><?= $comment['text'] ?></div>
            <small>by <cite><?= $comment['name'] . " " . $comment['l_name'] ?>  </cite></small>
            <div class="btn-group pull-right">
                <?php
                if (\model\User::IsTrueUser()) {
                    ?>
                    <a href="#modal" class="btn btn-primary modalbtn" id="<?= $comment['id'] ?>"
                       article_id="<?= $comment['id_article'] ?>" role="button">Reply...</a>
                    <?php
                    if (($comment['id_user'] == $_COOKIE['id'])) { ?>
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
                } ?>
            </div>

        </div>
        <?php
        $this->buildTree($items,$comment['id']);
        ?>
    <?php } ?>
</div>


