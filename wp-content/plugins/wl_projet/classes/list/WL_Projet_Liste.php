<?php

if (!class_exists('WP_List_Table')) {
    require_once(ABSPATH .'wp-admin/includes/screen.php');
    require_once(ABSPATH .'wp-admin/includes/class-wp-list-table.php');
}

class WL_Projet_Liste extends WP_List_Table
{
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

        $columns['pays'] = __('pays');
        $columns['code_ISO'] = __('code_ISO');
        $columns['notation'] = __('notation');
        $columns['accessibilité'] = __('accessibilité aux majeurs uniquement');
        return $columns;

    }

    public function get_hidden_columns($default = array()) {

        return $default;

    }

    public function get_sortable_columns($sortable = array()) {

        global $wpdb;

        $sql = "SELECT DISTINCT `pays` FROM " . $wpdb->prefix . WL_PROJET_BASENAME . '_pays' ." WHERE `code_ISO` !='' ";

        $result = $wpdb->get_results($sql, 'ARRAY_A');

        foreach ($result as $value)
            $sortable[$value["pays"]] = array($value["pays"], true);

        $sortable["pays"] = array('pays', true);
        $sortable["code_ISO"] = array('code_ISO', true);
        $sortable["notation"] = array('notation', true);
        $sortable["acessibilité_majeur_uniquement"] = array('acessibilité_majeur_uniquement', true);

        return $sortable;
    }

    public function table_data($per_page=10, $page_number=1, $orderbydefault=false) {

        global $wpdb;

        $sql = "SELECT * FROM " . $wpdb->prefix . WL_PROJET_BASENAME . '_pays' ;


        if (!empty($_REQUEST['orderby'])) {
            $sql .= ' ORDER BY `'. esc_sql($_REQUEST['orderby']) .'`';
            $sql .= ! empty($_REQUEST['order']) ? ' ' . esc_sql($_REQUEST['order']) : ' ASC';
        }

        $result = $wpdb->get_results($sql, 'ARRAY_A');

        return $result;

    }

    public function column_default( $item, $column_name ) {

        if (preg_match('/notation/i',$column_name))
            return self::getNotation($item['id']);

        if (preg_match('/accessibilité/i',$column_name))
            return self::getAccessibilite($item['id']);

        return @$item[$column_name];

    }

    private function getNotation($id=0) {

        if (!$id)
            return;

        return  sprintf(
            '<select data-id="%d" class="notation_pays">
                            <option value="0">0</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                        </select>',
            $id,
            __('notation')
        );
    }

    private function getAccessibilite($id=0) {

        if (!$id)
            return;

        return  sprintf(
            '<input type="checkbox" data-id="%d" class="accessible_majeur"> ',
            $id,
            __('accessibilité')
        );
    }

    //ligne grisée si non accessible
    public function single_row($item)
    {
        $cssClass = ($item['disponibilité'] == 1) ? '' : 'hd_grid_disable_row';
        echo '<tr class="' . $cssClass . '">';
        $this->single_row_columns($item);
        echo '</tr>';
    }


}
