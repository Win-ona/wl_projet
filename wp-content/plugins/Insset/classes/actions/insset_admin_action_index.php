<?php

add_action('wp_ajax_remove_newsletter', array('insset_admin_action_index', 'ajaxSubmit'));

class insset_admin_action_index {

    public function __construct() {
        return;
    }

    static public function ajaxSubmit(){

        check_ajax_referer('ajax_nonce_security', 'security');

            if ((!isset($_REQUEST)) || sizeof(@$_REQUEST) < 1)
                exit;

        $insset_crud_index = new insset_crud_index();
        $sql = $insset_crud_index->remove(($_REQUEST['idDelete']));

        print ($sql);
            exit;
    }

}
?>