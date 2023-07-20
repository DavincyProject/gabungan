<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kandidat extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
    }
    public function index()
    {
        /* 
        melakukan fungsi cek terlebih dahulu dengan mengecek status 
        apakah sudah login atau belum, status login dikirim dari controller masuk.php  
        */

        if ($this->session->userdata('status') != 'login') {
            redirect('admin/masuk');
        } else {
            $data['kandidat'] = $this->db->get('kandidat')->result();
            $this->load->view('admin/kandidat/index', $data);
        }
    }

    public function tambah()
    {
        $this->load->view('admin/kandidat/tambah');
    }

    public function simpan()
    {
        $nama = $this->input->post('nama');
        $nomor = $this->input->post('nomor');
        $config['upload_path'] = './gambar/';
        $config['allowed_types'] = 'jpg|png|jpeg';
        $this->load->library('upload', $config);

        if ($this->upload->do_upload('foto')) {
            $upload = $this->upload->data();
            $data = [
                'nama_kandidat' => $nama,
                'nomor_kandidat' => $nomor,
                'foto_kandidat' => $upload['file_name'],
            ];
            $this->db->insert('kandidat', $data);
            $this->session->set_flashdata('success', "Data berhasil disimpan");

            //mengirim hasil notifikasi sukses ke view admin/kandidat/index.php
            redirect('admin/kandidat');
        } else {
            $this->session->set_flashdata('error', $this->upload->display_errors());

            //mengirim hasil notifikasi error ke view admin/kandidat/index.php
            redirect('admin/kandidat');
        }
    }

    public function ubah($id)
    {
        $data['cari'] = $this->db->get_where('kandidat', array('id_kandidat' => $id))->result();
        $this->load->view('admin/kandidat/ubah', $data);
    }

    public function simpanUbah()
    {
        $nama = $this->input->post('nama');
        $nomor = $this->input->post('nomor');
        $id = $this->input->post('kode');

        // Memeriksa apakah ada file yang diunggah
        if (!empty($_FILES['foto']['name'])) {
            $config['upload_path'] = './gambar/';
            $config['allowed_types'] = 'jpg|png|jpeg';
            $this->load->library('upload', $config);

            if ($this->upload->do_upload('foto')) {
                $upload = $this->upload->data();
                $data = array(
                    'nama_kandidat' => $nama,
                    'nomor_kandidat' => $nomor,
                    'foto_kandidat' => $upload['file_name'],
                );
            } else {
                $this->session->set_flashdata('error', $this->upload->display_errors());
                redirect('admin/kandidat');
            }
        } else {
            $data = array(
                'nama_kandidat' => $nama,
                'nomor_kandidat' => $nomor
            );

            // // Jika foto tidak diunggah, ambil data foto yang sudah ada di database dan tetap gunakan foto tersebut.
            // $existing_data = $this->db->get_where('kandidat', array('id_kandidat' => $id))->row();
            // $data = array(
            //     'nama_kandidat' => $nama,
            //     'nomor_kandidat' => $nomor,
            //     'foto_kandidat' => $existing_data->foto_kandidat, // Tetap gunakan foto yang sudah ada sebelumnya
            // );
        }

        $this->db->where('id_kandidat', $id);
        $this->db->update('kandidat', $data);
        $this->session->set_flashdata('success', "Data berhasil diubah");
        redirect('admin/kandidat');
    }


    public function hapus($id)
    {
        $cari = $this->db->get_where('kandidat', array('id_kandidat' => $id))->result();
        $gambar = $cari[0]->foto_kandidat;
        unlink('./gambar/' . $gambar);

        $this->db->where(array('id_kandidat' => $id));
        $this->db->delete('kandidat');

        $this->session->set_flashdata('success', "Data berhasil dihapus");
        redirect('admin/kandidat');
    }

    public function report()
    {
        if ($this->session->userdata('status') != 'login') {
            redirect('admin/masuk');
        } else {
            $data['kandidat'] = $this->db->get('kandidat')->result();
            $this->load->view('admin/kandidat/report', $data);
        }
    }

    public function cetak()
    {
        $data['kandidat'] = $this->db->get('kandidat')->result();
        $this->load->view('admin/kandidat/cetak', $data);
    }

    public function suara()
    {
        if ($this->session->userdata('status') != 'login') {
            redirect('admin/masuk');
        } else {
            $data['pilih'] = $this->db->get('pilih')->num_rows();
            $data['kandidat'] = $this->db->get('kandidat')->result();
            $this->load->view('admin/kandidat/suara', $data);
        }
    }

    public function cetakSuara()
    {
        $data['pilih'] = $this->db->get('pilih')->num_rows();
        $data['kandidat'] = $this->db->get('kandidat')->result();
        $this->load->view('admin/kandidat/cetaksuara', $data);
    }
}
