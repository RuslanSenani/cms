<div class="row">
    <div class="col-md-12">
        <h4 class="m-b-lg">
            Update New Portfolio Category
        </h4>
    </div>
    <div class="col-md-12">
        <div class="widget">
            <hr class="widget-separator">
            <div class="widget-body">
                <form action="<?= base_url("portfolio_categories/update/$item->id"); ?>" method="POST">
                    <div class="form-group">
                        <label>Title</label>
                        <input class="form-control" placeholder="Title" value="<?= $item->title; ?>" name="title">
                        <?php if (isset($form_error)) { ?>
                            <small class="input-form-error"><?= form_error("title"); ?></small>
                        <?php } ?>
                    </div>
                    <button type="submit" class="btn btn-primary btn-md btn-outline">Update</button>
                    <a href="<?= base_url("portfolio_categories"); ?>" class="btn btn-outline btn-danger">Cancle</a>
                </form>
            </div>
        </div>
    </div>
</div>