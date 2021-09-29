<div class="row">
    <div class="col-md-12">
        <h4 class="m-b-lg">
            Add New Courses
        </h4>
    </div>
    <div class="col-md-12">
        <div class="widget">
            <hr class="widget-separator">
            <div class="widget-body">
                <form action="<?= base_url("courses/insert"); ?>" method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <label>Title</label>
                        <input class="form-control" placeholder="Title" name="title">
                        <?php if (isset($form_error)) { ?>
                            <small class="input-form-error"><?= form_error("title"); ?></small>
                        <?php } ?>
                    </div>

                    <div class="form-group">
                        <label>Description</label>
                        <textarea name="description" class="m-0" data-plugin="summernote"
                                  data-options="{height: 250}"></textarea>
                    </div>
                    <!-- section -->
                    <div class="row">
                        <div class="col-md-3">
                            <label for="datetimepicker1">Course Date</label>
                            <input type="hidden" name="event_date" id="datetimepicker1" data-plugin="datetimepicker"
                                   data-options="{ inline: true, viewMode: 'days',format:'YYYY-MM-DD HH:mm:ss'}"/>
                        </div><!-- END column -->

                    </div>
                    <div class="form-group image_upload_container">
                        <label>Choose Image</label>
                        <input type="file" name="img_url" class="form-control">
                    </div>

                    <button type="submit" class="btn btn-primary btn-md btn-outline">Save</button>
                    <a href="<?= base_url("courses"); ?>" class="btn btn-outline btn-danger">Cancle</a>
                </form>
            </div>
        </div>
    </div>
</div>