
<div>
<div class="col-lg-3">
    <img src="<?=SITE?>avatares/<?=$userData['avatar']?>" class="img-responsive" alt="Responsive image" >

</div>
<div class="col-md-5" >

    <p><?=$userData['name']?></p>
    <p><?=$userData['l_name']?></p>
    <p class="glyphicon glyphicon-phone-alt"> <?=$userData['phone']?></p>
    <p>birthday <?=$userData['birthdate']?></p>
    <p>city <?=$city?></p>
    <p class="text-right"><a href="<?= SITE ?>news/getall?id=<?= $userData['id'] ?>" class="btn btn-success"
                             role="button">Articles</a></p>
</div>
<div class="col-lg-2">
    <p class="lead">Subscribes</p>
    <ul class="list-group">
        <?php
        foreach ($subs as $author)
        {
        ?>
            <li class="list-group-item"><a href="<?= SITE ?>user/show?id=<?=$author['id']?>"><?=$author['email']?></a></li>
        <?php }?>


    </ul>

</div>
</div>
