<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Subject extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->model('subject_model');
		$this->load->model('comments_model');	
	}
	public function index(){
		$id = $this->uri->segment(2);
		$post = $this->subject_model->subject_query($id);
		$brand = $this->subject_model->brand_query($post->relate_brand);
		$comments = $this->comments_model->show_comment($id);
		$this->load->view('include/header',array('post'=>$post,'brand'=>$brand,'comments'=>$comments));
		$this->load->view('subject');
		$this->load->view('include/footer');
	}
	
}
