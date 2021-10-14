<div class="row">
    <div class="col-md-12">
        <h4 class="m-b-lg">
            Gallery List will be From DB
            <a href="<?= base_url("galleries/new_form"); ?>" class="btn btn-outline btn-primary btn-xs pull-right"> <i
                        class="fa fa-plus"></i> Add New </a>
        </h4>
    </div>
    <div class="col-md-12">
        <div class="widget">
            <div class="widget-body">

                <?php if (empty($items)) { ?>
                    <div class="alert alert-info text-center">
                        <p>There is no data available here. Click please <a
                                    href="<?= base_url("galleries/new_form"); ?>">Add</a>
                        </p>
                    </div>
                <?php } else { ?>

                    <table class="table table-hover table-bordered content_container">
                        <thead>
                        <tr>
                            <th class="order "><i class="fa fa-reorder"></i></th>
                            <th class="w50 text-center">#id</th>
                            <th>Gallery Name</th>
                            <th>Gallery Type</th>
                            <th>Folder Name</th>
                            <th>Url</th>
                            <th>Status</th>
                            <th>Process</th>
                        </tr>
                        </thead>

                        <tbody class="sortable" data-url="<?= base_url("galleries/rankSetter"); ?>">
                        <?php foreach ($items as $item) { ?>
                            <tr id="ord-<?= $item->id; ?>">
                                <td class="order"><i class="fa fa-reorder alias"></i></td>
                                <td class="w50 text-center"><?= $item->id; ?></td>
                                <td><?= $item->title; ?></td>
                                <td><?= $item->gallery_type; ?></td>
                                <td><?= $item->folder_name; ?></td>
                                <td><?= $item->url; ?></td>
                                <td class="text-center">
                                    <input data-url="<?= base_url("galleries/isActiveSetter/$item->id"); ?>"
                                           class="isActive" id="" type="checkbox" data-switchery
                                           data-color="#10c469" <?= ($item->isActive) ? "checked" : ""; ?>
                                    />
                                </td>
                                <td class="text-center">
                                    <button data-url="<?= base_url("galleries/delete/$item->id"); ?>"
                                            class="btn btn-sm btn-danger btn-outline remove-btn">
                                        <i class="fa fa-trash"></i> Delete
                                    </button>
                                    <?php
                                    if ($item->gallery_type == "image") {
                                        $button_image = "fa-image";
                                        $button_url = "galleries/uploads_form/$item->id";
                                    } elseif ($item->gallery_type == "file") {
                                        $button_image = "fa-folder";
                                        $button_url = "galleries/uploads_form/$item->id";
                                    } else {
                                        $button_image = "fa-play-circle-o";
                                        $button_url = "galleries/gallery_video_list/$item->id";
                                    }
                                    ?>
                                    <a href="<?= base_url("galleries/update_form/$item->id"); ?>"
                                       class="btn btn-sm btn-success btn-outline">
                                        <i class="fa fa-pencil-square-o"></i>
                                        Update
                                    </a>

                                    <a href="<?= base_url($button_url); ?>" class="btn btn-sm btn-purple btn-outline">
                                        <i class="fa  <?= $button_image ?>"></i>
                                        Show Galleries
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