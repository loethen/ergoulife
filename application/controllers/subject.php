<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Subject extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->model('subject_model');	
	}
	public function index(){
		$id = $this->uri->segment(2);
		$post = $this->subject_model->subject_query($id);
		$brand = $this->subject_model->brand_query($post->relate_brand);
		
		$this->load->view('include/header',array('post'=>$post,'brand'=>$brand));
		$this->load->view('subject');
		$this->load->view('include/footer');
	}
	
}
