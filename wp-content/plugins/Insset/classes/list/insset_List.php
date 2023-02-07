<?php

if (!class_exists('insset_List')) {
    require_once(ABSPATH .'wp-admin/includes/screen.php');
    require_once(ABSPATH .'wp-admin/includes/class-wp-list-table.php');
}

class insset_List extends WP_List_Table {

    public $_screen;

    public function __construct() {

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
        $columns['email']= __('email');
        $columns['firstname']= __('firstname');
        $columns['lastname']= __('lastname');
        $columns['id'] = __('id');
        $columns['time']= __('time');
        $columns['delete']= __('delete');
        return $columns;
    }

    public function get_hidden_columns($default = array()) {
        return $default;
    }

    public function get_sortable_columns($sortable = array()) {
        return $sortable;
    }

	public function table_data($per_page=10, $page_number=1, $orderbydefault=false) {

        global $wpdb;
    
        $sql = "SELECT A.*, 
        (SELECT B.`key_values` FROM " . $wpdb->prefix . insset_BASENAME . '_sub_table_newsletter' . " B WHERE B.`id`=A.`id` AND B.`key_of_values`='firstname' LIMIT 1) AS 'firstname', 
        (SELECT B.`key_values` FROM " . $wpdb->prefix . insset_BASENAME . '_sub_table_newsletter' . " B WHERE B.`id`=A.`id` AND B.`key_of_values`='email' LIMIT 1) AS 'email',
        (SELECT B.`key_values` FROM " . $wpdb->prefix . insset_BASENAME . '_sub_table_newsletter' . " B WHERE B.`id`=A.`id` AND B.`key_of_values`='lastname' LIMIT 1) AS 'lastname',
        (SELECT B.`key_values` FROM " . $wpdb->prefix . insset_BASENAME . '_sub_table_newsletter' . " B WHERE B.`id`=A.`id` AND B.`key_of_values`='zipcode' LIMIT 1) AS 'zipcode'
        FROM " . $wpdb->prefix . insset_BASENAME . '_newsletter' . " A ";
    
    
        if (!empty($_REQUEST['orderby'])) {
            $sql .= ' ORDER BY '. esc_sql($_REQUEST['orderby']) .'';
            $sql .= ! empty($_REQUEST['order']) ? ' ' . esc_sql($_REQUEST['order']) : ' ASC';
        }
    
        $result = $wpdb->get_results($sql, 'ARRAY_A');
            return $result;
        }

        public function column_default( $item, $column_name ) {

            if (preg_match('/delete/i',$column_name))
                return self::getDelete($item['id']);
    
        return @$item[$column_name];
        }
    
        private function getDelete($id=0) {
    
            if (!$id)
                return;
    
            return  sprintf(
                '<button data-id="%d" class="btn btn-secondary btn-small deleteButton"></button>',
                $id,
                __('delete'));
        }
}