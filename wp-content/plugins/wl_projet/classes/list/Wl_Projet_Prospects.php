<?php

if (!class_exists('WP_List_Table')) {
    require_once(ABSPATH .'wp-admin/includes/screen.php');
    require_once(ABSPATH .'wp-admin/includes/class-wp-list-table.php');
}

class Wl_Projet_Prospects extends WP_List_Table {

    public $_tablename = '';
    public $_program;
    public $_screen;

    public function __construct($program = NULL) {

        $this->_program = $program;

        $tempscreen = get_current_screen();
        $this->_screen = $tempscreen->base;

        parent::__construct( [
            'singular' => __('Item', 'sp'),
            'plural'   => __('Items', 'sp'),
            'ajax'     => false
        ]);

    }

    public function prepare_items() {

        $columns = $this->get_columns();
        $hidden = $this->get_hidden_columns();
        $sortable = $this->get_sortable_columns();
        $this->_column_headers = array($columns, $hidden, $sortable);

        $data = $this->table_data();
        $currentPage = $this->get_pagenum();

        $perPage = 10;
        $this->set_pagination_args(array(
            'total_items' => count($data),
            'per_page'    => $perPage
        ));

        $data = array_slice($data, (($currentPage-1)*$perPage), $perPage);

        $this->items = $data;

    }

    public function get_columns($columns = array()) {

        $columns['informations'] = __('Informations');
        $columns['dateCreation'] = __('Voeux');
        return $columns;

    }

    public function get_hidden_columns($default = array()) {

        return $default;

    }

    public function get_sortable_columns($sortable = array()) {

        global $wpdb;

        $sql = "SELECT DISTINCT `cle` FROM " . $wpdb->prefix . WL_PROJET_BASENAME . '_prospectsdata' ." WHERE `cle` !='' ";

        $result = $wpdb->get_results($sql, 'ARRAY_A');

        foreach ($result as $value)
            $sortable[$value["cle"]] = array($value["cle"], true);

        $sortable["id"] = array('id', true);
        $sortable["dateNaissance"] = array('dateNaissance', true);
        $sortable["prenom"] = array('prenom', true);
        $sortable["nom"] = array('nom', true);

        return $sortable;
    }

    public function table_data($per_page=10, $page_number=1, $orderbydefault=false) {

        global $wpdb;

        $sql = "SELECT A.*, 
        (SELECT B.`valeur` FROM " . $wpdb->prefix . WL_PROJET_BASENAME . '_prospectsdata' ." B WHERE B.`id`=A.`id` AND B.`cle`='prenom' LIMIT 1) AS 'prenom', 
        (SELECT B.`valeur` FROM " . $wpdb->prefix . WL_PROJET_BASENAME . '_prospectsdata' ." B WHERE B.`id`=A.`id` AND B.`cle`='nom' LIMIT 1) AS 'nom',
        (SELECT B.`valeur` FROM " . $wpdb->prefix . WL_PROJET_BASENAME . '_prospectsdata'." B WHERE B.`id`=A.`id` AND B.`cle`='sexe' LIMIT 1) AS 'sexe',
        (SELECT B.`valeur` FROM " . $wpdb->prefix . WL_PROJET_BASENAME . '_prospectsdata'." B WHERE B.`id`=A.`id` AND B.`cle`='dateNaissance' LIMIT 1) AS 'dateNaissance'
        (SELECT B.`valeur` FROM " . $wpdb->prefix . WL_PROJET_BASENAME . '_prospectsdata' ." B WHERE B.`id`=A.`id` AND B.`cle`='mail' LIMIT 1) AS 'mail',

        FROM " . $wpdb->prefix . WL_PROJET_BASENAME . '_prospects'." A";


        if (!empty($_REQUEST['orderby'])) {
            $sql .= ' ORDER BY `'. esc_sql($_REQUEST['orderby']) .'`';
            $sql .= ! empty($_REQUEST['order']) ? ' ' . esc_sql($_REQUEST['order']) : ' ASC';
        }

        $result = $wpdb->get_results($sql, 'ARRAY_A');

        return $result;

    }

    public function column_default( $item, $column_name ) {

        if (preg_match('/informations/i',$column_name))
            return self::getInformationsProspects($item['prenom'], $item['nom'], $item['sexe']);

        return @$item[$column_name];

    }

    private function getInformationsProspects($prenom, $nom, $sexe ) {

        if (!$prenom && !$nom && !$sexe)
            return;

        if ($sexe == "Homme")
            printf( "Mr $prenom $nom");
        else
            printf("Mme $prenom $nom");
    }

}