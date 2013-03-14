<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Subject extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->helper('form');
		$this->load->model('subject_query');
		$this->load->model('rate_model');
	}
	public function index(){
		$id = $this->uri->segment(2);
		$uid = $this->session->userdata('uid');

		$brand = $this->subject_query->subject_query($id);
		$rate = $this->subject_query->rate_query($id);
		$init_rate = $this->rate_model->have_rate($uid,$id);

		$this->load->view('include/header',array('brand'=>$brand,'rate'=>$rate,'init_rate'=>$init_rate));
		$this->load->view('subject');
		$this->load->view('include/footer');
	}
}
