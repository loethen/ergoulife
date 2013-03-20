<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->model('index_query');
	}
	public function index()
	{
		$res = $this->index_query->cat_query();
		$arr = array();
		foreach ($res as $row) {
			$id = $row->id;
			$brand = $this->index_query->brand_list($id);
			$arr[$id]=$brand;
		}
		$this->load->view('include/header',array('cates'=>$res,'brand'=>$arr));
		$this->load->view('home');
		$this->load->view('include/footer');
	}
}
