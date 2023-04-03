<?php

add_action('wp_ajax_prospectsInscription', array('Wl_Projet_Front_Action', 'inscription'));
add_action('wp_ajax_nopriv_prospectsInscription', array('WL_Projet_Front_Action', 'inscription'));
add_action('wp_ajax_Wl_Projetselect_pays', array('Wl_Projet_Front_Actions', 'select_pays'));
add_action('wp_ajax_nopriv_Wl_Projetselect_pays', array('Wl_Projet_Front_Actions', 'select_pays'));

class Wl_Projet_Front_Action {

    public static function inscription() {

        check_ajax_referer('ajax_nonce_security', 'security');

        if ((!isset($_REQUEST)) || sizeof(@$_REQUEST) < 1)
            exit;

        foreach ($_REQUEST as $key => $value)
            $$key = (string) trim($value);

        $Wl_Projet_Crud_Index = new Wl_Projet_Crud_Index();
        $lastId = $Wl_Projet_Crud_Index->ajout();

        foreach ($_REQUEST as $key => $value)
            if (!in_array($key, ['action','security']))
                $Wl_Projet_Crud_Index->ajout_data($lastId, $key, $value);

        print "Inscrit";
        exit;
    }

    public static function select_pays()
    {
        check_ajax_referer('ajax_nonce_security', 'security');

        if ((!isset($_REQUEST)) || sizeof(@$_REQUEST) < 1)
            exit;

        var_dump($_REQUEST);

        $Wl_Projet_Crud_Index = new Wl_Projet_Crud_Index();

        foreach ($_REQUEST as $key => $value)
        {
            if (!in_array($key, array('action', 'security')))
            {
                if($value != "Veuillez sélectionner un pays")
                {
                    $Wl_Projet_Crud_Index= new Wl_Projet_Crud_Index();
                    $Wl_Projet_Crud_Index->insert($value);

                }
            }
        }
        exit;
    }

}