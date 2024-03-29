<div class="row">
    <div class="col-md-12">
        <h4 class="m-b-lg">
            Add New Product
        </h4>
    </div>
    <div class="col-md-12">
        <div class="widget">
            <hr class="widget-separator">
            <div class="widget-body">
                <form action="<?= base_url("product/insert"); ?>" method="POST">
                    <div class="form-group">
                        <label>Title</label>
                        <input class="form-control" placeholder="Title" name="title">
                        <?php if (isset($form_error)) { ?>
                            <small class="input-form-error"><?= form_error("title"); ?></small>
                        <?php } ?>
                    </div>
                    <div class="form-group">
                        <label>Description</label>
                        <textarea name="description" class="m-0" data-plugin="summernote" data-options="{height: 250}"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary btn-md btn-outline">Save</button>
                    <a href="<?= base_url("product"); ?>" class="btn btn-outline btn-danger">Cancle</a>
                </form>
            </div>
        </div>
    </div>
</div>