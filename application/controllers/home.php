<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->model('index_query');
	}
	public function index()
	{
		$items = $this->index_query->post_list();
		$arr = array();
		foreach ($items as $item) {
			$post_id = $item->id;
			$res = $this->index_query->tag_list($post_id);
			$arr[$post_id] = $res;
		}
		$this->load->view('include/header',array('items'=>$items,'tags'=>$arr));
		$this->load->view('home');
		$this->load->view('include/footer');
	}
}
