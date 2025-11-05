<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Sqlite_model extends CI_Model {

    protected $sqlite;

    public function __construct()
    {
        parent::__construct();
        $this->sqlite = $this->load->database('local', TRUE, TRUE);
    }

    /**
     * Get Menu List
     *
     * @param Int $parent
     * @return Array
     */
    public function getMenus(Int $parent)
    {
        $params = array(
            'parent'    => $parent,
            'active'    => 1
        );
        $this->sqlite->where($params);
        $this->sqlite->order_by('order', 'ASC');
        $query  = $this->sqlite->get('menus');

        return $query->result();
    }

    public function getChildMenu(Int $parent)
    {
        
    }
}

/* End of file Sqlite_model.php */
