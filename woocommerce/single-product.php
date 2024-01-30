<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
get_header(); ?>

	<?php
		do_action( 'woocommerce_before_main_content' );
	?>

		<?php while ( have_posts() ) : ?>
			<?php the_post(); ?>

			<?php wc_get_template_part( 'content', 'single-product' ); ?>

		<?php endwhile; ?>

	<?php
		do_action( 'woocommerce_after_main_content' );
	?>

<?php
get_footer();

