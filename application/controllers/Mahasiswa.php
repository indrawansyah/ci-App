<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mahasiswa extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Mahasiswa_model');
		
		$this->load->library('form_validation');

	}


	public function index()
	{
		$data['judul'] = 'Daftar Mahasiswa';
		$data['mahasiswa'] = $this->Mahasiswa_model->getAllMahasiswa();
		if ( $this->input->post('keyword') ){
			$data['mahasiswa'] = $this->Mahasiswa_model->cariDataMahasiswa();
		}
		$this->load->view('templates/header', $data);
		$this->load->view('mahasiswa/index', $data);
		$this->load->view('templates/footer', $data);
	}


	public function tambah()
	{

		$this->load->library('form_validation');
		$this->load->model('Mahasiswa_model');
	

		$this->form_validation->set_rules('nama', 'Nama', 'required');
		$this->form_validation->set_rules('nrp', 'NRP', 'required');
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email');

		if($this->form_validation->run() == FALSE) {
			$this->load->view('templates/header');
			$this->load->view('mahasiswa/tambah');
			$this->load->view('templates/footer');
		} else {
			
		// 	$data = [
		// 	'nama' => $this->input->post('nama'),
		// 	'nrp' => $this->input->post('nrp'),
		// 	'email' => $this->input->post('email'),
		// 	'jurusan' => $this->input->post('jurusan')
		// ];

		// $this->db->insert('mahasiswa', $data);
		$this->Mahasiswa_model->tambahDataMahasiswa();
		$this->session->set_flashdata('flash', 'Ditambahkan');
		redirect('mahasiswa');

		}
	}

	public function hapus($id)
	{
		$this->Mahasiswa_model->hapusDataMahasiswa($id);
		$this->session->set_flashdata('flash', 'Dihapus');
		redirect('mahasiswa');
	}

	public function detail($id)
	{
		$data['judul'] = 'Detail Data Mahasiswa';
		$data['mahasiswa'] = $this->Mahasiswa_model->getMahasiswaById($id);
		$this->load->view('templates/header', $data);
		$this->load->view('mahasiswa/detail' );
		$this->load->view('templates/footer');
	}


	public function ubah($id)
	{

		$data['judul'] = 'Form Ubah Data Mahasiswa';
		$data['mahasiswa'] = $this->Mahasiswa_model->getMahasiswaById($id);
		$data['jurusan'] = ['Teknik Informatika', 'Teknik Mesin', 'Teknik Planologi', 'Teknik Pangan', 'Teknik Lingkungan'];
	

		$this->form_validation->set_rules('nama', 'Nama', 'required');
		$this->form_validation->set_rules('nrp', 'NRP', 'required');
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email');

		if($this->form_validation->run() == false) {
			$this->load->view('templates/header', $data);
			$this->load->view('mahasiswa/ubah', $data);
			$this->load->view('templates/footer');
		} else {

		$this->Mahasiswa_model->ubahDataMahasiswa();
		$this->session->set_flashdata('flash', 'Diubah');
		redirect('mahasiswa');

		}
	}
}

