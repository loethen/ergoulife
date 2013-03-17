<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Subject extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->helper('form');
		$this->load->model('subject_query');
		$this->load->model('rate_model');
		$this->load->model('comment_model');		
	}
	public function index(){
		$id = $this->uri->segment(2);
		$uid = $this->session->userdata('uid');
		$arr = array();

		$rate = $this->rate_model->rate_query($id);
		$init_rate = $this->rate_model->have_rate($uid,$id);
		$comment = $this->comment_model->show_comment($id);
		$brand = $this->subject_query->subject_query($id);
		if($this->subject_query->is_brand($id)){
			$owner = $this->subject_query->owner_query($id);  //products in brand
			$arr = array('brand'=>$brand,
						 'owner'=>$owner,
						 'rate'=>$rate,
						 'init_rate'=>$init_rate,
						 'comment'=>$comment
						 );
		}else{
			$inowner = $this->subject_query->subject_query($brand->owner); //brandname for this product
			$brandname = $inowner->cnname;
			$brandid = $inowner->id;
			$arr = array('brand'=>$brand,
						 'brandname'=>array($brandname,$brandid),
						 'rate'=>$rate,
						 'init_rate'=>$init_rate,
						 'comment'=>$comment
						 );
		}

		$this->load->view('include/header',$arr);
		$this->load->view('subject');
		$this->load->view('include/footer');
	}

	public function comment(){
		$this->load->library('form_validation');

		$uid = $this->session->userdata('uid');
		$username = $this->session->userdata('username');
		$sid = $this->input->post('sid');
		$content = $this->input->post('comment-content',true);
		$content = quotes_to_entities($content);

		$query = $this->comment_model->add_comment('',$sid,$uid,$username,$content);
		if($query){
			redirect("subject/".$sid."#last");
		}else{
			show_error('插入评论出错');
		}
	}
}
