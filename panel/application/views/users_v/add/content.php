<div class="row">
    <div class="col-md-12">
        <h4 class="m-b-lg">
            Add New Users
        </h4>
    </div>
    <div class="col-md-12">
        <div class="widget">
            <hr class="widget-separator">
            <div class="widget-body">
                <form action="<?= base_url("users/insert"); ?>" method="POST">
                    <div class="form-group">
                        <label>User Name</label>
                        <input class="form-control" placeholder="User Name" name="user_name"
                               value="<?= isset($form_error) ? set_value("user_name") : ""; ?>">
                        <?php if (isset($form_error)) { ?>
                            <small class="input-form-error"><?= form_error("user_name"); ?></small>
                        <?php } ?>
                    </div>
                    <div class="form-group">
                        <label>Full Name</label>
                        <input class="form-control" placeholder="Full Name" name="full_name" value="<?= isset($form_error) ?
                            set_value("full_name") : ""; ?>">
                        <?php if (isset($form_error)) { ?>
                            <small class=" input-form-error"><?= form_error("full_name"); ?></small>
                        <?php } ?>
                    </div>
                    <div class="form-group">
                        <label>E-mail</label>
                        <input class="form-control" type="email" placeholder="E-mail" name="email"
                               value="<?= isset($form_error) ? set_value("email") : ""; ?>">
                        <?php if (isset($form_error)) { ?>
                            <small class=" input-form-error"><?= form_error("email"); ?></small>
                        <?php } ?>
                    </div>
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