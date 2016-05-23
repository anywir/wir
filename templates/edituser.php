
<div>
<div class="col-lg-3">
    <img src="<?=SITE?>avatares/<?=$userData['avatar']?>" class="img-responsive" alt="Responsive image" >
</div>
    <div class="col-md-5">
<form  action="<?=SITE."user/update"?>" method="post"
      enctype="multipart/form-data"
      style="margin: 0 auto; width: 500px">
    <div class="form-group">
        <label for="exampleInputEmail1">Name</label>
        <input name="name" type="text" class="form-control" id="exampleInputEmail1" placeholder="Name" value="<?=$userData['name']?>">
    </div>
    <div class="form-group">
        <label for="exampleInputEmail1">Last Name</label>
        <input name="l_name" type="text" class="form-control" id="exampleInputEmail1" placeholder="Last Name" value="<?=$userData['l_name']?>">
    </div>
    <div class="form-group">
        <label for="exampleInputEmail1">Phone</label>
        <input name="phone" type="phone" class="form-control" id="exampleInputEmail1" placeholder="Phone" value="<?=$userData['phone']?>">
    </div>
    <div class="form-group">
        <label for="exampleInputEmail1">Birthdate</label>
        <input name="birthday" type="date" class="form-control" id="exampleInputEmail1" placeholder="birthday" value="<?=$userData['birthdate']?>">
    </div>
    <div class="form-group">
        <label for="exampleInputEmail1">City</label>
        <select class="form-control" name="city">
            <?php foreach ($cities as $city)
{ ?>
    <option <?=($city['id']==$userData['idCity'])?  "selected" : "" ?> value = "<?=$city['id'];?>" ><?=$city['name'];?></option>
<?php } ?>
</select>
</div>
<div class="form-group">
    <label for="exampleInputEmail1">Avatar</label>
    <input name="avatar" type="file" class="form-control" id="exampleInputEmail1" placeholder="You avatar">
</div>

<button type="submit" class="btn btn-default">Submit</button>
</form>
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

