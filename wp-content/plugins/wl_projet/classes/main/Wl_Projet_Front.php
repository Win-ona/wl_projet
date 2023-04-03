<?php

class Wl_Projet_Front
{

    public function __construct()
    {

        add_action('wp_enqueue_scripts', array($this, 'addjs'), 0);
        return;
    }

    public function addjs() {

        wp_enqueue_script('Wl_projet', plugins_url( WL_PROJET_BASENAME .'/assets/js/Wl_Projet_Front.js'), array('jquery-new'), WL_PROJET_VERSION, true);
        wp_localize_script('Wl_projet', 'Wlprojetscript', array(
            'ajax_url' => admin_url('admin-ajax.php'),
            'security' => wp_create_nonce('ajax_nonce_security')
        ));

        return;

    }
}