<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Comments extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->uid = $this->session->userdata('uid');
		$this->load->model('comments_model');
	}
	public function do_comment(){
		$data = $this->input->post(NULL, TRUE);
		if(IS_AJAX){
			if(empty($data['replyid'])){
				$query = $this->comments_model->add_comment('',$data['pid'],$this->uid,$data['content']);
			}
			if($query){
				$this->comments_model->updateCount($data['pid']);
			}	
		}else{
			$uid = $this->session->userdata('uid');
			if(empty($data['replyid'])){
				$query = $this->comments_model->add_comment('',$data['id'],$uid,$data['content']);
			}
			if($query){
				redirect('subject/'.$data['id'].'#talk');
			}
		}
	}
	public function show_comment($pid = null){
		$pid = is_null($pid) ? $this->input->post('pid',true) : $pid;
		$res = $this->comments_model->show_comment($pid);
		if(IS_AJAX){
			echo json_encode($res);
		}else{
			return $res;
		}
	}
}