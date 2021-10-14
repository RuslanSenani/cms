<div class="row">
    <div class="col-md-12">
        <h4 class="m-b-lg">
            Users List will be From DB
            <a href="<?= base_url("users/new_form"); ?>" class="btn btn-outline btn-primary btn-xs pull-right"> <i
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
                                        href="<?= base_url("users/new_form"); ?>">Add</a></p>
                        </div>
                    <?php } else { ?>

                        <table class="table table-hover table-bordered content_container">
                            <thead>
                            <tr>
                                <th class="w50 text-center">#id</th>
                                <th>User Name</th>
                                <th>Full Name</th>
                                <th>E-mail</th>
                                <th>Status</th>
                                <th>Process</th>
                            </tr>
                            </thead>

                            <tbody>
                            <?php foreach ($items as $item) { ?>
                                <tr>
                                    <td class="w50 text-center"><?= $item->id; ?></td>
                                    <td><?= $item->user_name; ?></td>
                                    <td><?= $item->full_name; ?></td>
                                    <td class="text-center"><?= $item->email; ?></td>
                                    <td class="text-center">
                                        <input data-url="<?= base_url("users/isActiveSetter/$item->id"); ?>"
                                               class="isActive" id="" type="checkbox" data-switchery
                                               data-color="#10c469" <?= ($item->isActive) ? "checked" : ""; ?> />
                                    </td>
                                    <td class="text-center">
                                        <button data-url="<?= base_url("users/delete/$item->id"); ?>"
                                                class="btn btn-sm btn-danger btn-outline remove-btn">
                                            <i class="fa fa-trash"></i> Delete
                                        </button>
                                        <a href="<?= base_url("users/update_form/$item->id"); ?>"
                                           class="btn btn-sm btn-success btn-outline"> <i
                                                    class="fa fa-pencil-square-o"></i> Update</a>
                                        <a href="<?= base_url("users/update_password_form/$item->id"); ?>"
                                           class="btn btn-sm btn-purple btn-outline"> <i
                                                    class="fa fa-key"></i> Update Password</a>

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