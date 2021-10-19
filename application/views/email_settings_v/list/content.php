<div class="row">
    <div class="col-md-12">
        <h4 class="m-b-lg">
            E-mail List will be From DB
            <a href="<?= base_url("emailsettings/new_form"); ?>" class="btn btn-outline btn-primary btn-xs pull-right"> <i
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
                                        href="<?= base_url("emailsettings/new_form"); ?>">Add</a></p>
                        </div>
                    <?php } else { ?>

                        <table class="table table-hover table-bordered content_container">
                            <thead>
                            <tr>
                                <th class="w50 text-center">#id</th>
                                <th>E-mail Title</th>
                                <th>Host</th>
                                <th>Protocol</th>
                                <th>Port</th>
                                <th>E-mail</th>
                                <th>From</th>
                                <th>To</th>
                                <th>Status</th>
                                <th class="w150">Process</th>
                            </tr>
                            </thead>

                            <tbody>
                            <?php foreach ($items as $item) { ?>
                                <tr>
                                    <td class="w50"><?= $item->id; ?></td>
                                    <td><?= $item->user_name; ?></td>
                                    <td><?= $item->host; ?></td>
                                    <td><?= $item->protocol; ?></td>
                                    <td><?= $item->port; ?></td>
                                    <td><?= $item->user; ?></td>
                                    <td><?= $item->from; ?></td>
                                    <td><?= $item->to; ?></td>
                                    <td>
                                        <input data-url="<?= base_url("emailsettings/isActiveSetter/$item->id"); ?>"
                                               class="isActive" id="" type="checkbox" data-switchery
                                               data-color="#10c469" <?= ($item->isActive) ? "checked" : ""; ?> />
                                    </td>
                                    <td class="w150">
                                        <button data-url="<?= base_url("emailsettings/delete/$item->id"); ?>"
                                                class="btn btn-sm btn-danger btn-outline remove-btn">
                                            <i class="fa fa-trash"></i> Delete
                                        </button>
                                        <a href="<?= base_url("emailsettings/update_form/$item->id"); ?>"
                                           class="btn btn-sm btn-success btn-outline"> <i
                                                    class="fa fa-pencil-square-o"></i> Update</a>
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