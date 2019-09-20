<?php // only copy this line if needed

/**
 * Show the social login buttons on checkout page page before the "Billing Details"
 * Note that this doesn't remove the existing buttons on the login form.
 */
function sv_wc_social_login_show_buttons_checkout_form() {
	if ( function_exists( 'wc_social_login' ) && ! is_admin() ) {
		add_action( 'woocommerce_before_checkout_billing_form', array( wc_social_login()->get_frontend_instance(), 'render_social_login_buttons' ) );
	}
}
add_action( 'init', 'sv_wc_social_login_show_buttons_checkout_form' );
/**
 * Filters the Social Login button text to replace "Log in with " with
 * "Register with " for use below the registration form
 *
 * @param string $login_button_text
 * @return string
 */
function wc_social_login_provider_login_button_text_checkout_form( $login_button_text ) {
	return str_replace( 'Log in with ', 'Register with ', $login_button_text );
}
/**
 * Adds the filter renaming the Social Login buttons displayed after the registration form
 */
function wc_social_login_add_button_text_filter_before_checkout_form_buttons() {
	add_filter( 'wc_social_login_provider_login_button_text', 'wc_social_login_provider_login_button_text_checkout_form' );
}
add_action( 'woocommerce_before_checkout_billing_form', 'wc_social_login_add_button_text_filter_before_checkout_form_buttons', 5 );
/**
 * Removes the filter renaming the Social Login buttons displayed after the registration form
 */
function wc_social_login_remove_button_text_filter_before_checkout_form_buttons() {
	remove_filter( 'wc_social_login_provider_login_button_text', 'wc_social_login_provider_login_button_text_checkout_form' );
}
add_action( 'woocommerce_before_checkout_billing_form', 'wc_social_login_remove_button_text_filter_before_checkout_form_buttons', 15 );
