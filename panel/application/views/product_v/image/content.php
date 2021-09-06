<div class="row">
    <div class="col-md-12">
        <h4 class="m-b-lg">
            Add Product Pictures
        </h4>
    </div>
    <div class="col-md-12">
        <div class="widget">
            <hr class="widget-separator">
            <div class="widget-body">
                <form action="../api/dropzone" class="dropzone" data-plugin="dropzone" data-options="{ url: '../api/dropzone'}">
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
            Pictures
        </h4>
    </div>
    <div class="col-md-12">
        <div class="widget">
            <hr class="widget-separator">
            <div class="widget-body">
                <table class="table table-bordered table-striped table-hover">
                    <thead>
                        <tr>
                            <th>#id</th>
                            <th>İmage</th>
                            <th>Picture Name</th>
                            <th>Status</th>
                            <th>Process</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>
                                <img width="50" src="https://media.wired.com/photos/598e35fb99d76447c4eb1f28/master/pass/phonepicutres-TA.jpg" alt="" class="img-responsive">
                            </td>
                            <td>Ruslan</td>
                            <td>
                                <input data-url="<?= base_url("product/isActiveSetter/"); ?>" class="isActive" id="" type="checkbox" data-switchery data-color="#10c469" <?= (true) ? "checked" : ""; ?> />
                            </td>
                            <td>
                                <button data-url="<?= base_url("product/delete"); ?>" class="btn btn-sm btn-danger btn-outline remove-btn">
                                    <i class="fa fa-trash"></i> Delete
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>