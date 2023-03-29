<?php
/*
Plugin Name: Wl_Projet Winona Lebrun
Author: Winona Lebrun
Description: Un simple plugin pour recevoir mes petits hacks WordPress.
Version: 1.0
*/
remove_action('wp_head', 'wp_generator');

if (!defined('ABSPATH'))
    exit;

define('WL_PROJET_VERSION', '1.0.0');
define('WL_PROJET_FILE', __FILE__);
define('WL_PROJET_DIR', dirname(WL_PROJET_FILE));
define('WL_PROJET_BASENAME', pathinfo((WL_PROJET_FILE))['filename']);
define('WL_PROJET_PLUGIN_NAME', WL_PROJET_BASENAME);

foreach (glob(WL_PROJET_DIR .'/classes/*/*.php') as $filename)
    if (!preg_match('/export|cron/i', $filename))
        if (!@require_once $filename)
            throw new Exception(sprintf(__('Failed to include %s'), $filename));

register_activation_hook(WL_PROJET_FILE, function() {
    $Wl_Projet_Install = new Wl_Projet_Install();
    $Wl_Projet_Install->setup();
});

if (is_admin())
    new Wl_Projet_Admin();
else
    new WL_Projet_Front();