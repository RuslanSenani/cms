<div class="row">
    <div class="col-md-12">
        <h4 class="m-b-lg">
            Website Settings
            <a href="<?= base_url("settings/new_form"); ?>" class="btn btn-outline btn-primary btn-xs pull-right"> <i
                        class="fa fa-plus"></i> Add New </a>
        </h4>
    </div>
    <div class="col-md-12">
        <div class="widget">
            <header class="widget-header">
            </header>
            <hr class="widget-separator">
            <div class="widget-body">
                <div class="widget p-lg">
                    <?php if (empty($items)) { ?>
                        <div class="alert alert-info text-center">
                            <p>There is no data available here. Click please <a
                                        href="<?= base_url("settings/new_form"); ?>">Add</a></p>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>