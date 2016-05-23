<?php if(\model\User::IsTrueUser())
{
    ?>
    <form action="<?= SITE . "news/addAction" ?>" method="post"
          enctype="multipart/form-data"
          class="col-md-8 col-md-offset-2">
        <div class="form-group">
            <label for="title">Title</label>
            <input name="title" type="text" class="form-control" id="title">
        </div>
        <div class="form-group">
            <label for="text">Your article:</label>
            <textarea name="text" rows="5" class="form-control" id="summernote"></textarea>
        </div>
        <div class="form-group">
            <label for="image">image</label>
            <input name="image" type="file" class="form-control" id="image" placeholder="image">
        </div>
        <button type="submit" class="btn btn-default">Submit</button>
    </form>
    <?php
}
else
{ ?>

    <div class="alert alert-danger">
        <strong>ERROR</strong>
    </div>
<?php
}
?>