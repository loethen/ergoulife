<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Subject extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->model('subject_model');	
	}
	public function index(){
		$id = $this->uri->segment(2);

		$post = $this->subject_model->subject_query($id);

		$this->load->view('include/header',array('post'=>$post));
		$this->load->view('subject');
		$this->load->view('include/footer');
	}
}
