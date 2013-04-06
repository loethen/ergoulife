<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Brand extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->model('brand_model');	
	}
	public function index(){
		$id = $this->uri->segment(2);
		$uid = $this->session->userdata('uid');
		$arr = array();

		$brand = $this->brand_model->brand_query($id);
		$posts = $this->brand_model->posts_query($id);

		$this->load->view('include/header',array('brand'=>$brand,'posts'=>$posts));
		$this->load->view('brand');
		$this->load->view('include/footer');
	}
}
