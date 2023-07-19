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


            // Catat penggunaan memori sebelum eksekusi
            $start_memory = memory_get_usage();

            /* 
            melemparkan data dari database ke dalam view layout/card yang
            terdapat di halaman views/admin/layout/card.php
            */
            $data['petugas'] = $this->db->get('petugas')->num_rows();
            $data['kandidat'] = $this->db->get('kandidat')->num_rows();
            $data['pemilih'] = $this->db->get('pemilih')->num_rows();
            $data['pilih'] = $this->db->get('pilih')->num_rows();
            $data['kndt'] = $this->db->get('kandidat')->result();

            // Catat penggunaan memori setelah eksekusi
            $end_memory = memory_get_usage();

            // Hitung penggunaan memori dalam bytes
            $memory_usage = $end_memory - $start_memory;

            // Menambahkan data penggunaan memori ke variabel $data
            $data['memory_usage'] = $memory_usage;

            // menampilkan halaman index di views/admin/index.php
            $this->load->view('admin/index', $data);
        }
    }
}
