<div class="col-lg-3">

    <div class="form-group">
        <label for="exampleInputEmail1">Avatar</label>
        <img src="<?=SITE?>avatares/default.png" class="img-responsive" alt="Responsive image" >
        <input name="avatar" type="file" class="form-control" id="avatar" placeholder="You avatar" accept=".txt,image/*">
        <div class="ajax-respond"></div>
    </div>
</div>
<div class="col-md-5" >
<form action="<?=SITE."user/joinAction"?>" method="post"
      enctype="multipart/form-data"
      style="margin: 0 auto; width: 500px">
    <div class="form-group" id="email_f">
        <label for="email">Email address</label>
        <div class=" alert alert-danger" style="display: none" id="alert">
            <strong>ERROR</strong> this address is exist
        </div>
        <input name="email" type="email" class="form-control" id="email" placeholder="Email">
    </div>
    <div class="form-group">
        <label for="name">Name</label>
        <input name="name" type="text" class="form-control" id="name" placeholder="Name" value="<?=$name?>">
    </div>
    <div class="form-group">
        <label for="l_name">Last Name</label>
        <input name="l_name" type="text" class="form-control" id="l_name" placeholder="Last Name">
    </div>
    <div class="form-group">
        <label for="phone">Phone</label>
        <input name="phone" type="phone" class="form-control" id="phone" placeholder="Phone">
    </div>
    <div class="form-group">
        <label for="birthday">Birthdate</label>
        <input name="birthday" type="date" class="form-control" id="birthday" placeholder="birthday">
    </div>
    <div>
        <input type="hidden" name="city" id="cityId">
        <input type="text" id="city" name="city" placeholder="Kyiv">

        <div>
            <ul id="cityList" class="dropdown-menu">

            </ul>
        </div>
    </div>
    <div class="form-group">
        <label for="exampleInputPassword1">Password</label>
        <input name="pass" type="password" class="form-control" id="pass_a" placeholder="Password">
    </div>
    <div class="form-group">
        <label for="exampleInputPassword1">Confirm password</label>
        <input name="confirmPass" type="password" class="form-control" id="pass_b" placeholder="Password">
    </div>
    <button type="submit" class="btn btn-default">Submit</button>
</form>
</div>