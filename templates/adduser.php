<form action="<?=SITE."user/joinAction"?>" method="post"
      enctype="multipart/form-data"
      style="margin: 0 auto; width: 500px">
    <div class="form-group">
        <label for="exampleInputEmail1">Email address</label>
        <input name="email" type="email" class="form-control" id="exampleInputEmail1" placeholder="Email">
    </div>
    <div class="form-group">
        <label for="exampleInputEmail1">Name</label>
        <input name="name" type="text" class="form-control" id="exampleInputEmail1" placeholder="Name" value="<?=$name?>">
    </div>
    <div class="form-group">
        <label for="exampleInputEmail1">Last Name</label>
        <input name="l_name" type="text" class="form-control" id="exampleInputEmail1" placeholder="Last Name">
    </div>
    <div class="form-group">
        <label for="exampleInputEmail1">Phone</label>
        <input name="phone" type="phone" class="form-control" id="exampleInputEmail1" placeholder="Phone">
    </div>
    <div class="form-group">
        <label for="exampleInputEmail1">Birthdate</label>
        <input name="birthday" type="date" class="form-control" id="exampleInputEmail1" placeholder="birthday">
    </div>
    <!--
    <div class="form-group">
        <label for="exampleInputEmail1">City</label>
        <select class="form-control" name="city">
            <?php /*foreach ($cities as $city)
            { */?>
                <option value = "<?/*=$city['id'];*/?>"><?/*=$city['name'];*/?></option>
            <?php /*} */?>
        </select>
    </div>
    -->

    <div>
        <input type="hidden" name="city" id="cityId">
        <input type="text" id="city" name="city" placeholder="Kyiv">

        <div>
            <ul id="cityList">

            </ul>
        </div>
    </div>
    <div class="form-group">
        <label for="exampleInputEmail1">Avatar</label>
        <input name="avatar" type="file" class="form-control" id="exampleInputEmail1" placeholder="You avatar">
    </div>
    <div class="form-group">
        <label for="exampleInputPassword1">Password</label>
        <input name="pass" type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
    </div>
    <div class="form-group">
        <label for="exampleInputPassword1">Confirm password</label>
        <input name="confirmPass" type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
    </div>
    <button type="submit" class="btn btn-default">Submit</button>
</form>