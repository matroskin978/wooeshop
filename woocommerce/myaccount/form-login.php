<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

$column_class = ( 'yes' === get_option( 'woocommerce_enable_myaccount_registration' ) ) ? 'col-md-6' : 'col-12';

?>

<?php do_action( 'woocommerce_before_main_content' ); ?>

<?php do_action( 'woocommerce_before_customer_login_form' ); ?>

<div class="<?php echo $column_class; ?> mb-3">
    <div class="p-3 bg-white h-100">

        <h5 class="section-title"><span><?php esc_html_e( 'Login', 'woocommerce' ); ?></span></h5>

        <form class="woocommerce-form woocommerce-form-login login" method="post">

			<?php do_action( 'woocommerce_login_form_start' ); ?>

            <div class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide mb-3">
                <label for="username" class="form-label"><?php esc_html_e( 'Username or email address', 'woocommerce' ); ?>&nbsp;<span
                            class="required">*</span></label>
                <input type="text" class="form-control woocommerce-Input woocommerce-Input--text input-text" name="username"
                       id="username" autocomplete="username"
                       value="<?php echo ( ! empty( $_POST['username'] ) ) ? esc_attr( wp_unslash( $_POST['username'] ) ) : ''; ?>"/><?php // @codingStandardsIgnoreLine ?>
            </div>

            <div class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide mb-3">
                <label for="password" class="form-label"><?php esc_html_e( 'Password', 'woocommerce' ); ?>&nbsp;<span
                            class="required">*</span></label>
                <input class="form-control woocommerce-Input woocommerce-Input--text input-text" type="password" name="password"
                       id="password" autocomplete="current-password"/>
            </div>

			<?php do_action( 'woocommerce_login_form' ); ?>

            <div class="form-row mb-3">
                <label class="woocommerce-form__label woocommerce-form__label-for-checkbox woocommerce-form-login__rememberme form-check-label">
                    <input class="form-check-input woocommerce-form__input woocommerce-form__input-checkbox" name="rememberme"
                           type="checkbox" id="rememberme" value="forever"/>
                    <span><?php esc_html_e( 'Remember me', 'woocommerce' ); ?></span>
                </label>
				<?php wp_nonce_field( 'woocommerce-login', 'woocommerce-login-nonce' ); ?>

            </div>

            <button type="submit"
                    class="btn btn-warning woocommerce-button button woocommerce-form-login__submit<?php echo esc_attr( wc_wp_theme_get_element_class_name( 'button' ) ? ' ' . wc_wp_theme_get_element_class_name( 'button' ) : '' ); ?>"
                    name="login"
                    value="<?php esc_attr_e( 'Log in', 'woocommerce' ); ?>"><?php esc_html_e( 'Log in', 'woocommerce' ); ?></button>

            <p class="woocommerce-LostPassword lost_password mt-2">
                <a href="<?php echo esc_url( wp_lostpassword_url() ); ?>"><?php esc_html_e( 'Lost your password?', 'woocommerce' ); ?></a>
            </p>

			<?php do_action( 'woocommerce_login_form_end' ); ?>

        </form>

    </div>
</div>

<?php if ( 'yes' === get_option( 'woocommerce_enable_myaccount_registration' ) ) : ?>
    <div class="col-md-6 mb-3">
        <div class="p-3 bg-white h-100">

            <h5 class="section-title"><span><?php esc_html_e( 'Register', 'woocommerce' ); ?></span></h5>

            <form method="post" class="woocommerce-form woocommerce-form-register register" <?php do_action( 'woocommerce_register_form_tag' ); ?> >

		        <?php do_action( 'woocommerce_register_form_start' ); ?>

		        <?php if ( 'no' === get_option( 'woocommerce_registration_generate_username' ) ) : ?>

                    <div class="mb-3 woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                        <label for="reg_username" class="form-label"><?php esc_html_e( 'Username', 'woocommerce' ); ?>&nbsp;<span class="required">*</span></label>
                        <input type="text" class="form-control woocommerce-Input woocommerce-Input--text input-text" name="username" id="reg_username" autocomplete="username" value="<?php echo ( ! empty( $_POST['username'] ) ) ? esc_attr( wp_unslash( $_POST['username'] ) ) : ''; ?>" /><?php // @codingStandardsIgnoreLine ?>
                    </div>

		        <?php endif; ?>

                <div class="mb-3 woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                    <label for="reg_email" class="form-label"><?php esc_html_e( 'Email address', 'woocommerce' ); ?>&nbsp;<span class="required">*</span></label>
                    <input type="email" class="form-control woocommerce-Input woocommerce-Input--text input-text" name="email" id="reg_email" autocomplete="email" value="<?php echo ( ! empty( $_POST['email'] ) ) ? esc_attr( wp_unslash( $_POST['email'] ) ) : ''; ?>" /><?php // @codingStandardsIgnoreLine ?>
                </div>

		        <?php if ( 'no' === get_option( 'woocommerce_registration_generate_password' ) ) : ?>

                    <div class="mb-3 woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                        <label for="reg_password" class="form-label"><?php esc_html_e( 'Password', 'woocommerce' ); ?>&nbsp;<span class="required">*</span></label>
                        <input type="password" class="form-control woocommerce-Input woocommerce-Input--text input-text" name="password" id="reg_password" autocomplete="new-password" />
                    </div>

		        <?php else : ?>

                    <p><?php esc_html_e( 'A link to set a new password will be sent to your email address.', 'woocommerce' ); ?></p>

		        <?php endif; ?>

		        <?php do_action( 'woocommerce_register_form' ); ?>

                <div class="woocommerce-form-row form-row">
			        <?php wp_nonce_field( 'woocommerce-register', 'woocommerce-register-nonce' ); ?>
                    <button type="submit" class="btn btn-warning woocommerce-Button woocommerce-button button<?php echo esc_attr( wc_wp_theme_get_element_class_name( 'button' ) ? ' ' . wc_wp_theme_get_element_class_name( 'button' ) : '' ); ?> woocommerce-form-register__submit" name="register" value="<?php esc_attr_e( 'Register', 'woocommerce' ); ?>"><?php esc_html_e( 'Register', 'woocommerce' ); ?></button>
                </div>

		        <?php do_action( 'woocommerce_register_form_end' ); ?>

            </form>

        </div>
    </div>
<?php endif; ?>

<?php do_action( 'woocommerce_after_customer_login_form' ); ?>

<?php do_action( 'woocommerce_after_main_content' ); ?>
