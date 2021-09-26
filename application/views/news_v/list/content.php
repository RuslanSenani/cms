<div class="row">
    <div class="col-md-12">
        <h4 class="m-b-lg">
            News List will be From DB
            <a href="<?= base_url("news/new_form"); ?>" class="btn btn-outline btn-primary btn-xs pull-right"> <i class="fa fa-plus"></i> Add New </a>
        </h4>
    </div>
    <div class="col-md-12">
        <div class="widget">
            <header class="widget-header">
            </header>
            <hr class="widget-separator">
            <div class="widget-body">
                <div class="widget p-lg">

                    <?php if (empty($items)) { ?>
                        <div class="alert alert-info text-center">
                            <p>There is no data available here. Click please <a href="<?= base_url("news/new_form"); ?>">Add</a></p>
                        </div>
                    <?php  } else { ?>

                        <table class="table table-hover table-bordered content_container">
                            <thead>
                                <tr>
                                    <th class="order "><i class="fa fa-reorder"></i></th>
                                    <th class="w50 text-center">#id</th>
                                    <th>Title</th>
                                    <th>Url</th>
                                    <th>Description</th>
                                    <th>News Type</th>
                                    <th>Image</th>
                                    <th>Status</th>
                                    <th>Process</th>
                                </tr>
                            </thead>

                            <tbody class="sortable" data-url="<?= base_url("news/rankSetter"); ?>">
                                <?php foreach ($items as $item) { ?>
                                    <tr id="ord-<?= $item->id; ?>">
                                        <td class="order"><i class="fa fa-reorder alias"></i></td>
                                        <td class="w50 text-center"><?= $item->id; ?></td>
                                        <td><?= $item->title; ?></td>
                                        <td><a href="<?= $item->url; ?>"><?= $item->url; ?></a></td>
                                        <td><?= $item->description; ?></td>

                                        <td><?= $item->news_type; ?></td>
                                        <td class="text-center">
                                            <?php if ($item->news_type == "image") { ?>
                                                <img width="150" src="<?= base_url("uploads/{$viewFolder}/$item->img_url") ?>" alt="<?= $item->img_url; ?>" class="img-rounded">

                                            <?php } elseif ($item->news_type == "video") { ?>
                                                <iframe
                                                width="150"
                                                src="<?=$item->video_url;?>"
                                                title="YouTube video player"
                                                frameborder="0"
                                                allow="encrypted-media"
                                                allowfullscreen>
                                            </iframe>
                                            <?php } ?>
                                        </td>
                                        <td>
                                            <input data-url="<?= base_url("news/isActiveSetter/$item->id"); ?>" class="isActive" id="" type="checkbox" data-switchery data-color="#10c469" <?= ($item->isActive) ? "checked" : ""; ?> />
                                        </td>
                                        <td>
                                            <button data-url="<?= base_url("news/delete/$item->id"); ?>" class="btn btn-sm btn-danger btn-outline remove-btn">
                                                <i class="fa fa-trash"></i> Delete
                                            </button>
                                            <a href="<?= base_url("news/update_form/$item->id"); ?>" class="btn btn-sm btn-success btn-outline"> <i class="fa fa-pencil-square-o"></i> Update</a>
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