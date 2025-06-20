<?php
/**
 * Lost password form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/form-lost-password.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 9.2.0
 */

defined( 'ABSPATH' ) || exit;

do_action( 'woocommerce_before_lost_password_form' );
?>

<!-- Breadcumb -->
<div class="breadcumb-area bg-image text-center" style="background-image: url('<?php echo get_template_directory_uri();?>/assets/images/breadcumb/breadcumb.jpg');">
	<div class="container">
		<div class="row">
			<div class="co-lg-12">
				<div class="banner-content">
					<h1 class="title">Lost Password</h1>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- /Breadcumb -->

<div class="register-area section-gap bg-light-1">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="registration-wrapper-1">
                    <form method="post" class="registration-form">

	<p><?php echo apply_filters( 'woocommerce_lost_password_message', esc_html__( 'Lost your password? Please enter your username or email address. You will receive a link to create a new password via email.', 'woocommerce' ) ); ?></p><?php // @codingStandardsIgnoreLine ?>

    <div class="input-wrapper">
        <label for="user_login"><?php esc_html_e( 'Username or email', 'woocommerce' ); ?>&nbsp;<span class="required" aria-hidden="true">*</span><span class="screen-reader-text"><?php esc_html_e( 'Required', 'woocommerce' ); ?></span></label>
        <input type="text" name="user_login" id="user_login" autocomplete="username" required aria-required="true" />
    </div>

	<div class="clear"></div>

	<?php do_action( 'woocommerce_lostpassword_form' ); ?>

    <div class="input-wrapper">
                <input type="hidden" name="wc_reset_password" value="true" />
                <button type="submit" class="main-btn btn-primary<?php echo esc_attr( wc_wp_theme_get_element_class_name( 'button' ) ? ' ' . wc_wp_theme_get_element_class_name( 'button' ) : '' ); ?>" value="<?php esc_attr_e( 'Reset Password', 'woocommerce' ); ?>"><?php esc_html_e( 'Reset Password', 'woocommerce' ); ?></button>
            </div>

	<?php wp_nonce_field( 'lost_password', 'woocommerce-lost-password-nonce' ); ?>

</form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
do_action( 'woocommerce_after_lost_password_form' );
