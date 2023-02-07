<?php

class insset_Admin {

    public function __construct() {

        add_action('admin_menu', array($this, 'menu'), -1);
        return;

    }

    public function menu() {

        add_menu_page(
            __('INSSET'),
            __('INSSET'),
            'administrator',
            'insset_Admin',
            array($this, 'insset_Admin'),
            'images/marker.png',
            1000
        );

        add_submenu_page(
            'insset_Admin',
            __('INSSET'),
            __('Configuration'),
            'administrator',
            'insset_Admin',
            array($this, 'insset_Admin')
        );

        

        add_submenu_page(
            'insset_Admin',
            __('INSSET'),
            __('Inscrit'),
            'administrator',
            'insset_Admin_Inscrit',
            array($this, 'insset_Admin_Inscrit')
        );

        add_action('admin_enqueue_scripts', array($this, 'assets'), 999);
    }

    public function assets(){
        wp_enqueue_style('admin_enqueue_scripts', plugins_url(insset_BASENAME. '/assets/css/insset_admin.css'));

        wp_register_script('inssetB', plugins_url(insset_BASENAME .'/assets/js/INSSET_Admin.js', true));
        wp_enqueue_script('inssetB');

        wp_localize_script('inssetB', 'inssetscript', array(
            'security' => wp_create_nonce('ajax_nonce_security')
    ));
        return;
    }
    

    public function insset_Admin() {

        $insset_View_Config = new insset_View_Config();
        return $insset_View_Config->display();
    }

    public function insset_Admin_Inscrit() {

        $insset_View_Inscrit = new insset_View_Inscrit();
        return $insset_View_Inscrit->display();
    }
}

?>