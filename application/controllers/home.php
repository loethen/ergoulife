<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->model('home_query');
	}
	public function index()
	{
		$brand = $this->home_query->brand_list();
		$arr = array('brand'=>$brand);
		$this->load->view('include/header',$arr);
		$this->load->view('home');
		$this->load->view('include/footer');
	}
}
