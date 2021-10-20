<div class="row">
    <div class="col-md-12">
        <h4 class="m-b-lg">
            Update New Brands
        </h4>
    </div>
    <div class="col-md-12">
        <div class="widget">
            <hr class="widget-separator">
            <div class="widget-body">
                <form action="<?= base_url("brands/update/$item->id"); ?>" method="POST"
                      enctype="multipart/form-data">
                    <div class="form-group">
                        <label>Title</label>
                        <input class="form-control" placeholder="Title" value="<?= $item->title; ?>" name="title">
                        <?php if (isset($form_error)) { ?>
                            <small class="input-form-error"><?= form_error("title"); ?></small>
                        <?php } ?>
                    </div>

                    <div class="row">
                        <div class="col-md-1 image_upload_container">
                            <img src="<?= base_url("uploads/{$viewFolder}/$item->img_url") ?>" class="img-responsive">
                        </div>
                        <div class="form-group image_upload_container col-md-11">
                            <label>Choose Image</label>
                            <input type="file" name="img_url" value="<?= $item->img_url; ?>" class="form-control">
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary btn-md btn-outline">Update</button>
                    <a href="<?= base_url("brands"); ?>" class="btn btn-outline btn-danger">Cancle</a>
                </form>
            </div>
        </div>
    </div>
</div>