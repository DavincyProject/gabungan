<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Utama extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
    }
    public function index()
    {
        if ($this->session->userdata('status') != 'login') {
            redirect('admin/masuk');
        } else {

            /* 
            melemparkan data dari database ke dalam view layout/card yang
            terdapat di halaman views/admin/layout/card.php
            */
            $data['petugas'] = $this->db->get('petugas')->num_rows();
            $data['kandidat'] = $this->db->get('kandidat')->num_rows();
            $data['pemilih'] = $this->db->get('pemilih')->num_rows();
            $data['pilih'] = $this->db->get('pilih')->num_rows();
            $data['kndt'] = $this->db->get('kandidat')->result();

            // menampilkan halaman index di views/admin/index.php
            $this->load->view('admin/index', $data);
        }
    }
}
