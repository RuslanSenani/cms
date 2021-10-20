<div class="row">
    <div class="col-md-12">
        <h4 class="m-b-lg">
            Update <?= $item -> user_name; ?>
        </h4>
    </div>
    <div class="col-md-12">
        <div class="widget">
            <hr class="widget-separator">
            <div class="widget-body">
                <form action="<?= base_url("users/update/$item->id"); ?>" method="POST">
                    <div class="form-group">
                        <label>User Name</label>
                        <input class="form-control" placeholder="User Name" name="user_name"
                               value="<?= isset($form_error) ? set_value("user_name") : $item->user_name; ?>">
                        <?php if (isset($form_error)) { ?>
                            <small class="input-form-error"><?= form_error("user_name"); ?></small>
                        <?php } ?>
                    </div>
                    <div class="form-group">
                        <label>Full Name</label>
                        <input class="form-control" placeholder="Full Name" name="full_name" value="<?= isset($form_error) ?
                            set_value("full_name") : $item->full_name; ?>">
                        <?php if (isset($form_error)) { ?>
                            <small class=" input-form-error"><?= form_error("full_name"); ?></small>
                        <?php } ?>
                    </div>
                    <div class="form-group">
                        <label>E-mail</label>
                        <input class="form-control" type="email" placeholder="E-mail" name="email"
                               value="<?= isset($form_error) ? set_value("email") : $item->email; ?>">
                        <?php if (isset($form_error)) { ?>
                            <small class=" input-form-error"><?= form_error("email"); ?></small>
                        <?php } ?>
                    </div>
                    <button type="submit" class="btn btn-primary btn-md btn-outline">Save</button>
                    <a href="<?= base_url("users"); ?>" class="btn btn-outline btn-danger">Cancle</a>
                </form>
            </div>
        </div>
    </div>
</div>