<div class="simple-page-wrap">
    <div class="simple-page-logo animated swing">
        <span style="color:white"><i class="fa fa-gg"></i></span>
        <span style="color:white">CMS</span>
    </div><!-- logo -->
    <div class="simple-page-form animated flipInY" id="login-form">
        <h4 class="form-title m-b-xl text-center">Sign In With Your CMS Account</h4>
        <form action="<?= base_url("dologin"); ?>" method="post">
            <div class="form-group">
                <input id="sign-in-email" type="email" class="form-control" placeholder="Email" name="user_email">
                <?php if (isset($form_error)) { ?>
                    <small class=" input-form-error"><?= form_error("user_email"); ?></small>
                <?php } ?>
            </div>

            <div class="form-group">
                <input id="sign-in-password" type="password" class="form-control" placeholder="Password" name="user_password">
                <?php if (isset($form_error)) { ?>
                    <small class=" input-form-error"><?= form_error("user_password"); ?></small>
                <?php } ?>
            </div>

            <div class="form-group m-b-xl">
                <div class="checkbox checkbox-primary">
                    <input type="checkbox" id="keep_me_logged_in"/>
                    <label for="keep_me_logged_in">Keep me signed in</label>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">SING IN</button>
        </form>
    </div>

    <div class="simple-page-footer">
        <p><a href="<?= base_url("forget-password"); ?>">FORGOT YOUR PASSWORD ?</a></p>

    </div>


</div>