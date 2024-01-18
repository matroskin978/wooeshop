<?php get_header(); ?>

<?php do_action( 'woocommerce_before_main_content' ); ?>

<?php
$content_class = is_search() ? 'col-12' : 'col-lg-9 col-md-8';
?>

<?php if ( ! is_search() ): ?>
    <div class="col-lg-3 col-md-4">
		<?php do_action( 'woocommerce_sidebar' ); ?>
    </div><!-- ./col-lg-3 col-md-4 -->
<?php endif; ?>

<div class="<?php echo $content_class; ?>">

    <div class="row">
        <div class="col-12">
			<?php if ( apply_filters( 'woocommerce_show_page_title', true ) ) : ?>
                <h1 class="woocommerce-products-header__title page-title section-title h3">
                    <span><?php woocommerce_page_title(); ?></span>
                </h1>
			<?php endif; ?>
			<?php woocommerce_output_all_notices(); ?>
        </div><!-- ./col-12 -->

		<?php if ( $shop_img = wooeshop_get_shop_thumb() ): ?>
            <div class="col-4 col-sm-2">
				<?php echo $shop_img; ?>
            </div>
            <div class="col-8 col-sm-10">
				<?php do_action( 'woocommerce_archive_description' ); ?>
            </div>

            <div class="col-12">
                <hr>
            </div>
		<?php else: ?>
			<?php do_action( 'woocommerce_archive_description' ); ?>
			<?php if ( is_product_category() ): ?>
                <div class="col-12">
                    <hr>
                </div>
			<?php endif; ?>
		<?php endif; ?>

    </div><!-- ./row -->

	<?php
	if ( woocommerce_product_loop() ) { ?>

        <div class="d-flex justify-content-between align-items-center mb-3 wooeshop-ordering">
			<?php do_action( 'woocommerce_before_shop_loop' ); ?>
        </div>


		<?php
		woocommerce_product_loop_start();

		if ( wc_get_loop_prop( 'total' ) ) {
			while ( have_posts() ) {
				the_post();

				do_action( 'woocommerce_shop_loop' );

				wc_get_template_part( 'content', 'product' );
			}
		}

		woocommerce_product_loop_end();

		do_action( 'woocommerce_after_shop_loop' );
	} else {
		do_action( 'woocommerce_no_products_found' );
	}
	?>

</div><!-- ./col-lg-9 col-md-8 -->

<?php do_action( 'woocommerce_after_main_content' ); ?>

<?php get_footer(); ?>
