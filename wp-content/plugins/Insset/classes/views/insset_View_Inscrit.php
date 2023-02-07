<?php

class insset_View_Inscrit {
    public function __construct() {
        return;
    }
    //Display de notre onglet listant les inscrits
    public function display() {

        global $wpdb;
        $Wp_List = new insset_List();

        ?>
            <div class="wrap">
                <h1 class="wp-heading-inline"><?php print get_admin_page_title(); ?></h1>
                <hr class="wp-header-end" />
                <div class="notice notice-info notice-alt is-dismissible hide delete-confirmation">
                    <p><?php _e('Mise à jour effectuée !'); ?></p>
                </div>
                <?php//if (sizeof($toolbar)) self::toolbar($toolbar); ?> 
                <div class="wrap" id="list-table">
                    <form id="list-table-form" method="post">
                        <?php
                            // $page  = filter_input( INPUT_GET, 'page', FILTER_SANITIZE_STRIPPED );
                            // $paged = filter_input( INPUT_GET, 'paged', FILTER_SANITIZE_NUMBER_INT );
                            // printf('<input type="hidden" name="page" value="%s" />', $page);
                            // printf('<input type="hidden" name="paged" value="%d" />', $paged);
                            $Wp_List->prepare_items();
                            $Wp_List->display();
                        ?>
                    </form>
                </div>
            <div>
        <?php
        
    }

    private function toolbar() {
        return '';
    }
}