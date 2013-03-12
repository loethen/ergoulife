<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Subject extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->model('subject_query');
	}
	public function index(){
		$id = $this->uri->segment(2);
		$brand = $this->subject_query->subject_query($id);
		$rate = $this->subject_query->rate_query($id);
		$this->load->view('include/header',array('brand'=>$brand,'rate'=>$rate));
		$this->load->view('subject');
		$this->load->view('include/footer');
	}
}
