<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Peoples extends CI_Controller {

	public function index()
	{
        $data['judul'] = 'List of Peoples';
        
		$this->load->view('templates/header', $data);
		$this->load->view('peoples/index', $data);
		$this->load->view('templates/footer', $data);
	}


	
}

