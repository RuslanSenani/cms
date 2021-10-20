<div class="simple-page-wrap">
    <div class="simple-page-logo animated swing">
        <a href="<?= base_url("login"); ?>">
            <span><i class="fa fa-gg"></i></span>
            <span>CMS Login</span>
        </a>
    </div><!-- logo -->
    <div class="simple-page-form animated flipInY" id="reset-password-form">
        <h4 class="form-title m-b-xl text-center">Forgot Your Password ?</h4>

        <form action="<?= base_url("reset-password"); ?>" method="post">
            <div class="form-group">
                <input type="email" class="form-control" placeholder="E-mail" name="email"
                       value="<?= isset($form_error) ? set_value("email") : ""; ?>">
                <?php if (isset($form_error)) { ?>
                    <small class=" input-form-error"><?= form_error("email"); ?></small>
                <?php } ?>
            </div>

            <button class="btn btn-primary">RESET YOUR PASSWORD</button>
        </form>
    </div>

</div>
