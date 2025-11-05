<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller {
    
    public function __construct()
    {
        parent::__construct();
        logged_in();
    }
    
    /**
     * Index Function
     *
     * @return void
     */
    public function index()
    {
        
    }

    /**
     * Settings Function
     * Showing settings page
     *
     * @return void
     */
    public function settings()
    {
        $data['title']      = "Users - Settings";
        $data['content']    = "settings";
        $this->load->view('default', $data);
    }

    public function do_logout()
    {
        $this->session->sess_destroy();
        redirect('welcome');
    }

}

/* End of file Users.php */
