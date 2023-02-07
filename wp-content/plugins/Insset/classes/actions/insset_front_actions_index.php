<?php

add_action('wp_ajax_insset_newsletter', array('insset_front_actions_index', 'newjob'));
add_action('wp_ajax_nopriv_insset_newsletter', array('insset_front_actions_index', 'newjob'));

class insset_front_actions_index {

    public static function newjob() {

        check_ajax_referer('ajax_nonce_security', 'security');

        if ((!isset($_REQUEST)) || sizeof(@$_REQUEST) < 1)
            exit;
            
        print "ok";
            exit;
    }
}
?>