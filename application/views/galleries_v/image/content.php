<div class="row">

    <div class="col-md-12">
        <div class="widget">
            <hr class="widget-separator">
            <div class="widget-body">
                <form data-url="<?= base_url("galleries/refresh_file_list/$item->id/$item->gallery_type"); ?>"
                      action="<?= base_url("galleries/file_upload/$item->id/$item->gallery_type/$item->folder_name");
                      ?>" id="dropzone" class="dropzone" data-plugin="dropzone"
                      data-options="{ url: '<?= base_url("galleries/file_upload/$item->id/$item->gallery_type/$item->folder_name");
                      ?>'}">
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
            Files of the <b><?= $item->title; ?> </b>
        </h4>
    </div>
    <div class="col-md-12">
        <div class="widget">
            <hr class="widget-separator">
            <div class="widget-body image_list_container">
                <?php $this->load->view("{$viewFolder}/{$subViewFolder}/render_elements/file_list_v"); ?>
            </div>
        </div>
    </div>
</div>