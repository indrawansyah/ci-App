<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mahasiswa extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Mahasiswa_model');

	}


	public function index()
	{
		$data['judul'] = 'Daftar Mahasiswa';
		$data['mahasiswa'] = $this->Mahasiswa_model->getAllMahasiswa();

		$this->load->view('templates/header', $data);
		$this->load->view('mahasiswa/index', $data);
		$this->load->view('templates/footer', $data);
	}


	public function tambah()
	{

		$this->load->library('form_validation');
		$this->load->model('Mahasiswa_model');

		$this->form_validation->set_rules('nama', 'Nama', 'required| min_length[3]');

		if($this->form_validation->run() === false) {

			$this->load->view('mahasiswa/tambah');
		} else {
			$data = [
			'nama' => $this->input->post('nama'),
			'nrp' => $this->input->post('nrp'),
			'email' => $this->input->post('email'),
			'jurusan' => $this->input->post('jurusan')
		];

		$this->db->insert('mahasiswa', $data);
		redirect('mahasiswa/index');

		}

	}
}

