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

            // melempar ke halaman login jika status belum login berdasarkan sessionnya
            redirect('masuk');
        } else {
            $data['kandidat'] = $this->db->get('kandidat')->result();

            // melempar ke halaman utama di folder view utama.php jika sudah login
            $this->load->view('utama', $data);
        }
    }

    public function pilih()
    {
        /* 
        validasi terlebih dahulu apakah id_pemilih sudah melakukan pemilihan, dan 
        mengecek apakah lebih besar dari 1.
        jika sudah melakukan pemilihan, akan diberikan pesan error anda telah selesai melakukan pemilihan.
        dan dilemparkan kembali ke halaman utama

        jika belum melakukan pemilihan, akan dibawa ke halaman pemilihan
        */
        $pemilih = $this->session->userdata('id_pemilih');
        $cek = $this->db->get_where('pilih', array('id_pemilih' => $pemilih));
        $banyak = $cek->num_rows();

        if ($banyak >= 1) {
            $this->session->set_flashdata('error', 'Anda Hanya bisa melakukan pemilihan sekali');
            redirect('utama');
        } else {
            $data['kandidat'] = $this->db->get('kandidat')->result();

            //melempar ke halaman views/pilih/index.php
            $this->load->view('pilih/index', $data);
        }
    }

    public function simpan($id)
    {
        date_default_timezone_set('Asia/Jakarta');
        $tgl = date('Y-m-d H:i:s');
        $pemilih = $this->session->userdata('id_pemilih');

        $data = array(
            'id_kandidat' => $id,
            'id_pemilih' => $pemilih,
            'tgl_rekam' => $tgl,
        );

        $this->db->insert('pilih', $data);
        $this->session->set_flashdata('success', 'Anda telah Selesai Melakukan Pemilihan, Terimakasih telah berpartisipasi');

        // melempar ke halaman utama di view dengan nama utama.php
        redirect('utama');
    }
}
