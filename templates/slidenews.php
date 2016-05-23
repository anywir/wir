
<div id="carousel-news" class="carousel slide" data-ride="carousel">
    <!-- Указатели -->
    <ol class="carousel-indicators">
        <li data-target="#carousel-news" data-slide-to="0" class="active"></li>
        <li data-target="#carousel-news" data-slide-to="1"></li>
        <li data-target="#carousel-news" data-slide-to="2"></li>
    </ol>
    <!-- Контент слайда (slider wrap)-->
    <div class="carousel-inner" >
        <?php
        $active = true;
        foreach ($news as $arrt)
        { ?>
            <div class="item <?=($active)?"active":""?>">
                <img class="center-block" src="<?=SITE?>files/<?=$arrt['image']?>"  style=" width: auto; height: 400px !important;" >
                <div class="carousel-caption">
                    <p class="text-center"><?=$arrt['title']?><p>
                </div>
            </div>
            <?php $active = false;
        } ?>

    </div>
    <!-- Элементы управления -->
    <a class="left carousel-control" href="#carousel-news" data-slide="prev">
        <span class="glyphicon glyphicon-chevron-left"></span>
    </a>
    <a class="right carousel-control" href="#carousel-news" data-slide="next">
        <span class="glyphicon glyphicon-chevron-right"></span>
    </a>
</div>

