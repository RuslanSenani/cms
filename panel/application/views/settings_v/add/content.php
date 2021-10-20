<div class="row">
    <div class="col-md-12">
        <h4 class="m-b-lg">
            Add Site Settings
        </h4>
    </div>


    <div class="col-md-12">
        <form action="<?= base_url("settings/insert"); ?>" method="POST" enctype="multipart/form-data">
            <div class="widget">
                <div class="m-b-lg nav-tabs-horizontal">


                    <ul class="nav nav-tabs" role="tablist">
                        <li role="presentation" class="active"><a href="#tab-1" aria-controls="tab-3" role="tab" data-toggle="tab"> Site
                                Information </a></li>
                        <li role="presentation"><a href="#tab-6" aria-controls="tab-5" role="tab" data-toggle="tab"> Address </a></li>
                        <li role="presentation"><a href="#tab-2" aria-controls="tab-1" role="tab" data-toggle="tab"> About Us </a></li>
                        <li role="presentation"><a href="#tab-3" aria-controls="tab-2" role="tab" data-toggle="tab"> Mission </a></li>
                        <li role="presentation"><a href="#tab-4" aria-controls="tab-3" role="tab" data-toggle="tab"> Vision </a></li>
                        <li role="presentation"><a href="#tab-5" aria-controls="tab-4" role="tab" data-toggle="tab"> Social Media </a>
                        </li>
                        <li role="presentation"><a href="#tab-7" aria-controls="tab-6" role="tab" data-toggle="tab"> Logo </a></li>
                    </ul>
                    <div class="tab-content p-md">
                        <div role="tabpanel" class="tab-pane in active fade" id="tab-1">
                            <div class="row">
                                <div class="form-group col-md-12">
                                    <label>Company Name</label>
                                    <input class="form-control" placeholder="Company Name" name="company_name"
                                           value="<?= isset($form_error) ? set_value("company_name") : ""; ?>">
                                    <?php if (isset($form_error)) { ?>
                                        <small class="input-form-error"><?= form_error("company_name"); ?></small>
                                    <?php } ?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label>Phone 1</label>
                                    <input class="form-control" placeholder="Phone 1" name="phone_1"
                                           value="<?= isset($form_error) ? set_value("phone_1") : ""; ?>">
                                    <?php if (isset($form_error)) { ?>
                                        <small class="input-form-error"><?= form_error("phone_1"); ?></small>
                                    <?php } ?>
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Fax 1</label>
                                    <input class="form-control" placeholder="Fax 1" name="fax_1">

                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label>Phone 2</label>
                                    <input class="form-control" placeholder="Phone 2 (Optional)" name="phone_2">

                                </div>
                                <div class="form-group col-md-6">
                                    <label>Fax 2</label>
                                    <input class="form-control" placeholder="Fax 2 (Optional)" name="fax_2">

                                </div>
                            </div>
                        </div>
                        <div role="tabpanel" class="tab-pane fade" id="tab-6">
                            <div class="row">
                                <div class="form-group col-md-12">
                                    <label>Address</label>
                                    <textarea name="address" class="m-0" data-plugin="summernote" data-options="{height: 250}">
                                    </textarea>
                                </div>

                            </div>
                        </div>
                        <div role="tabpanel" class="tab-pane fade" id="tab-2">
                            <div class="row">
                                <div class="form-group col-md-12">
                                    <label>About Us</label>
                                    <textarea name="about_us" class="m-0" data-plugin="summernote" data-options="{height: 250}">
                                    </textarea>
                                </div>

                            </div>
                        </div>
                        <div role="tabpanel" class="tab-pane fade" id="tab-3">
                            <div class="row">
                                <div class="form-group col-md-12">
                                    <label>Mission</label>
                                    <textarea name="mission" class="m-0" data-plugin="summernote" data-options="{height: 250}">
                                    </textarea>
                                </div>
                            </div>
                        </div>
                        <div role="tabpanel" class="tab-pane fade" id="tab-4">
                            <div class="row">
                                <div class="form-group col-md-12">
                                    <label>Vision</label>
                                    <textarea name="vision" class="m-0" data-plugin="summernote" data-options="{height: 250}">
                                    </textarea>
                                </div>
                            </div>
                        </div>
                        <div role="tabpanel" class="tab-pane fade" id="tab-5">
                            <div class="row">
                                <div class="form-group col-md-12">
                                    <label>Email</label>
                                    <input class="form-control" placeholder="Email" name="email"
                                           value="<?= isset($form_error) ? set_value("email") : ""; ?>">
                                    <?php if (isset($form_error)) { ?>
                                        <small class="input-form-error"><?= form_error("email"); ?></small>
                                    <?php } ?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label>Facebook</label>
                                    <input class="form-control" placeholder="Facebook" name="facebook">
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Twitter</label>
                                    <input class="form-control" placeholder="Twitter" name="twitter">

                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label>Instagram</label>
                                    <input class="form-control" placeholder="Instagram" name="instagram">

                                </div>
                                <div class="form-group col-md-6">
                                    <label>Linkedin</label>
                                    <input class="form-control" placeholder="Linkedin" name="linkedin">

                                </div>
                            </div>
                        </div>
                        <div role="tabpanel" class="tab-pane fade" id="tab-7">
                            <div class="row">
                                <div class="form-group col-md-4">
                                    <label>Choose Image</label>
                                    <input type="file" name="logo" class="form-control col-md-4">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="widget">
                <div class="widget-body">
                    <button type="submit" class="btn btn-primary btn-md">Save</button>
                    <a href="<?= base_url("settings"); ?>" class="btn btn-danger">Cancle</a>
                </div>
            </div>
        </form>
    </div>
</div>