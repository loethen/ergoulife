<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {

	public function index()
	{
		$this->load->helper('url');
		$this->load->view('include/header');
		$this->load->view('home');
		$this->load->view('include/footer');
	}
}
