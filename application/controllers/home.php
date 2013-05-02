<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->model('index_query');
	}
	public function index()
	{
		$items = $this->index_query->post_list();
		$cloudtag = $this->index_query->cloud_tag();
		$this->load->view('include/header',array('items'=>$items,'cloudtag'=>$cloudtag));
		$this->load->view('home');
		$this->load->view('include/footer');
	}
}
