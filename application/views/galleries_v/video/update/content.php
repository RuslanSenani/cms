<div class="row">
    <div class="col-md-12">
        <h4 class="m-b-lg">
            <?= "Update <b>Video</b> List will be From DB" ?>
        </h4>
    </div>
    <div class="col-md-12">
        <div class="widget">
            <hr class="widget-separator">
            <div class="widget-body">
                <form action="<?= base_url("galleries/gallery_video_update/$item->id/$item->gallery_id"); ?>" method="POST">
                    <div class="form-group">
                        <label>Video URL</label>
                        <input class="form-control" placeholder="Video url-ni bura elave edin" name="url" value="<?=$item->url;?>">
                        <?php if (isset($form_error)) { ?>
                            <small class="input-form-error"><?= form_error("url"); ?></small>
                        <?php } ?>
                    </div>
                    <button type="submit" class="btn btn-primary btn-md btn-outline">Update</button>
                    <a href="<?= base_url("galleries/gallery_video_list/$item->gallery_id"); ?>" class="btn btn-outline
                    btn-danger">Cancle</a>
                </form>
            </div>
        </div>
    </div>
</div>