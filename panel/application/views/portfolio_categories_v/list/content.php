<div class="row">
    <div class="col-md-12">
        <h4 class="m-b-lg">
            Portfolio Categories List will be From DB
            <a href="<?= base_url("portfolio_categories/new_form"); ?>" class="btn btn-outline btn-primary btn-xs pull-right"> <i
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
                                        href="<?= base_url("portfolio_categories/new_form"); ?>">Add</a></p>
                        </div>
                    <?php } else { ?>

                        <table class="table table-hover table-bordered content_container">
                            <thead>
                            <tr>
                                <th><i class="fa fa-2x">#</i></th>
                                <th>Title</th>
                                <th>Status</th>
                                <th>Process</th>
                            </tr>
                            </thead>

                            <tbody>
                            <?php $count = 0;
                            foreach ($items as $item) {
                                $count++; ?>
                                <tr>
                                    <td class="w10">#<?= $count; ?></td>
                                    <td class="wAuto text-center"><?= $item->title; ?></td>
                                    <td class="w20 text-center">
                                        <input data-url="<?= base_url("portfolio_categories/isActiveSetter/$item->id"); ?>"
                                               class="isActive" id="" type="checkbox" data-switchery
                                               data-color="#10c469" <?= ($item->isActive) ? "checked" : ""; ?> />
                                    </td>
                                    <td class="w200 text-center">
                                        <button data-url="<?= base_url("portfolio_categories/delete/$item->id"); ?>"
                                                class=" btn btn-sm btn-danger btn-outline remove-btn">
                                            <i class="be-like fa fa-trash"></i>
                                            Delete
                                        </button>
                                        <a href="<?= base_url("portfolio_categories/update_form/$item->id"); ?>"
                                           class=" btn btn-sm btn-success btn-outline">
                                            <i class="fa fa-pencil-square-o"></i>
                                            Update
                                        </a>

                                    </td>
                                </tr>
                            <?php } ?>

                            </tbody>
                        </table>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>