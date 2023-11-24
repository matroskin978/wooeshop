<?php get_header(); ?>

<?php do_action( 'woocommerce_before_main_content' ); ?>

<div class="container">
	<div class="row">
		<div class="col-lg-3 col-md-4">
			<?php do_action( 'woocommerce_sidebar' ); ?>
		</div><!-- ./col-lg-3 col-md-4 -->

		<div class="col-lg-9 col-md-8">
			Content
		</div><!-- ./col-lg-9 col-md-8 -->

	</div><!-- ./row -->
</div><!-- ./container -->

<?php do_action( 'woocommerce_after_main_content' ); ?>

<?php get_footer(); ?>
