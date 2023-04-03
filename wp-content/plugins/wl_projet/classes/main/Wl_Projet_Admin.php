<?php

class Wl_Projet_Admin
{

    public function __construct()
    {

        add_action('admin_menu', array($this, 'menu'), -1);
        return;

    }

    public function menu()
    {

        add_menu_page(
            __('Module_Voyage'),
            __('Module_Voyage'),
            'administrator',
            'Wl_Projet_Admin',
            array($this, 'Wl_Projet_Admin'),
            'images/marker.png',
            1000
        );

        add_submenu_page(
            'Wl_Projet_Admin',
            __('Module_Voyage / Configuration'),
            __('Configuration'),
            'administrator',
            'Wl_Projet_Admin',
            array($this, 'Wl_Projet_Admin')
        );

        add_submenu_page(
            'Wl_Projet_Admin',
            __('Module_Voyage / Liste des Pays'),
            __('Liste des Pays'),
            'administrator',
            'wl_projet_liste_pays',
            array($this, 'Wl_Projet_Liste_Pays')
        );

        add_submenu_page(
            'Wl_Projet_Admin',
            __('Module_Voyage / Prospects'),
            __('Prospects'),
            'administrator',
            'Wl_Projet_Views_Prospects',
            array($this, 'Wl_Projet_Prospects')
        );
        add_action('admin_enqueue_scripts', array($this, 'assets'), 999);
    }

    public function assets(){

        //wp_enqueue_style('admin_enqueue_scripts', plugins_url(WL_PROJET_PLUGIN_NAME.'/assets/css/stylesheet.css'));

        wp_register_script('Wl_Projet_Admin', plugins_url( WL_PROJET_PLUGIN_NAME .'/assets/js/Wl_Projet_Admin.js'), array(), WL_PROJET_VERSION, true);
        wp_enqueue_script('Wl_Projet_Admin');

        wp_localize_script('Wl_Projet_Admin', 'Wlprojetscript', array(
            'security' => wp_create_nonce('ajax_nonce_security')
        ));

        return;
    }

    public function Wl_Projet_Admin() {

        $Wl_Projet_Views_Configuration = new Wl_Projet_Views_Configuration();
        return $Wl_Projet_Views_Configuration->display();

    }

    public function Wl_Projet_Liste_Pays(){

        $Wl_Projet_Views_Liste_Pays = new Wl_Projet_Views_Liste_Pays();
        return $Wl_Projet_Views_Liste_Pays->display();
    }

    public function Wl_Projet_Prospects(){
            $Wl_Projet_Views_Prospects = new Wl_Projet_Views_Prospects();
            return $Wl_Projet_Views_Prospects->display();//création de la page Liste Prospect sur wordpress
    }
}