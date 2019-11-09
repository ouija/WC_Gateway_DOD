<?php
/*
 * Plugin Name: WooCommerce Debit on Delivery
 * Plugin URI: https://github.com/ouija/WC_Gateway_DOD
 * Description: Extends WooCommerce by adding a payment option of debit on delivery.
 * Version: 1.4
 * Requires at least: 4.0
 * Tested up to: 5.3
 * WC requires at least: 2.5
 * WC tested up to: 3.8
 * Author: ouija
 * Author URI: http://ouija.xyz
 * License: GPLv2 or later
 * Text Domain: dod
 */

/* Initalization */
add_action( 'plugins_loaded', 'dod_init', 0 );
function dod_init() {

	/* Checks if WooCommerce is installed and activated */
	if ( ! class_exists( 'WC_Payment_Gateway' ) ) return;
	
	/* Inlcude payment gateway class */
	include_once( 'class-wc-gateway-dod.php' );

	/* Adds dod payment gateway */
	add_filter( 'woocommerce_payment_gateways', 'dod_add_gateway' );
	function dod_add_gateway( $methods ) {
		$methods[] = 'WC_Gateway_DOD';
		return $methods;
	}
}

/* Plugin action links */
add_filter( 'plugin_action_links_' . plugin_basename( __FILE__ ), 'dod_action_links' );
function dod_action_links( $links ) {
	$plugin_links = array(
		'<a href="' . admin_url( 'admin.php?page=wc-settings&tab=checkout&section=dod' ) . '">' . __( 'Settings', 'dod' ) . '</a>',
	);
	return array_merge( $plugin_links, $links );	
}