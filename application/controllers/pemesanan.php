<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pemesanan extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('m_pemesanan');
        $this->load->helper('url');
        $this->load->library('form_validation');
        
    }

    public function index()
    {
        $data['title'] = "Daftar Pemesanan";
        $data['pemesanan'] = $this->m_pemesanan->get();
        $this->load->template_admin('pemesanan/index.php', $data);
    }

    function get($id = null)
    {
        $data = $this->m_pemesanan->get();
        print_r($data);
    }

    function view() 
    {
        $id = $this->uri->segment(3);
        $data['title'] = "Detail Pemesanan";
        $data['pemesanan']  = $this->m_pemesanan->detail($id);
        $this->load->template_admin('pemesanan/view', $data);
    }

    function edit() 
    {
        $id = $this->uri->segment(3);
        $data['title'] = "Edit Data Pemesanan";
        $data['pemesanan']  = $this->m_pemesanan->detail($id);
        $this->load->template_admin('pemesanan/edit', $data);
    }

    // function create()
    // {
    //     $data['title'] = "Input Pemesanan";
    //     $this->load->template_admin('pemesanan/create', $data);   
    // }

    function save()
    {
        $id = $this->input->post('id');
        $save = $this->m_pemesanan->save();    
        
        if ($save) {
            redirect('pemesanan','refresh');
        } else {
            echo "save failed";
        }
    }

/*    function delete() 
    {
        $id = $this->uri->segment(3);
        $delete = $this->m_pemesanan->delete($id);    
        
        if ($delete) {
            redirect('pemesanan','refresh');
        } else {
            echo "delete failed";
        }   
    }*/

    function delete() 
    {
        $this->load->model('m_pembayaran');

        $id = $this->uri->segment(3);
        $delete_pemesanan = $this->m_pemesanan->delete($id);    
        
        if ($delete_pemesanan) {
            
            $delete_pembayaran = $this->m_pembayaran->deleteteByPembayaranId($id);

            if ($delete_pembayaran) {
                redirect('pemesanan','refresh');
            } else {
                echo "delete pembayaran error";
            }

        } else {
            echo "delete pemesanan failed";
        }   
    }

}

/* End of file  */
/* Location: ./application/controllers/ */