<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Allbrand extends CI_Controller{
	function __construct(){
		parent::__construct();
		$this->load->model('allbrand_model');
	}
	function index(){
		$cat = $this->allbrand_model->cat_query();
		$arr = array();
		foreach ($cat as $row) {
			$id = $row->id;
			$brand = $this->allbrand_model->brand_list($id);
			$arr[$id]=$brand;
		}
		$this->load->view('include/header',array('cates'=>$cat,'brand'=>$arr));
		$this->load->view('allbrand');
		$this->load->view('include/footer');
	}
}