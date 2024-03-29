<!DOCTYPE html>
<html lang="en">

<head>
	<!-- STYLE -->
	<?php $this->load->view("includes/head"); ?>
	<?php $this->load->view("includes/include_style"); ?>
	<!-- /#style -->
</head>

<body class="menubar-left menubar-unfold menubar-light theme-primary">
	<!--============= start main area -->

	<!-- APP NAVBAR ==========-->
	<?php $this->load->view("includes/navbar"); ?>
	<!--========== END app navbar -->

	<!-- APP ASIDE ==========-->
	<?php $this->load->view("includes/aside"); ?>
	<!--========== END app aside -->

	<!-- navbar search -->
	<?php $this->load->view("includes/navbar-search"); ?>
	<!-- .navbar-search -->

	<!-- APP MAIN ==========-->
	<main id="app-main" class="app-main">

		<div class="wrap">
			<section class="app-content">
				<?php $this->load->view("{$viewFolder}/{$subViewFolder}/content"); ?>
			</section><!-- #dash-content -->
		</div><!-- .wrap -->

		<!-- APP FOOTER -->
		<?php $this->load->view("includes/footer"); ?>
		<!-- /#app-footer -->
	</main>
	<!--========== END app main -->

	<!-- SCRIPT -->
	<?php $this->load->view("includes/include_script"); ?>
	<!-- /#scripts -->
</body>

</html>