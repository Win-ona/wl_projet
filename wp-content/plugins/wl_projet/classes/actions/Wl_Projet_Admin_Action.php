<?php

add_action('wp_ajax_changeDisponibility', array('Wl_Projet_Admin_Action', 'change_disponibilité'));
add_action('wp_ajax_changeAccessibility', array('Wl_Projet_Admin_Action', 'change_accessible'));
add_action('wp_ajax_changeNote', array('Wl_Projet_Admin_Action', 'change_note'));

class Wl_Projet_Admin_Action
{

    public function __construct()
    {

        return;
    }

    public static function change_disponibilité()
    {

        check_ajax_referer('ajax_nonce_security', 'security');

        if ((!isset($_REQUEST))  || sizeof(@$_REQUEST) < 1)
            exit;

        foreach ($_REQUEST as $key => $value)
            $$key = $value;

        $Wl_Projet_Crud_Index= new Wl_Projet_Crud_Index();
        $response = $Wl_Projet_Crud_Index->update_disponibility($_REQUEST['idDisponible']);

        print $response;

    }

    public static function change_accessible()
    {

        check_ajax_referer('ajax_nonce_security', 'security');

        if ((!isset($_REQUEST))  || sizeof(@$_REQUEST) < 1)
            exit;

        $Wl_Projet_Crud_Index= new Wl_Projet_Crud_Index();
        $response = $Wl_Projet_Crud_Index->update_accessibility($_REQUEST['updateAccess'], $_REQUEST['valueAccess']);

        print $response;

        exit;

    }

    public static function change_note()
    {

        check_ajax_referer('ajax_nonce_security', 'security');

        if ((!isset($_REQUEST)) || sizeof(@$_REQUEST) < 1)
            exit;

        $Wl_Projet_Crud_Index= new Wl_Projet_Crud_Index();
        $response = $Wl_Projet_Crud_Index->update_note($_REQUEST['idNote'], $_REQUEST['valueNote']);

        print $response;

        exit;

    }
}