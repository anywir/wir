<div id="modal" class="modal fade" >
    <div class="modal-dialog">
        <div class="modal-content">
                <!-- Заголовок модального окна -->
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
                    <h4 class="modal-title">Your comment</h4>
                </div>
                <!-- Основное содержимое модального окна -->
                <form action="<?= SITE . "comment/addAction" ?>" method="post"
                  enctype="multipart/form-data">
                <div class="modal-body">
                        <div class="form-group">
                            <label for="title">Title</label>
                            <input name="title" type="text" class="form-control" id="title">
                        </div>
                        <div class="form-group">
                            <label for="text">Message</label>
                            <textarea name="text" rows="5" class="form-control" id="summernote" ></textarea>
                        </div>

                        <input name="id_article" id="id_article" hidden>
                        <input name="id_reply" id="id_reply" hidden>
                </div>
                <!-- Футер модального окна -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
