<?php
class insset_crud_index {

    public function ajout (){

        global $wpdb;

        $wpdb->insert($wpdb->prefix . 'insset_newsletter', ['id'=>0] );
        $lastid=$wpdb->insert_id;
        return $lastid; 
    }

    public function insertInSubTableNewsLetter($refId, $key_of_value, $key_value)
    {
        global $wpdb;
        $table_name_sub_newsletter = $wpdb->prefix . insset_BASENAME . '_sub_table_newsletter';

        $wpdb->insert(
            $table_name_sub_newsletter,
            array(
                'id' => $refId,
                'key_of_values' => $key_of_value,
                'key_values' => $key_value,
            )
        );

        return true;
    }

    public function remove($var){
        if(!$var)
            return;
    
        global $wpdb;

        if($wpdb->delete($wpdb->prefix . insset_BASENAME . '_newsletter', ['id' => $var]))
            $wpdb->delete($wpdb->prefix . insset_BASENAME . '_sub_table_newsletter', ['id' => $var]);
            return 'Suppresion effectuée !';
        
            return 'Erreur !';
    }
}