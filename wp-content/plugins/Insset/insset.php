<?php
/*
Plugin Name: Inseet Winona Lebrun
Author: Winona Lebrun
Description: Un simple plugin pour recevoir mes petits hacks WordPress.
Version: 1.0
*/
remove_action('wp_head', 'wp_generator');

if (!defined('ABSPATH'))
    exit;

define('insset_VERSION', '1.0.0');
define('insset_FILE', __FILE__);
define('insset_DIR', dirname(insset_FILE));
define('insset_BASENAME', pathinfo((insset_FILE))['filename']);
define('insset_PLUGIN_NAME', insset_BASENAME);

foreach (glob(insset_DIR .'/classes/*/*.php') as $filename)
    if (!preg_match('/export|cron/i', $filename))
        if (!@require_once $filename)
            throw new Exception(sprintf(__('Failed to include %s'), $filename));

register_activation_hook(insset_FILE, function() {
    $insset_Install = new insset_Install();
    $insset_Install->setup();
});

if (is_admin())
    new insset_Admin();
else
    new insset_Front();