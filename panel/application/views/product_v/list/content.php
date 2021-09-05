<div class="row">
    <div class="col-md-12">
        <h4 class="m-b-lg">
            Product List
            <a href="<?= base_url("product/new_form"); ?>" class="btn btn-outline btn-primary btn-xs pull-right"> <i class="fa fa-plus"></i> Add New </a>
        </h4>
    </div>
    <div class="col-md-12">
        <div class="widget">
            <header class="widget-header">
            </header>
            <hr class="widget-separator">
            <div class="widget-body">
                <div class="table-responsive">

                    <?php if (empty($items)) { ?>
                        <div class="alert alert-info text-center">
                            <p>There is no data available here. Click please <a href="<?= base_url("product/new_form"); ?>">Add</a></p>
                        </div>
                    <?php  } else { ?>

                        <table id="default-datatable" data-plugin="DataTable" class="table table-hover" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>#id</th>
                                    <th>Url</th>
                                    <th>Title</th>
                                    <th>Description</th>
                                    <th>Status</th>
                                    <th>Progress</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php foreach ($items as $item) { ?>
                                    <tr>
                                        <td><?= $item->id; ?></td>
                                        <td><a href="<?= $item->url; ?>">asdas</a></td>
                                        <td><?= $item->title; ?></td>
                                        <td><?= $item->description; ?></td>
                                        <td>
                                            <input id="" type="checkbox" data-switchery data-color="#10c469" <?= ($item->isActive) ? "checked" : ""; ?> />
                                        </td>
                                        <td>
                                            <a href="#" class="btn btn-sm btn-danger btn-outline"> <i class="fa fa-trash"></i> Delete</a>
                                            <a href="<?= base_url("product/update_form/$item->id"); ?>" class="btn btn-sm btn-success btn-outline"> <i class="fa fa-pencil-square-o"></i> Update</a>
                                        </td>
                                    </tr>
                                <?php   } ?>

                            </tbody>
                        </table>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>