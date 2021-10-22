<section class="main-container">
    <div class="container">
        <div class="row">
            <!-- main start -->
            <!-- ================ -->
            <div class="main col-md-12">
                <h1 class="page-title">Portfolio List</h1>
                <div class="separator-2"></div>

                <?php foreach ($portfolios as $item): ?>
                    <div class="image-box style-3-b">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="overlay-container">
                                    <?php
                                    $image = get_portfolio_cover_image($item->id);
                                    $image = ($image) ? base_url("panel/uploads/portfolio_v/$image") : base_url("assets/images/portfolio-1.jpg");
                                    ?>
                                    <img src="<?= $image ?>" alt="<?= $item->title; ?>">
                                    <div class="overlay-to-top">
                                        <p class="small margin-clear"><em><?= $item->title; ?></em></p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="body">
                                    <h3 class="title"><a href="<?= base_url("portfolio-detail/$item->url"); ?>"><?= $item->title; ?></a>
                                    </h3>
                                    <p class="small mb-10"><i class="icon-calendar"></i>
                                        <?= get_readable_date($item->finishedAt); ?>
                                        <i class="pl-10 icon-tag-1"></i>
                                        <?php $portfolio_category = get_portfolio_category_title($item->category_id); ?>
                                        <?php if ($portfolio_category) { ?>
                                            <?= $portfolio_category ?>
                                        <?php } ?>
                                    </p>
                                    <div class="separator-2"></div>
                                    <p class="mb-10"><?= character_limiter(strip_tags($item->description), 800); ?></p>
                                    <a href="<?= base_url("portfolio-detail/$item->url"); ?>"
                                       class="btn btn-default btn-sm btn-hvr hvr-shutter-out-horizontal margin-clear">Read More<i
                                                class="fa fa-arrow-right pl-10"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
            <!-- main end -->
        </div>
    </div>
</section>
