<div class="row">
    <div class="col-md-12">
        <h4 class="m-b-lg">
            Update Product
        </h4>
    </div>
    <div class="col-md-12">
        <div class="widget">
            <hr class="widget-separator">
            <div class="widget-body">
                <form action="<?= base_url("galleries/update/$item->id/$item->gallery_type/$item->folder_name"); ?>" method="POST">
                    <div class="form-group">
                        <label>Gallery Name</label>
                        <input class="form-control" placeholder="Enter The Gallery Name" name="title" value="<?= $item->title; ?>">
                        <?php if (isset($form_error)) { ?>
                            <small class="input-form-error"><?= form_error("title"); ?></small>
                        <?php } ?>
                    </div>
                    <button type="submit" class="btn btn-primary btn-md btn-outline">Update</button>
                    <a href="<?= base_url("galleries"); ?>" class="btn btn-outline btn-danger">Cancel</a>
                </form>
            </div>
        </div>
    </div>
</div>