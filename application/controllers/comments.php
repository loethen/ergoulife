<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Comments extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->uid = $this->session->userdata('uid');
		$this->load->model('comments_model');
	}
	public function do_comment(){
		$data = $this->input->post(NULL, TRUE);
		if(empty($data['replyid'])){
			$query = $this->comments_model->add_comment('',$data['pid'],$this->uid,$data['content']);
		}
		if($query){
			$this->comments_model->updateCount($data['pid']);
		}
	}
	public function show_comment(){
		$pid = $this->input->post('pid',true);
		$res = $this->comments_model->show_comment($pid);
		echo json_encode($res);
	}
}