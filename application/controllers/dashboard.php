<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $access = array('ADMIN', 'USER');
        $this->auth->restrict($access);
    }

    public function index()
    {
        $session_data         = $this->session->userdata('username');
        $data['title']        = "Welcome to Dashboard page";

        $this->load->template_admin('dashboard/index.php', $data);
    }

}

/* End of file dashboard.php */
/* Location: ./application/controllers/dashboard.php */