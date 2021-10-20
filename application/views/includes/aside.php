<?php $user = get_active_user(); ?>
<aside id="menubar" class="menubar light">
    <div class="app-user">
        <div class="media">
            <div class="media-left">
                <div class="avatar avatar-md avatar-circle">
                    <a href="javascript:void(0)"><img class="img-responsive"
                                                      src="<?= base_url("assets"); ?>/assets/images/221.jpg"
                                                      alt="<?= convertToSeo($user->full_name); ?>"/></a>
                </div><!-- .avatar -->
            </div>
            <div class="media-body">
                <div class="foldable">
                    <h5><a href="javascript:void(0)" class="username"><?= $user->full_name; ?></a></h5>
                    <ul>
                        <li class="dropdown">
                            <a href="javascript:void(0)" class="dropdown-toggle usertitle" data-toggle="dropdown"
                               aria-haspopup="true" aria-expanded="false">
                                <small>Process</small>
                                <span class="caret"></span>
                            </a>
                            <ul class="dropdown-menu animated flipInY">
                                <li>
                                    <a class="text-color" href="<?= base_url(); ?>">
                                        <span class="m-r-xs"><i class="fa fa-home"></i></span>
                                        <span>Home</span>
                                    </a>
                                </li>
                                <li>
                                    <a class="text-color" href="<?= base_url("users/update_form/$user->id"); ?>">
                                        <span class="m-r-xs"><i class="fa fa-user"></i></span>
                                        <span>Profile</span>
                                    </a>
                                </li>
                                <li>
                                    <a class="text-color" href="settings.html">
                                        <span class="m-r-xs"><i class="fa fa-gear"></i></span>
                                        <span>Settings</span>
                                    </a>
                                </li>
                                <li role="separator" class="divider"></li>
                                <li>
                                    <a class="text-color" href="<?= base_url("logout"); ?>">
                                        <span class="m-r-xs"><i class="fa fa-power-off"></i></span>
                                        <span>Log Out</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div><!-- .media-body -->
        </div><!-- .media -->
    </div><!-- .app-user -->

    <div class="menubar-scroll">
        <div class="menubar-scroll-inner">
            <ul class="app-menu">
                <li>
                    <a href="<?= base_url(); ?>">
                        <i class="menu-icon zmdi zmdi-view-dashboard zmdi-hc-lg"></i>
                        <span class="menu-text">Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="<?= base_url("settings"); ?>">
                        <i class="menu-icon zmdi zmdi-settings zmdi-hc-lg"></i>
                        <span class="menu-text">Website Setings</span>
                    </a>
                </li>
                <li>
                    <a href="<?= base_url("emailsettings"); ?>">
                        <i class="fa fa-envelope"></i>
                        <span class="menu-text">E-mail Settings</span>
                    </a>
                </li>
                <li>
                    <a href="<?= base_url("galleries"); ?>">
                        <i class="fa fa-image"></i>
                        <span class="menu-text">Gallery Actions</span>
                    </a>
                </li>

                <li>
                    <a href="javascript:void(0)">
                        <i class="fa fa-sliders"></i>
                        <span class="menu-text">Sliders</span>
                    </a>
                </li>
                <li>
                    <a href="<?= base_url("product"); ?>">
                        <i class="menu-icon  fa fa-cubes"></i>
                        <span class="menu-text">Products</span>
                    </a>
                </li>
                <li>
                    <a href="<?= base_url("services"); ?>">
                        <i class="menu-icon  fa fa-cutlery"></i>
                        <span class="menu-text">Services</span>
                    </a>
                </li>


                <li class="has-submenu">
                    <a href="javascript:void(0)" class="submenu-toggle">
                        <i class="menu-icon fa fa-lightbulb-o"></i>
                        <span class="menu-text">Portfolio Actions</span>
                        <i class="menu-caret zmdi zmdi-hc-sm zmdi-chevron-right"></i>
                    </a>
                    <ul class="submenu">
                        <li>
                            <a href="<?= base_url("portfolio_categories"); ?>">
                                <span class="menu-text">Portfolio Categories</span>
                            </a>
                        </li>
                        <li>
                            <a href="<?= base_url("portfolio"); ?>">
                                <span class="menu-text">Portfolios</span>
                            </a>
                        </li>

                    </ul>
                </li>


                <li>
                    <a href="<?= base_url("news"); ?>">
                        <i class="fa fa-newspaper-o" aria-hidden="true"></i>
                        <span class="menu-text">News</span>
                    </a>
                </li>
                <li>
                    <a href="<?= base_url("courses"); ?>">
                        <i class="fa fa-calendar" aria-hidden="true"></i>
                        <span class="menu-text">Courses</span>
                    </a>
                </li>
                <li>
                    <a href="<?= base_url("references"); ?>">
                        <i class="menu-icon zmdi zmdi-check zmdi-hc-lg"></i>
                        <span class="menu-text">References</span>
                    </a>
                </li>
                <li>
                    <a href="<?= base_url("brands"); ?>">
                        <i class="menu-icon zmdi zmdi-puzzle-piece zmdi-hc-lg"></i>
                        <span class="menu-text">Brands</span>
                    </a>
                </li>
                <li>
                    <a href="<?= base_url("users"); ?>">
                        <i class="fa fa-user-secret" aria-hidden="true"></i>
                        <span class="menu-text">Users</span>
                    </a>
                </li>
                <li>
                    <a href="javascript:void(0)">
                        <i class="fa fa-users" aria-hidden="true"></i>
                        <span class="menu-text">Members</span>
                    </a>
                </li>
                <li>
                    <a href="javascript:void(0)">
                        <i class="menu-icon zmdi zmdi-lamp zmdi-hc-lg"></i>
                        <span class="menu-text">Popup</span>
                    </a>
                </li>

                <li class="menu-seperator">
                    <hr>
                </li>

                <li>
                    <a href="javascript:void(0)">
                        <i class="fa fa-home" aria-hidden="true"></i>
                        <span class="menu-text">Home Page</span>
                    </a>
                </li>

            </ul><!-- .app-menu -->
        </div><!-- .menubar-scroll-inner -->
    </div><!-- .menubar-scroll -->
</aside>