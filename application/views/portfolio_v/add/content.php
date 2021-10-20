<div class="row">
    <div class="col-md-12">
        <h4 class="m-b-lg">
            Add New Portfolio
        </h4>
    </div>
    <div class="col-md-12">
        <div class="widget">
            <hr class="widget-separator">
            <div class="widget-body">
                <form action="<?= base_url("portfolio/insert"); ?>" method="POST">
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label>Title</label>
                            <input class="form-control" placeholder="Title" name="title">
                            <?php if (isset($form_error)) { ?>
                                <small class="input-form-error"><?= form_error("title"); ?></small>
                            <?php } ?>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Category</label>
                            <select name="category_id" class="form-control">
                                <?php foreach ($categories as $category): ?>
                                    <option value="<?= $category->id ?>"><?= $category->title ?></option>
                                <?php endforeach; ?>
                            </select>
                            <?php if (isset($form_error)) { ?>
                                <small class="input-form-error"><?= form_error("category_id"); ?></small>
                            <?php } ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <label for="datetimepicker1">Finished Date</label>
                            <input type="hidden" name="finishedAt" id="datetimepicker1" data-plugin="datetimepicker"
                                   data-options="{ inline: true, viewMode: 'days',format:'YYYY-MM-DD HH:mm:ss'}"/>
                        </div>
                        <div class="col-md-8">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Client</label>
                                        <input class="form-control" placeholder="Client" name="client">
                                        <?php if (isset($form_error)) { ?>
                                            <small class="input-form-error"><?= form_error("client"); ?></small>
                                        <?php } ?>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Place</label>
                                        <input class="form-control" placeholder="Place" name="place">
                                        <?php if (isset($form_error)) { ?>
                                            <small class="input-form-error"><?= form_error("place"); ?></small>
                                        <?php } ?>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Portfolio URL</label>
                                        <input class="form-control" placeholder="Portfolio URL" name="portfolio_url">
                                        <?php if (isset($form_error)) { ?>
                                            <small class="input-form-error"><?= form_error("portfolio_url"); ?></small>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Description</label>
                        <textarea name="description" class="m-0" data-plugin="summernote" data-options="{height: 250}"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary btn-md btn-outline">Save</button>
                    <a href="<?= base_url("portfolio"); ?>" class="btn btn-outline btn-danger">Cancle</a>
                </form>
            </div>
        </div>
    </div>
</div>