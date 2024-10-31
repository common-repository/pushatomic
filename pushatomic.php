<?php
/**
 * Plugin Name: Pushatomic
 * Plugin URI: https://pushatomic.com
 * Description: Add Pushatomic to your web easily with this plugin
 * Version: 1.0.15
 * Author: Hullcode S.L.
 * Author URI: https://hullcode.com
 * Text Domain: pushatomic
 * Domain Path: /languages/
 * License: GPLv2 or later
**/



defined( 'ABSPATH' ) or die( 'ABSPATH not defined' );

define ('PUSHATOMIC_VERSION', '1.0.15');
define ('PUSHATOMIC_DEF_PLUGIN_NAME', 'Pushatomic');
define ('PUSHATOMIC_DEF_PLUGIN', 'pushatomic');
define ('PUSHATOMIC_DEF_BASEURL', plugins_url('', __FILE__));
define ('PUSHATOMIC_CS_SETTINGS', 'pushatomic');

add_action('init', 'pushatomic_textdomain');
add_action('wp_footer', 'pushatomic_base_code');


function pushatomic_textdomain() {
    load_plugin_textdomain(PUSHATOMIC_DEF_PLUGIN, FALSE, plugin_basename(dirname(__FILE__)) . '/languages' );
}


if (is_admin()) {
	add_action('admin_menu', 'pushatomic_plugin_setup_menu');
	add_action('wp_ajax_pushatomic_save_settings', 'pushatomic_save_settings');
	add_filter('plugin_action_links_' . plugin_basename(__FILE__), 'pushatomic_plugin_links' );
}


function pushatomic_plugin_setup_menu(){
	add_menu_page(
	 'pushatomic',
	 'Pushatomic',
	 'manage_options',
	 'pushatomic',
	 'pushatomic_admin_panel',
	 'data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0idXRmLTgiPz4NCjwhLS0gR2VuZXJhdG9yOiBBZG9iZSBJbGx1c3RyYXRvciAyMy4wLjMsIFNWRyBFeHBvcnQgUGx1Zy1JbiAuIFNWRyBWZXJzaW9uOiA2LjAwIEJ1aWxkIDApICAtLT4NCjxzdmcgdmVyc2lvbj0iMS4xIiBpZD0iTGF5ZXJfMSIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB4bWxuczp4bGluaz0iaHR0cDovL3d3dy53My5vcmcvMTk5OS94bGluayIgeD0iMHB4IiB5PSIwcHgiDQoJIHZpZXdCb3g9IjAgMCAyMCAyMCIgc3R5bGU9ImVuYWJsZS1iYWNrZ3JvdW5kOm5ldyAwIDAgMjAgMjA7IiB4bWw6c3BhY2U9InByZXNlcnZlIj4NCjxzdHlsZSB0eXBlPSJ0ZXh0L2NzcyI+DQoJLnN0MHtmaWxsOiNBN0FBQUQ7fQ0KPC9zdHlsZT4NCjxnPg0KCTxwYXRoIGNsYXNzPSJzdDAiIGQ9Ik0yLjgsMTBjMC0xLjMsMC40LTIuNiwxLTMuNkMzLjQsNi4yLDMuMSw1LjksMi44LDUuNUMyLDYuOCwxLjUsOC4zLDEuNSwxMGwwLDcuNmMwLDAuMSwwLDAuNSwwLjIsMC43DQoJCWMwLjIsMC4yLDAuNSwwLjIsMC43LDAuMmwzLjQtMS4xYzEuMywwLjcsMi44LDEuMSw0LjIsMS4xYzQuNywwLDguNS0zLjgsOC41LTguNVMxNC43LDEuNSwxMCwxLjVjLTEuNCwwLTIuOCwwLjMtMy45LDENCgkJYzAuNCwwLjMsMC42LDAuNiwwLjgsMS4xYzAuOS0wLjUsMi0wLjcsMy4yLTAuN2MzLjksMCw3LjIsMy4yLDcuMiw3LjJzLTMuMiw3LjItNy4yLDcuMmMtMS40LDAtMi43LTAuNC0zLjgtMS4xDQoJCUM2LDE2LDUuOCwxNS45LDUuNywxNmwtMi44LDAuOUwyLjgsMTB6Ii8+DQoJPGNpcmNsZSBjbGFzcz0ic3QwIiBjeD0iNC43IiBjeT0iNC4yIiByPSIxLjIiLz4NCgk8Y2lyY2xlIGNsYXNzPSJzdDAiIGN4PSIxMCIgY3k9IjEwIiByPSIyLjEiLz4NCjwvZz4NCjwvc3ZnPg0K'
 	);
}

function pushatomic_plugin_links ($links) {
	$settings_link = '<a href="admin.php?page=pushatomic">' . __( 'Settings', PUSHATOMIC_DEF_PLUGIN ) . '</a>';
	array_unshift( $links, $settings_link );
	return $links;
}

function pushatomic_save_settings () {

	if (!is_admin()) {
		die('You need to be admin to access this page');
	}

	$response = array();
	$response['error'] = false;
	$response['message'] = __('Setting saved successfuly', PUSHATOMIC_DEF_PLUGIN);;	

	if(!wp_verify_nonce($_POST['nonce'], PUSHATOMIC_CS_SETTINGS)) {
		$response['error'] = true;
		$response['message'] = __('Nonce invalid. Please, reload page.', PUSHATOMIC_DEF_PLUGIN);
		wp_send_json($response);
		die();
	} else {
		$settings = pushatomic_get_settings();
		$settings['pushatomic-version'] = PUSHATOMIC_VERSION;
		$settings['pushatomic-enabled'] = sanitize_text_field($_POST['pushatomic-enabled']);
		$settings['pushatomic-id'] = sanitize_text_field($_POST['pushatomic-id']);
		$settings['pushatomic-prompt'] = sanitize_text_field($_POST['pushatomic-prompt']);
		$settings['pushatomic-closed-days'] = sanitize_text_field($_POST['pushatomic-closed-days']);
		$settings['pushatomic-title'] = sanitize_text_field($_POST['pushatomic-title']);
		$settings['pushatomic-accept-button'] = sanitize_text_field($_POST['pushatomic-accept-button']);
		$settings['pushatomic-decline-button'] = sanitize_text_field($_POST['pushatomic-decline-button']);
		$settings['pushatomic-show-custom-icon'] = sanitize_text_field($_POST['pushatomic-show-custom-icon']);
		$settings['pushatomic-custom-icon'] = sanitize_text_field($_POST['pushatomic-custom-icon']);
		$settings['pushatomic-position'] = sanitize_text_field($_POST['pushatomic-position']);
		$settings['pushatomic-z-index'] = sanitize_text_field($_POST['pushatomic-z-index']);
		$settings['pushatomic-background-color'] =sanitize_text_field($_POST['pushatomic-background-color']);
		$settings['pushatomic-text-color'] = sanitize_text_field($_POST['pushatomic-text-color']);
		$settings['pushatomic-accept-button-background-color'] = sanitize_text_field($_POST['pushatomic-accept-button-background-color']);
		$settings['pushatomic-accept-button-text-color'] = sanitize_text_field($_POST['pushatomic-accept-button-text-color']);
		$settings['pushatomic-decline-button-background-color'] = sanitize_text_field($_POST['pushatomic-decline-button-background-color']);
		$settings['pushatomic-decline-button-text-color'] = sanitize_text_field($_POST['pushatomic-decline-button-text-color']);
		$settings['pushatomic-devices'] = sanitize_text_field($_POST['pushatomic-devices']);
		$settings['pushatomic-trigger-mode'] = sanitize_text_field($_POST['pushatomic-trigger-mode']);
		$settings['pushatomic-trigger-timeout'] = sanitize_text_field($_POST['pushatomic-trigger-timeout']);
		$settings['pushatomic-trigger-scroll'] = sanitize_text_field($_POST['pushatomic-trigger-scroll']);


		update_option(PUSHATOMIC_CS_SETTINGS, $settings);
	}

	wp_send_json($response);
	die();
}


function pushatomic_get_settings() {

	$settings = get_option(PUSHATOMIC_CS_SETTINGS);


	if($settings){
		if(PUSHATOMIC_VERSION != $settings['pushatomic-version']) {
			$default_settings = pushatomic_get_default_settings();
			$setting_updated = array_merge(array_diff_key($settings, $default_settings), array_diff_key($default_settings, $settings), $settings);
			$setting_updated['pushatomic-version'] = PUSHATOMIC_VERSION;
			update_option(PUSHATOMIC_CS_SETTINGS, $setting_updated);
			return $setting_updated;
		} else {
			return $settings;
		}

	} else {
		$settings = pushatomic_get_default_settings();
		update_option(PUSHATOMIC_CS_SETTINGS, $settings);
		return $settings;
	}
}

function pushatomic_get_default_settings() {
	$settings = array();
	$settings['pushatomic-version'] = PUSHATOMIC_VERSION;
	$settings['pushatomic-enabled'] = 1;
	$settings['pushatomic-id'] = '';
	$settings['pushatomic-prompt'] = 0;
	$settings['pushatomic-closed-days'] = 7;
	$settings['pushatomic-title'] = __( "We'd like to show you notifications for the latest news and updates.", PUSHATOMIC_DEF_PLUGIN);
	$settings['pushatomic-accept-button'] = __('Allow', PUSHATOMIC_DEF_PLUGIN);
	$settings['pushatomic-decline-button'] = __('Cancel', PUSHATOMIC_DEF_PLUGIN);
	$settings['pushatomic-show-custom-icon'] = 0;
	$settings['pushatomic-custom-icon'] = 'data:image/gif;base64,R0lGODlhAQABAAD/ACwAAAAAAQABAAACADs%3D';
	$settings['pushatomic-position'] = 'top';
	$settings['pushatomic-z-index'] = 99999;
	$settings['pushatomic-background-color'] = '#ffffff';
	$settings['pushatomic-text-color'] = '#051b2c';
	$settings['pushatomic-accept-button-background-color'] = '#0078d1';
	$settings['pushatomic-accept-button-text-color'] = '#ffffff';
	$settings['pushatomic-decline-button-background-color'] = '#ffffff';
	$settings['pushatomic-decline-button-text-color'] = '#0078d1';
	$settings['pushatomic-devices'] = 'all';
	$settings['pushatomic-trigger-mode'] = 'instant';
	$settings['pushatomic-trigger-timeout'] = 10;
	$settings['pushatomic-trigger-scroll'] = 500;
	return $settings;
}


function pushatomic_base_code() {

	$settings = pushatomic_get_settings();

	if($settings['pushatomic-enabled'] == 0) {
		return;
	}

	if(is_numeric(base64_decode($settings['pushatomic-id'])) == false) {
		return;
	}

	$settings['pushatomic-sw'] = plugin_dir_url(__FILE__) . 'resources/js/pushatomicSW.js';

	
	
	$content = "<script>\n";
	$content .= "window.pushAtomic = window.pushAtomic || {\n";

		$content .= "uid:'".$settings['pushatomic-id']."',\n";
		$content .= "serviceWorker:'".$settings['pushatomic-sw']."',\n";


		if($settings['pushatomic-prompt'] == 1) {
			$content .= "prompt:".$settings['pushatomic-prompt'].",\n";
		}

		if($settings['pushatomic-devices'] != 'all') {
			$content .= "devices:'".$settings['pushatomic-devices']."',\n";
		}

		if($settings['pushatomic-trigger-mode'] != 'instant') {
			$content .= "trigger_mode:'".$settings['pushatomic-trigger-mode']."',\n";
		}

		if($settings['pushatomic-trigger-mode'] == 'scroll') {
			$content .= "scroll_trigger:'".$settings['pushatomic-trigger-scroll']."',\n";
		}

		if($settings['pushatomic-trigger-mode'] == 'timeout') {
			$content .= "timeout_trigger:".$settings['pushatomic-trigger-timeout'].",\n";
		}

		if($settings['pushatomic-prompt'] == 1) {
			$content .= "closed_days:".$settings['pushatomic-closed-days'].",\n";
			$content .= "z_index:".$settings['pushatomic-z-index'].",\n";
			$content .= "title:'".$settings['pushatomic-title']."',\n";
			$content .= "accept_button:'".$settings['pushatomic-accept-button']."',\n";
			$content .= "decline_button:'".$settings['pushatomic-decline-button']."',\n";
			$content .= "position:'".$settings['pushatomic-position']."',\n";
			$content .= "font_color:'".$settings['pushatomic-text-color']."',\n";
			$content .= "background_color:'".$settings['pushatomic-background-color']."',\n";
			$content .= "accept_button_font_color:'".$settings['pushatomic-accept-button-text-color']."',\n";
			$content .= "accept_button_background_color:'".$settings['pushatomic-accept-button-background-color']."',\n";
			$content .= "decline_button_font_color:'".$settings['pushatomic-decline-button-text-color']."',\n";
			$content .= "decline_button_background_color:'".$settings['pushatomic-decline-button-background-color']."',\n";
		}


		if($settings['pushatomic-show-custom-icon'] == 1) {
			$content .= "show_custom_icon:".$settings['pushatomic-show-custom-icon'].",\n";
			$content .= "custom_icon:'".$settings['pushatomic-custom-icon']."',\n";
		}

	$content .= "}\n";

	$content .= "</script>";

	$content .= "<script async src='https://cdn.pushatomic.com/pushatomic.js'></script>\n";


	echo $content;

}


function pushatomic_admin_panel() {

	if (!is_admin()) {
		die('You need to be admin to access this page');
	}

	wp_enqueue_style('pushatomic-admin-style', plugin_dir_url(__FILE__). 'resources/css/pushatomic-admin.css', array(), PUSHATOMIC_VERSION);
	wp_enqueue_style('pushatomic-growl', plugin_dir_url(__FILE__). 'resources/css/jquery.growl.css', array(), PUSHATOMIC_VERSION);


    wp_register_script('pushatomic-admin-script', plugin_dir_url(__FILE__). 'resources/js/pushatomic-admin.js', array('jquery'), PUSHATOMIC_VERSION, true);
    wp_register_script('jqColorPicker', plugin_dir_url(__FILE__). 'resources/js/jqColorPicker.min.js', array(), PUSHATOMIC_VERSION);
	wp_register_script('growl', plugin_dir_url(__FILE__). 'resources/js/jquery.growl.js', array(), PUSHATOMIC_VERSION);
	wp_register_script('sticky', plugin_dir_url(__FILE__). 'resources/js/jquery.sticky.js', array(), PUSHATOMIC_VERSION);

	wp_enqueue_script('pushatomic-admin-script');
	wp_enqueue_script('jqColorPicker');
	wp_enqueue_script('sticky');
	wp_enqueue_script('growl');
	wp_enqueue_media();

	$settings = pushatomic_get_settings();

	$settings['ajaxurl'] = admin_url('admin-ajax.php');
	$settings['nonce'] = wp_create_nonce(PUSHATOMIC_CS_SETTINGS);
	$settings['action_save_settings'] = 'pushatomic_save_settings';
	$settings['bell-icon'] = PUSHATOMIC_DEF_BASEURL . '/resources/img/icon_bell.svg';
	$settings['txt-pushatomic-is-active'] = __('Pushatomic is now active', PUSHATOMIC_DEF_PLUGIN);
	$settings['txt-pushatomic-is-incorrect'] = __('Your Pushatomic ID is incorrect', PUSHATOMIC_DEF_PLUGIN);


	wp_localize_script('pushatomic-admin-script', 'pushatomic_back_js', $settings);

	include_once plugin_dir_path(__FILE__) . 'pushatomic-admin.php';
}

?>