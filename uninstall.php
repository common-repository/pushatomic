<?php
if (!defined('WP_UNINSTALL_PLUGIN')) {
    die;
}
$option_name = 'pushatomic';
delete_option($option_name);
delete_site_option($option_name);