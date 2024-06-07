<?php

defined( 'ABSPATH' ) || exit;
?>

<?php do_action( 'woocommerce_before_main_content' ); ?>

<div class="col-12 mb-3">
    <div class="p-3 bg-white h-100">
        <div class="row">

            <div class="col-lg-3 col-md-4">
	            <?php do_action( 'woocommerce_account_navigation' ); ?>
            </div>

            <div class="col-lg-9 col-md-8">
                <div class="woocommerce-MyAccount-content">
		            <?php do_action( 'woocommerce_account_content' ); ?>
                </div>
            </div>

        </div>
    </div>
</div>

<?php do_action( 'woocommerce_after_main_content' ); ?>


