<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pemilih extends CI_Controller
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
            $data['pemilih'] = $this->db->get('pemilih')->result();
            $this->load->view('admin/pemilih/index', $data);
        }
    }

    public function tambah()
    {
        $this->load->view('admin/pemilih/tambah');
    }

    public function simpan()
    {
        $nama = $this->input->post('nama');
        $kelamin = $this->input->post('kelamin');
        $username = $this->input->post('username');
        $password = md5($this->input->post('password'));

        $data = [
            'nama_pemilih' => $nama,
            'jenis_kelamin' => $kelamin,
            'username' => $username,
            'password' => $password,
        ];

        $this->db->insert('pemilih', $data);
        $this->session->set_flashdata('success', 'Berhasil disimpan');
        redirect('admin/pemilih');
    }

    public function ubah($id)
    {
        $data['cari'] = $this->db->get_where('pemilih', array('id_pemilih' => $id))->result();
        $this->load->view('admin/pemilih/ubah', $data);
    }

    public function simpanUbah()
    {
        $nama = $this->input->post('nama');
        $kelamin = $this->input->post('kelamin');
        $username = $this->input->post('username');
        $password = md5($this->input->post('password'));
        $id = $this->input->post('kode');

        if ($password == "") {
            $data = [
                'nama_pemilih' => $nama,
                'jenis_kelamin' => $kelamin,
                'username' => $username
            ];
        } else {
            $data = [
                'nama_pemilih' => $nama,
                'jenis_kelamin' => $kelamin,
                'username' => $username,
                'password' => $password,
            ];
        }

        $this->db->where('id_pemilih', $id);
        $this->db->update('pemilih', $data);
        $this->session->set_flashdata('success', "Data berhasil diubah");
        redirect('admin/pemilih');
    }


    public function hapus($id)
    {
        $this->db->where(array('id_pemilih' => $id));
        $this->db->delete('pemilih');

        $this->session->set_flashdata('success', "Data berhasil dihapus");
        redirect('admin/pemilih');
    }
}
