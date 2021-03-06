<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_paket_wisata extends CI_Model {

    public $table = "tpaket_wisata";

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    function get() 
    {   

        $this->db->select('tpw.id, tpw.judul_wisata, tkt.nama_kategori, tpw.jumlah_hari, tpw.tgl_keberangkatan, tpw.tgl_kembali, tpw.harga, tpw.status')
                  ->from('tpaket_wisata AS tpw, tkategori AS tkt')
                  ->where('tpw.kategori_id = tkt.id');

        $query = $this->db->get();

        if ($query->num_rows() > 0)
        {
            $data       = $query->result_array();
            $row_counts = $query->num_rows();

            for ($i = 0; $i < $row_counts; $i++) {
                $number   = $i + 1;
                $no       = array('no' => $number);
                $detail   = array('detail' => "<a href='" . base_url() . "admin/paket_wisata/view/" . $data[$i]['id'] . "'>View</a>");
                $data[$i] = $no + $data[$i]; 
                $data[$i] = $data[$i] + $detail; 
            }

        } else {
            $data                      = array();
            $data['no']                = "";
            $data['id']                = "";
            $data['judul_wisata']      = "";
            $data['nama_kategori']     = "";
            $data['jumlah_hari']       = "";
            $data['tgl_keberangkatan'] = "";
            $data['tgl_kembali']       = "";
            $data['harga']             = "";
            $data['detail']            = "";
            $data['status']            = "";
        }

        $data = array("data" => $data);
        $data = json_encode($data);

        return $data;
    }

    function cek_paket_wisata($id = null)
    {
        $this->db->select('id, judul_wisata');
        $this->db->from($this->table);

        if ($id != null) {
            $this->db->where('id = ' . $id);
        }

        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    function get_list_paket_wisata()
    {
        $kategori_id = $this->input->get('kategori_id');

        $this->db->select('id, judul_wisata');
        $this->db->from($this->table);
        $this->db->where('kategori_id = ' . $kategori_id);

        $query = $this->db->get();
        $data  = $query->result_array();
        $data  = json_encode($data);
        
        return $data;
    }

    function get_paket_wisata($kategori_id)
    {
        $this->db->select('id, judul_wisata, jumlah_hari, tgl_keberangkatan, tgl_kembali, harga, deskripsi, gambar');
        $this->db->from($this->table);
        $this->db->where('kategori_id = ' . $kategori_id);
        $this->db->limit(8);

        $query = $this->db->get();
        $data  = $query->result_array();
        
        $jumlah_array = count($data);

        for ($i = 0; $i < $jumlah_array; $i++) { 

            $deskripsi = $data[$i]['deskripsi'];
            $deskripsi = strip_tags($deskripsi);

            if (strlen($deskripsi) > 200) {

                // truncate deskripsi
                $deskripsiCut = substr($deskripsi, 0, 200);

                // make sure it ends in a word so assassinate doesn't become ass...
                $deskripsi = substr($deskripsiCut, 0, strrpos($deskripsiCut, ' ')).'...'; 
            }

            $data[$i]['deskripsi'] = $deskripsi;
            $data[$i]['detail'] = "<a href='" . base_url() . "admin/tour/detail/" . $data[$i]['id'] . "' class='btn btn-primary' role='button'>Selengkapnya</a>";
        }

        return $data;
    }

    function detail($id)
    {
        $this->db->select('tpw.id, tpw.judul_wisata, tkt.id as kategori_id, tkt.nama_kategori, tpw.jumlah_hari, tpw.tgl_keberangkatan, tpw.tgl_kembali, tpw.harga, tpw.deskripsi, tpw.gambar, tpw.status')
                  ->from('tpaket_wisata AS tpw, tkategori AS tkt')
                  ->where('tpw.kategori_id = tkt.id')
                  ->where('tpw.id = ' . $id);

        $query = $this->db->get();

        if ($query->num_rows() > 0)
        {
            $data = $query->row_array();
            return $data;
        }
    }

    function save($gambar)
    {
        $id                = $this->input->post('id');
        $judul_wisata      = $this->input->post('judul_wisata');
        $kategori          = $this->input->post('kategori');
        $jumlah_hari       = $this->input->post('jumlah_hari');
        $tgl_keberangkatan = $this->input->post('tgl_keberangkatan');
        $tgl_kembali       = $this->input->post('tgl_kembali');
        $harga             = $this->input->post('harga');
        $deskripsi         = $this->input->post('deskripsi');
        $status         = $this->input->post('status');
        
        $data = array(
            'judul_wisata'      => $judul_wisata,
            'kategori_id'       => $kategori,
            'jumlah_hari'       => $jumlah_hari,
            'tgl_keberangkatan' => $tgl_keberangkatan,
            'tgl_kembali'       => $tgl_kembali,
            'harga'             => $harga,
            'deskripsi'         => $deskripsi,
            'status'            => $status
        );


        if ($id == null) {
            $data['gambar'] = $gambar;
            $result = $this->db->insert($this->table, $data);
        } else {
            if ($gambar != null) {
                $data['gambar'] = $gambar;
            }
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

    function get_image_name($id)
    {
        $this->db->select('gambar');
        $this->db->from($this->table);
        $this->db->where('id', $id);

        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            $image_name = $query->row_array();
            $image_name = $image_name['gambar'];
            return $image_name;
        }
    }
    
}

/* End of file  */
/* Location: ./application/models/ */