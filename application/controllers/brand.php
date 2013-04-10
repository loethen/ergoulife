<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Brand extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->model('brand_model');	
	}
	public function index(){
		$id = $this->uri->segment(2);
		$uid = $this->session->userdata('uid');
		$brand = $this->brand_model->brand_query($id);
		$posts = $this->brand_model->posts_query($id);
		$is_focus = $this->brand_model->is_subscribe($uid,$id);
		$this->load->view('include/header',array('brand'=>$brand,'posts'=>$posts,'is_focus'=>$is_focus));
		$this->load->view('brand');
		$this->load->view('include/footer');
	}
	public function subscribe(){
		$flag = $_POST['flag'];
		$bid = $_POST['id'];
		$uid = $this->session->userdata('uid');
		if($flag==='focus'){
			echo $this->brand_model->add_subscribe($uid,$bid);
		}elseif($flag==='unfocus'){
			echo $this->brand_model->cancel_subscribe($uid,$bid);
		}
	}
	public function mybrands(){
		$uid = $this->session->userdata('uid');
	}
}
