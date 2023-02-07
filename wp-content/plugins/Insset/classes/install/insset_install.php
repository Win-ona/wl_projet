<?php

class Insset_Install {

    public function __construct() {

        add_action( 'admin_init', array( $this, 'setup' ) );
        return;

    }

    public function tableAlreadyExists( $table_name = '' ) {

        global $wpdb;

        if ( $wpdb->get_var( "SHOW TABLES LIKE '$table_name'" ) == $table_name )
            return true;

        return false;
    }

    public function setup() {

        global $wpdb;

        $charset_collate = $wpdb->get_charset_collate();
        $table_name_newsletter = $wpdb->prefix . 'insset_newsletter';

        // if ( $this->tableAlreadyExists( $table_name_newsletter ) )
        //     return;

        $sql_create_newsletter = "CREATE TABLE $table_name_newsletter (
            id mediumint(9) NOT NULL AUTO_INCREMENT,
            time datetime DEFAULT NOW() NOT NULL,
            PRIMARY KEY (id)
        ) $charset_collate;";

        require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );

        if (dbDelta($sql_create_newsletter)) {
            $table_name_sub_newsletter = $wpdb->prefix . insset_BASENAME . '_sub_table_newsletter';

            $sql_create_sub_table_newsletter = "CREATE TABLE IF NOT EXISTS $table_name_sub_newsletter (
                id mediumint(9) NOT NULL,
                key_of_values VARCHAR(255) NOT NULL,
                key_values VARCHAR(255) NOT NULL,
                FOREIGN KEY (id) REFERENCES $table_name_newsletter(id)
            ) $charset_collate;";

            if (dbDelta($sql_create_sub_table_newsletter))
                return;
        }
    }

}
?>