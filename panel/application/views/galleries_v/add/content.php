<div class="row">
    <div class="col-md-12">
        <h4 class="m-b-lg">
            Add New Gallery
        </h4>
    </div>
    <div class="col-md-12">
        <div class="widget">
            <hr class="widget-separator">
            <div class="widget-body">
                <form action="<?= base_url("galleries/insert"); ?>" method="POST">
                    <div class="form-group">
                        <label>Gallery Name</label>
                        <input class="form-control" placeholder="Enter The Gallery Name" name="title">
                        <?php if (isset($form_error)) { ?>
                            <small class="input-form-error"><?= form_error("title"); ?></small>
                        <?php } ?>
                    </div>
                    <div class="form-group">
                        <label for="control-demo-6" class="">Gallery Type</label>
                        <div id="control-demo-6" class="">
                            <select class="form-control news_type_select" name="gallery_type">
                                <option value="image" <?= (isset($gallery_type) && $gallery_type == "image") ? "selected" : ""; ?>>Image</option>
                                <option value="video" <?= (isset($gallery_type) && $gallery_type == "video") ? "selected" : ""; ?>>Video</option>
                                <option value="file" <?= (isset($gallery_type) && $gallery_type == "file") ? "selected" : ""; ?>>File</option>
                            </select>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary btn-md btn-outline">Save</button>
                    <a href="<?= base_url("galleries"); ?>" class="btn btn-outline btn-danger">Cancel</a>
                </form>
            </div>
        </div>
    </div>
</div>