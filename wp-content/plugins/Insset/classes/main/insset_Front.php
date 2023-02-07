<?php

class insset_Front {
    public function __construct() {
        add_action('wp_enqueue_scripts', array($this, 'addjs'), 0);
        return;
    }

    public function  addjs() {
        wp_enqueue_script('insset', plugins_url(insset_PLUGIN_NAME . '/assets/js/Insset_Front.js'), array('jquery-new'), insset_VERSION, true);
        wp_localize_script('insset', 'inssetscript', array(
            'ajax_url' => admin_url('admin-ajax.php'),
            'security' => wp_create_nonce('ajax_nonce_security')
        ));
        return;
    }
}
?>