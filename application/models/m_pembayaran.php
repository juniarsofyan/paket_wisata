<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_pembayaran extends CI_Model {

    public $table = "tpembayaran";

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    function get() 
    {   
        $this->db->select('tp.id, tp.no_faktur, tp.tgl_pembayaran, tc.nama AS customer_nama, tp.total, tp.pembayaran, tp.angsuran_ke')
                  ->from('tpembayaran AS tp, tcustomer AS tc')
                  ->where('tp.customer_id = tc.id');

        
        $query = $this->db->get();

        if ($query->num_rows() > 0)
        {
            $data       = $query->result_array();
            $row_counts = $query->num_rows();

            for ($i = 0; $i < $row_counts; $i++) {
                $number   = $i + 1;
                $no       = array('no' => $number);
                $detail   = array('detail' => "<a href='" . base_url() . "pembayaran/view/" . $data[$i]['id'] . "'>View</a>");
                $data[$i] = $no + $data[$i]; 
                $data[$i] = $data[$i] + $detail; 
            }

            $data = array("data" => $data);
            $data = json_encode($data);

            return $data;
        }
    }

    function detail($id)
    {
        $this->db->select(' tpb.no_faktur, tc.id, tc.nama, tpm.tgl_pemesanan, tpm.jumlah_orang, tpb.total, tpb.angsuran_ke, tpb.pembayaran');
        $this->db->from('tpembayaran tpb');
        $this->db->join('tpemesanan tpm', 'tpm.customer_id = tpb.customer_id', 'inner');
        $this->db->join('tcustomer tc', 'tpm.customer_id = tc.id', 'inner');
        $this->db->where('tpb.customer_id =' . $id);

        $query = $this->db->get();

        if ($query->num_rows() > 0)
        {
            $data = $query->row_array();
            return $data;
        }
    }

    function save()
    {
        $id             = $this->input->post('id');
        $no_faktur      = $this->input->post('no_faktur');
        $pemesanan_id   = $this->input->post('pemesanan_id');
        $customer_id    = $this->input->post('customer_id');
        $tgl_pembayaran = date('Y-m-d');
        $total          = $this->input->post('total');
        $pembayaran     = $this->input->post('pembayaran');
        $angsuran_ke    = $this->input->post('angsuran_ke');
        
        $data = array(
            'no_faktur'      => $no_faktur,
            'pemesanan_id'   => $pemesanan_id,
            'customer_id'    => $customer_id,
            'tgl_pembayaran' => $tgl_pembayaran,
            'total'          => $total,
            'pembayaran'     => $pembayaran,
            'angsuran_ke'    => $angsuran_ke
        );


        if ($id == null) {
            $result = $this->db->insert($this->table, $data);
        } else {
            $this->db->where('id', $id);
            $result = $this->db->update($this->table, $data);
        }

        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    function delete($id)
    {
        $this->db->where('id', $id);
        $delete = $this->db->delete($this->table);

        if ($delete) {
            return true;
        } else {
            return false;
        }
    }
    
    function cek_angsuran_ke()
    {
        $this->db->select('angsuran_ke')
                  ->from($this->table)
                  ->where('id' . $id);   

        $query = $this->db->get();

        if ($query->num_rows() > 0)
        {
            $data = $query->row_array();
            return $data;
        }
    }

    /*function cek_info_customer($no_faktur)
    {
        $this->db->select('tc.nama, tpm.total, tpb.angsuran_ke');
        $this->db->from('tpemesanan tpm');
        $this->db->join('tcustomer tc', 'tpm.customer_id = tc.id', 'inner');
        $this->db->join('tpembayaran tpb', 'tpm.customer_id = tpb.customer_id', 'left');
        $this->db->where('tpm.no_faktur = "' . $no_faktur . '"');

        $query = $this->db->get();

        if ($query->num_rows() > 0)
        {
            $data       = $query->row_array();
            $row_counts = $query->num_rows();

            $angsuran_ke =  $data['angsuran_ke'];

            if ($angsuran_ke < 1) {
                $angsuran_ke = 1;
            } elseif ($angsuran_ke > 0 && $angsuran_ke < 3) {
                $angsuran_ke = $angsuran_ke + 1;
            }

            $data['angsuran_ke'] = $angsuran_ke;

            $data = json_encode($data);
            return $data;

        }
    }  */

    function cek_info_customer($no_faktur)
    {
        $this->db->select('tc.nama, tpm.id as pemesanan_id, tpm.customer_id, tpm.total, sum(tpb.pembayaran) as total_pembayaran, max(tpb.angsuran_ke) as angsuran_ke');
        $this->db->from('tpemesanan tpm');
        $this->db->join('tcustomer tc', 'tpm.customer_id = tc.id', 'inner');
        $this->db->join('tpembayaran tpb', 'tpm.customer_id = tpb.customer_id', 'left');
        $this->db->where('tpm.no_faktur = "' . $no_faktur . '"');
        $this->db->order_by('tpb.id', 'desc');

        $query = $this->db->get();
        $number_of_rows = $query->num_rows();

        // echo "<pre>";
        // print_r($this->db->last_query());
        // echo "</pre>";

        if ($number_of_rows > 0)
        {
            $data       = $query->row_array();
            $row_counts = $query->num_rows();

            // if ($number_of_rows < 1) {
            //     $data['angsuran_ke'] = 1;
            // } elseif ($number_of_rows > 0 && $number_of_rows < 3) {
            //     $data['angsuran_ke'] = $data['angsuran_ke'] + 1;
            // }

            $data['angsuran_ke'] = $data['angsuran_ke'] + 1;
            $data['sisa_bayar']  = $data['total'] - $data['total_pembayaran'];

            $data = json_encode($data);
            return $data;

        }
    }  
}

/* End of file  */
/* Location: ./application/models/ */