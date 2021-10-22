<section class="main-container">
    <div class="container">
        <div class="row">
            <h1 class="page-title">Product List</h1>
            <div class="separator-2"></div>
            <?php foreach ($products as $item): ?>
                <div class="col-sm-4">
                    <div class="image-box style-2 mb-20 bordered dark-bg">
                        <div class="overlay-container overlay-visible">
                            <?php
                            $image = get_product_cover_image($item->id);
                            $image = ($image) ? base_url("panel/uploads/product_v/$image") : base_url("assets/images/portfolio-1.jpg");

                            ?>
                            <img src="<?php echo $image; ?>" alt="<?= $item->title; ?>">
                            <div class="overlay-bottom text-left">
                                <p class="lead margin-clear"><?= $item->title ?></p>
                            </div>
                        </div>
                        <div class="body">
                            <p class="text-muted"><?= character_limiter(strip_tags($item->description), 30); ?></p>
                            <a href="<?= base_url("product-detail/$item->url"); ?>" class="btn btn-default btn-sm btn-hvr
                            hvr-sweep-to-right
                            margin-clear">Read More<i
                                        class="fa fa-arrow-right pl-10"></i></a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
