<?php

// https://woocommerce.com/document/woocommerce-theme-developer-handbook/#section-5
add_action( 'after_setup_theme', function () {
	add_theme_support( 'woocommerce' );
	add_theme_support( 'wc-product-gallery-zoom' );
	add_theme_support( 'wc-product-gallery-lightbox' );
	add_theme_support( 'wc-product-gallery-slider' );

	add_theme_support( 'title-tag' );
} );

// change content wrapper
remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10 );
add_action( 'woocommerce_before_main_content', function () {
	echo '<div class="content-area test-container2">';
}, 10 );
add_action( 'woocommerce_after_main_content', function () {
	echo '</div>';
}, 10 );

remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20 );
add_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 9 );
add_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 11 );
add_action( 'woocommerce_before_shop_loop', 'woocommerce_breadcrumb', 11 );
add_action( 'woocommerce_after_main_content', 'woocommerce_breadcrumb', 11 );
add_action( 'woocommerce_after_main_content', 'woocommerce_breadcrumb', 5 );
