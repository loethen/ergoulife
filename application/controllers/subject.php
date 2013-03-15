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

		$brand = $this->subject_query->subject_query($id);
		$rate = $this->rate_model->rate_query($id);
		$init_rate = $this->rate_model->have_rate($uid,$id);

		$comment = $this->comment_model->show_comment($id);
		$this->load->view('include/header',array('brand'=>$brand,'rate'=>$rate,'init_rate'=>$init_rate,'comment'=>$comment));
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
