<?php

// https://woocommerce.com/document/woocommerce-theme-developer-handbook/#section-5
add_action( 'after_setup_theme', function () {
	add_theme_support( 'woocommerce' );
} );
