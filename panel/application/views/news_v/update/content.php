<div class="row">
    <div class="col-md-12">
        <h4 class="m-b-lg">
            Update New News
        </h4>
    </div>
    <div class="col-md-12">
        <div class="widget">
            <hr class="widget-separator">
            <div class="widget-body">
                <form action="<?= base_url("news/update/$item->id"); ?>" method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <label>Title</label>
                        <input class="form-control" placeholder="Title" value="<?= $item->title; ?>" name="title">
                        <?php if (isset($form_error)) { ?>
                            <small class="input-form-error"><?= form_error("title"); ?></small>
                        <?php } ?>
                    </div>

                    <div class="form-group">
                        <label>Description</label>
                        <textarea name="description" class="m-0" data-plugin="summernote" data-options="{height: 250}">
                       <?= $item->description; ?>
                        </textarea>
                    </div>
                    <!-- section -->

                    <div class="form-group">
                        <label for="control-demo-6" class="">News Type</label>
                        <div id="control-demo-6" class="">
                            <?php if (isset($form_error)) { ?>
                                <select class="form-control news_type_select" name="news_type">
                                    <option value="image" <?= ($news_type == "image") ? "selected" : ""; ?>>Image</option>
                                    <option value="video" <?= ($news_type == "video") ? "selected" : ""; ?>>Video</option>
                                </select>
                            <?php } else { ?>
                                <select class="form-control news_type_select" name="news_type">
                                    <option value="image" <?= ($item->news_type == "image") ? "selected" : ""; ?>>Image</option>
                                    <option value="video" <?= ($item->news_type == "video") ? "selected" : ""; ?>>Video</option>
                                </select>
                            <?php } ?>
                        </div>
                    </div><!-- .form-group -->
                    <?php if (isset($form_error)) { ?>
                        <div class="form-group image_upload_container" style="display:<?= ($news_type == "image") ? "block" : "none"; ?>;">
                            <label>Choose Image</label>
                            <input type="file" name="img_url" title="Salam" class="form-control">
                        </div>
                        <div class="form-group video_url_container" style="display:<?= ($news_type == "video") ? "block" : "none"; ?>;">
                            <label>Video URL</label>
                            <input class="form-control" placeholder="Video url-ni bura elave edin" name="video_url">
                            <?php if (isset($form_error)) { ?>
                                <small class="input-form-error"><?= form_error("video_url"); ?></small>
                            <?php } ?>
                        </div>
                    <?php } else { ?>
                        <div class="row">
                            <div class="col-md-1 image_upload_container" style="display:<?= ($item->news_type == "image") ? "block" : "none"; ?>;">
                                <img src="<?= base_url("uploads/{$viewFolder}/$item->img_url") ?>" class="img-responsive">
                            </div>
                            <div class="form-group image_upload_container col-md-11" style="display:<?= ($item->news_type == "image") ? "block" : "none"; ?>;">
                                <label>Choose Image</label>
                                <input type="file" name="img_url" value="<?= $item->img_url; ?>" class="form-control">
                            </div>
                        </div>
                        <div class="form-group video_url_container" style="display:<?= ($item->news_type == "video") ? "block" : "none"; ?>;">
                            <label>Video URL</label>
                            <input class="form-control" placeholder="Video url-ni bura elave edin" value="<?= $item->video_url; ?>" name="video_url">
                        </div>
                    <?php } ?>

                    <button type="submit" class="btn btn-primary btn-md btn-outline">Update</button>
                    <a href="<?= base_url("news"); ?>" class="btn btn-outline btn-danger">Cancle</a>
                </form>
            </div>
        </div>
    </div>
</div>