<?php if (empty($items)) { ?>
    <div class="alert alert-info text-center">
        <p>There is no Pictures here</p>
    </div>
<?php } else { ?>
    <table class="table table-bordered table-striped table-hover pictures_list">
        <thead>
        <th class="order"><i class="fa fa-reorder"></i></th>
        <th class="w50 text-center">#id</th>
        <th class="w100">İmage</th>
        <th>File Path&Name</th>
        <th>Status</th>
        <th>Process</th>
        </thead>
        <tbody class="sortable" data-url="<?= base_url("galleries/fileRankSetter/$gallery_type"); ?>">
        <?php foreach ($items as $item) { ?>
            <tr id="ord-<?= $item->id; ?>">
                <td class="order"><i class="fa fa-reorder"></i></td>
                <td class="w50 text-center"><?= $item->id ?></td>
                <td class="w50 text-center">
                    <?php if ($gallery_type == "image") { ?>
                        <img src="<?= base_url($item->url); ?>"
                             alt="<?= $item->url; ?>" class="img-responsive">
                    <?php } elseif ($gallery_type == "file") { ?>
                        <i class="fa fa-folder fa-2x"></i>
                    <?php } ?>
                </td>
                <td><?= $item->url ?></td>
                <td class="w100 text-center">
                    <input data-url="<?= base_url("galleries/fileIsActiveSetter/$item->id/$gallery_type"); ?>" class="isActive"
                           id=""
                           type="checkbox"
                           data-switchery data-color="#10c469" <?= ($item->isActive) ? "checked" : ""; ?> />
                </td>
                <td class="w100 text-center">
                    <button data-url="<?= base_url("galleries/fileDelete/$item->id/$item->gallery_id/$gallery_type"); ?>"
                            class="btn btn-sm btn-danger btn-block btn-outline remove-btn">
                        <i class="fa fa-trash"></i> Delete
                    </button>
                </td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
<?php } ?>