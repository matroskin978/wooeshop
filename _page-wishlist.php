<?php /* Template Name: Страница избранного */ ?>
<?php get_header() ?>

<main class="main">

    <div class="container">
        <div class="row">
            <div class="col-12">
                <nav class="breadcrumbs">
                    <ul>
                        <li><a href="<?php echo home_url( '/' ) ?>"><?php _e( 'Home', 'wooeshop' ) ?></a></li>
                        <li><?php _e( 'Wishlist', 'wooeshop' ) ?></li>
                    </ul>
                </nav>
            </div>

            <div class="col-12">
                <h1 class="section-title h3 mb-3"><span><?php the_title() ?></span></h1>

				<?php if ( is_user_logged_in() ): ?>
					<?php if ( defined( "WISHLIST" ) ): ?>
						<?php $wishlist = implode( ',', WISHLIST ); ?>
						<?php if ( ! $wishlist ): ?>
                            <p><?php _e( 'Wishlist is empty', 'wooeshop' ); ?></p>
						<?php else: ?>
							<?php echo do_shortcode( "[products ids='$wishlist' limit=8]" ) ?>
						<?php endif; ?>
					<?php endif; ?>
				<?php else: ?>
                    <p>Необходима авторизация</p>
				<?php endif; ?>

            </div>
        </div>
    </div>

</main>

<?php get_footer() ?>
