<div class="main-container">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <!-- banner start -->
                <!-- ================ -->
                <div class="pv-40 banner light-gray-bg">
                    <div class="container clearfix">

                        <!-- slideshow start -->
                        <!-- ================ -->
                        <div class="slideshow">

                            <!-- slider revolution start -->
                            <!-- ================ -->
                            <div class="slider-revolution-5-container">
                                <div id="slider-banner-boxedwidth" class="slider-banner-boxedwidth rev_slider" data-version="5.0">
                                    <ul class="slides">
                                        <!-- slide 1 start -->
                                        <!-- ================ -->
                                        <?php foreach ($portfolio_images as $image): ?>
                                            <li class="text-center" data-transition="slidehorizontal" data-slotamount="default"
                                                data-masterspeed="default" data-title="<?= $portfolio->title; ?>">

                                                <!-- main image -->
                                                <img src="<?= base_url("panel/uploads/portfolio_v/$image->img_url") ?>"
                                                     alt="<?= $portfolio->title; ?>"
                                                     data-bgposition="center top"
                                                     data-bgrepeat="no-repeat" data-bgfit="cover" class="rev-slidebg">

                                                <!-- Transparent Background -->
                                                <div class="tp-caption dark-translucent-bg"
                                                     data-x="center"
                                                     data-y="center"
                                                     data-start="0"
                                                     data-transform_idle="o:1;"
                                                     data-transform_in="o:0;s:600;e:Power2.easeInOut;"
                                                     data-transform_out="o:0;s:600;"
                                                     data-width="5000"
                                                     data-height="450">
                                                </div>


                                            </li>
                                        <?php endforeach; ?>
                                        <!-- slide 1 end -->
                                    </ul>
                                    <div class="tp-bannertimer"></div>
                                </div>
                            </div>
                            <!-- slider revolution end -->

                        </div>
                        <!-- slideshow end -->

                    </div>
                </div>
                <!-- banner end -->

                <!-- main-container start -->
                <!-- ================ -->
                <section class="main-container padding-ver-clear">
                    <div class="container pv-40">
                        <div class="row">

                            <!-- main start -->
                            <!-- ================ -->
                            <div class="main col-md-8">
                                <h1 class="title"><?= $portfolio->title; ?></h1>
                                <div class="separator-2"></div>
                                <p><?= strip_tags($portfolio->description); ?></p>
                            </div>
                            <!-- main end -->
                            <!-- sidebar start -->
                            <!-- ================ -->
                            <aside class="col-lg-4 col-xl-3 ml-xl-auto">
                                <div class="sidebar">
                                    <div class="block clearfix">
                                        <h3 class="title">Portfolio Details</h3>
                                        <div class="separator-2"></div>
                                        <ul class="list margin-clear">
                                            <li><strong>Client: </strong> <span class="text-right"><?= $portfolio->client ?></span></li>
                                            <li><strong>Date: </strong> <span class="text-right"><?= get_readable_date
                                                    ($portfolio->finishedAt);
                                                    ?></span></li>
                                            <li><strong>In: </strong> <span
                                                        class="text-right"><?= get_portfolio_category_title($portfolio->category_id); ?></span>
                                            </li>
                                            <li><strong>Place: </strong> <span class="text-right"><?= $portfolio->place ?></span></li>
                                            <li><strong>URL: </strong> <span class="text-right"><a target="_blank"
                                                                                                   href="<?= $portfolio->portfolio_url; ?>"><?= $portfolio->portfolio_url; ?></a></span>
                                            </li>
                                        </ul>
                                        <a href="<?= $portfolio->portfolio_url; ?>" target="_blank"
                                           class="btn btn-animated btn-default btn-lg">
                                            <i class="fa fa-external-link"></i><?= $portfolio->title; ?></a>
                                        <!--                                        <h3 class="mt-4">Share This</h3>-->
                                        <!--                                        <div class="separator-2"></div>-->
                                        <!--                                        <ul class="social-links colored circle small">-->
                                        <!--                                            <li class="facebook"><a target="_blank" href="http://www.facebook.com"><i-->
                                        <!--                                                            class="fa fa-facebook"></i></a></li>-->
                                        <!--                                            <li class="twitter"><a target="_blank" href="http://www.twitter.com"><i-->
                                        <!--                                                            class="fa fa-twitter"></i></a></li>-->
                                        <!--                                            <li class="googleplus"><a target="_blank" href="http://plus.google.com"><i-->
                                        <!--                                                            class="fa fa-google-plus"></i></a></li>-->
                                        <!--                                            <li class="linkedin"><a target="_blank" href="http://www.linkedin.com"><i-->
                                        <!--                                                            class="fa fa-linkedin"></i></a></li>-->
                                        <!--                                            <li class="xing"><a target="_blank" href="http://www.xing.com"><i-->
                                        <!--                                                            class="fa fa-xing"></i></a></li>-->
                                        <!--                                        </ul>-->
                                    </div>
                                </div>
                            </aside>
                            <!-- sidebar end -->
                        </div>
                    </div>
                </section>
                <!-- main-container end -->


                <!-- section start -->
                <!-- ================ -->
                <section class="section light-gray-bg pv-40 clearfix">
                    <div class="container">
                        <h3>Other <strong>Portfolios</strong></h3>
                        <div class="row grid-space-10">
                            <?php foreach ($other_portfolios as $item): ?>
                                <div class="col-sm-4">
                                    <div class="image-box style-2 mb-20 bordered dark-bg">
                                        <div class="overlay-container overlay-visible">
                                            <?php
                                            $image = get_portfolio_cover_image($item->id);
                                            $image = ($image) ? base_url("panel/uploads/portfolio_v/$image") : base_url("assets/images/portfolio-1.jpg");

                                            ?>
                                            <img src="<?php echo $image; ?>" alt="">
                                            <div class="overlay-bottom text-left">
                                                <p class="lead margin-clear"><?= $item->title ?></p>
                                            </div>
                                        </div>
                                        <div class="body">
                                            <p class="text-muted"><?= character_limiter(strip_tags($item->description), 40); ?></p>
                                            <a href="<?= base_url("portfolio-detail/$item->url"); ?>" class="btn btn-default btn-sm
                                            btn-hvr
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
                <!-- section end -->
            </div>
        </div>
    </div>
</div>
