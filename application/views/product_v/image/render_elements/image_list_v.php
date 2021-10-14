<?php if (empty($item_images)) { ?>
    <div class="alert alert-info text-center">
        <p>There is no Pictures here</p>
    </div>
<?php } else { ?>
    <table class="table table-bordered table-striped table-hover pictures_list">
        <thead>
        <th class="order"><i class="fa fa-reorder"></i></th>
        <th class="w50 text-center">#id</th>
        <th>İmage</th>
        <th>Picture Name</th>
        <th>Status</th>
        <th>Cover</th>
        <th>Process</th>
        </thead>
        <tbody class="sortable" data-url="<?= base_url("product/imageRankSetter"); ?>">
        <?php foreach ($item_images as $image) { ?>
            <tr id="ord-<?= $image->id; ?>">
                <td class="order"><i class="fa fa-reorder"></i></td>
                <td class="w50 text-center"><?= $image->id ?></td>
                <td class="w100 ">
                    <img style="height: auto; width: 100%;" src="<?= base_url("uploads/{$viewFolder}/$image->img_url") ?>"
                         alt="<?= $image->img_url; ?>" class="img-responsive">
                </td>
                <td><?= $image->img_url ?></td>
                <td class="w100 text-center">
                    <input data-url="<?= base_url("product/imageIsActiveSetter/$image->id"); ?>" class="isActive" id="" type="checkbox"
                           data-switchery data-color="#10c469" <?= ($image->isActive) ? "checked" : ""; ?> />
                </td>
                <td class="w100 text-center">
                    <input data-url="<?= base_url("product/isCoverSetter/$image->id/$image->product_id"); ?>" class="isCover" id=""
                           type="checkbox" data-switchery data-color="#ff5b5b" <?= ($image->isCover) ? "checked" : ""; ?> />
                </td>
                <td class="w100 text-center">
                    <button data-url="<?= base_url("product/imageDelete/$image->id/$image->product_id"); ?>"
                            class="btn btn-sm btn-danger btn-block btn-outline remove-btn">
                        <i class="fa fa-trash"></i> Delete
                    </button>
                </td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
<?php } ?>