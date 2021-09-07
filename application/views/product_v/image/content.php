<div class="row">

    <div class="col-md-12">
        <div class="widget">
            <hr class="widget-separator">
            <div class="widget-body">
                <form action="<?= base_url("product/image_upload/$item->id"); ?>" class="dropzone" data-plugin="dropzone" data-options="{ url: '<?= base_url("product/image_upload/$item->id"); ?>'}">
                    <div class="dz-message">
                        <h3 class="m-h-lg">Drop files here or click to upload.</h3>
                        <p class="m-b-lg text-muted">(This is just a demo dropzone. Selected files are not actually uploaded.)</p>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <h4 class="m-b-lg">
            Pictures of the <b><?= $item->title; ?> </b>
        </h4>
    </div>
    <div class="col-md-12">
        <div class="widget">
            <hr class="widget-separator">
            <div class="widget-body">
                <?php if (empty($item_images)) { ?>
                    <div class="alert alert-info text-center">
                        <p>There is no Pictures here</p>
                    </div>
                <?php  } else { ?>
                    <table class="table table-bordered table-striped table-hover pictures_list">
                        <thead>
                            <th>#id</th>
                            <th>İmage</th>
                            <th>Picture Name</th>
                            <th>Status</th>
                            <th>Process</th>
                        </thead>
                        <tbody>
                            <?php foreach ($item_images as $image) { ?>
                                <tr>
                                    <td class="w50 text-center"><?= $image->id ?></td>
                                    <td class="w100 ">
                                        <img width="50" src="<?= base_url("uploads/{$viewFolder}/$image->img_url") ?>" alt="<?= $image->img_url; ?>" class="img-responsive">
                                    </td>
                                    <td><?= $image->img_url ?></td>
                                    <td class="w100 text-center">
                                        <input data-url="<?= base_url("product/isActiveSetter/"); ?>" class="isActive" id="" type="checkbox" data-switchery data-color="#10c469" <?= ($image->isActive) ? "checked" : ""; ?> />
                                    </td>
                                    <td class="w100 text-center">
                                        <button data-url="<?= base_url("product/delete"); ?>" class="btn btn-sm btn-danger btn-block btn-outline remove-btn">
                                            <i class="fa fa-trash"></i> Delete
                                        </button>
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