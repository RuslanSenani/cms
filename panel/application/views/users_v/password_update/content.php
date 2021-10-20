<div class="row">
    <div class="col-md-12">
        <h4 class="m-b-lg">
            Update <?= $item->user_name; ?>'s Password
        </h4>
    </div>
    <div class="col-md-12">
        <div class="widget">
            <hr class="widget-separator">
            <div class="widget-body">
                <form action="<?= base_url("users/update_password/$item->id"); ?>" method="POST">
                    <div class="form-group">
                        <label>Password</label>
                        <input class="form-control" placeholder="Password" type="password" name="password">
                        <?php if (isset($form_error)) { ?>
                            <small class=" input-form-error"><?= form_error("password"); ?></small>
                        <?php } ?>
                    </div>
                    <div class="form-group">
                        <label>Password Repeat</label>
                        <input class="form-control" placeholder="Password Repeat" type="password" name="re_password">
                        <?php if (isset($form_error)) { ?>
                            <small class=" input-form-error"><?= form_error("re_password"); ?></small>
                        <?php } ?>
                    </div>
                    <button type="submit" class="btn btn-primary btn-md btn-outline">Save</button>
                    <a href="<?= base_url("users"); ?>" class="btn btn-outline btn-danger">Cancle</a>
                </form>
            </div>
        </div>
    </div>
</div>