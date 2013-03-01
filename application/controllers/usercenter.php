<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Usercenter extends CI_Controller {

	function __construct(){
		parent::__construct();
	}
	public function index()
	{
		if($this->session->userdata('log_in')==true){
			$this->load->view('include/header');
			$this->load->view('usercenter/index');
			$this->load->view('include/footer');
		}else{
			redirect('sign/signin');
		}
		
	}
}
