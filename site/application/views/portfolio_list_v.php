<!DOCTYPE html>
<!--[if IE 9]>
<html lang="az" class="ie9"> <![endif]-->
<!--[if gt IE 9]>
<html lang="az" class="ie"> <![endif]-->
<!--[if !IE]><!-->
<html dir="ltr" lang="az">
<!--<![endif]-->
<head>
    <?php $this->load->view("includes/head"); ?>
</head>
<body class="no-trans front-page transparent-header  page-loader-5">
<!-- scrollToTop -->
<!-- ================ -->
<div class="scrollToTop circle"><i class="icon-up-open-big"></i></div>
<div class="page-wrapper">
    <?php $this->load->view("includes/header"); ?>

    <?php $this->load->view("{$viewFolder}/content"); ?>

    <?php $this->load->view("includes/footer"); ?>
</div>
<?php $this->load->view("includes/include_script"); ?>
</body>
</html>