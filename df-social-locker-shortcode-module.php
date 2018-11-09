<?php
/**
 * Plugin Name:     Social Locker Divi Shortcode Module
 * Plugin URI:      https://www.diviframework.com
 * Description:     A Social Locker Divi Shortcode Module
 * Author:          Divi Framework
 * Author URI:      https://www.diviframework.com
 * Text Domain:     df-social-locker-shortcode-module
 * Domain Path:     /languages
 * Version:         1.2.0
 *
 * @package
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

define('DF_SOCIAL_LOCKER_SHORTCODE_MODULE_VERSION', '1.2.0');
define('DF_SOCIAL_LOCKER_SHORTCODE_MODULE_DIR', __DIR__);
define('DF_SOCIAL_LOCKER_SHORTCODE_MODULE_URL', plugins_url('/' . basename(__DIR__)));

require_once DF_SOCIAL_LOCKER_SHORTCODE_MODULE_DIR . '/vendor/autoload.php';

$container = new \DF\SocialLocker\Container;
$container['plugin_name'] = 'Social Locker Divi Shortcode Module';
$container['plugin_version'] = DF_SOCIAL_LOCKER_SHORTCODE_MODULE_VERSION;
$container['plugin_file'] = __FILE__;
$container['plugin_dir'] = DF_SOCIAL_LOCKER_SHORTCODE_MODULE_DIR;
$container['plugin_url'] = DF_SOCIAL_LOCKER_SHORTCODE_MODULE_URL;
$container['plugin_slug'] = 'df-social-locker-shortcode-module';

// activation hook.
register_activation_hook(__FILE__, array($container['activation'], 'install'));

$container->run();
