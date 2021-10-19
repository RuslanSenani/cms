<div class="row">
    <div class="col-md-12">
        <h4 class="m-b-lg">
            Update <?= $item->user_name; ?>
        </h4>
    </div>
    <div class="col-md-12">
        <div class="widget">
            <hr class="widget-separator">
            <div class="widget-body">
                <form action="<?= base_url("emailsettings/update/$item->id"); ?>" method="POST">
                    <div class="form-group">
                        <label>Protocol</label>
                        <input class="form-control" placeholder="Protocol" name="protocol"
                               value="<?= isset($form_error) ? set_value("protocol") : $item->protocol; ?>">
                        <?php if (isset($form_error)) { ?>
                            <small class="input-form-error"><?= form_error("protocol"); ?></small>
                        <?php } ?>
                    </div>
                    <div class="form-group">
                        <label>Host</label>
                        <input class="form-control" placeholder="Host" name="host" value="<?= isset($form_error) ?
                            set_value("host") : $item->host; ?>">
                        <?php if (isset($form_error)) { ?>
                            <small class=" input-form-error"><?= form_error("host"); ?></small>
                        <?php } ?>
                    </div>
                    <div class="form-group">
                        <label>Port</label>
                        <input class="form-control" placeholder="Port" name="port"
                               value="<?= isset($form_error) ? set_value("port") : $item->port; ?>">
                        <?php if (isset($form_error)) { ?>
                            <small class=" input-form-error"><?= form_error("port"); ?></small>
                        <?php } ?>
                    </div>

                    <div class="form-group">
                        <label>E-mail (User)</label>
                        <input class="form-control" type="email" placeholder="E-mail (User)" name="user"
                               value="<?= isset($form_error) ? set_value("user") : $item->user; ?>">
                        <?php if (isset($form_error)) { ?>
                            <small class=" input-form-error"><?= form_error("user"); ?></small>
                        <?php } ?>
                    </div>
                    <div class="form-group">
                        <label>E-mail Password</label>
                        <input class="form-control" placeholder="E-mail Password" type="password" name="password"
                               value="<?= isset($form_error) ? set_value("password") : $item->password; ?>">
                        <?php if (isset($form_error)) { ?>
                            <small class=" input-form-error"><?= form_error("password"); ?></small>
                        <?php } ?>
                    </div>
                    <div class="form-group">
                        <label>From</label>
                        <input class="form-control" type="email" placeholder="From" name="from"
                               value="<?= isset($form_error) ? set_value("from") : $item->from; ?>">
                        <?php if (isset($form_error)) { ?>
                            <small class=" input-form-error"><?= form_error("from"); ?></small>
                        <?php } ?>
                    </div>
                    <div class="form-group">
                        <label>To</label>
                        <input class="form-control" type="email" placeholder="To" name="to"
                               value="<?= isset($form_error) ? set_value("to") : $item->to; ?>">
                        <?php if (isset($form_error)) { ?>
                            <small class=" input-form-error"><?= form_error("to"); ?></small>
                        <?php } ?>
                    </div>

                    <div class="form-group">
                        <label>E-mail Title</label>
                        <input class="form-control" placeholder="E-mail Title" name="user_name"
                               value="<?= isset($form_error) ? set_value("user_name") : $item->user_name; ?>">
                        <?php if (isset($form_error)) { ?>
                            <small class=" input-form-error"><?= form_error("user_name"); ?></small>
                        <?php } ?>
                    </div>
                    <button type="submit" class="btn btn-primary btn-md btn-outline">Save</button>
                    <a href="<?= base_url("emailsettings"); ?>" class="btn btn-outline btn-danger">Cancle</a>
                </form>
            </div>
        </div>
    </div>
</div>