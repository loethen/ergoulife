<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Rate extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->model('rate_model');
	}
	public function update_rate()
	{

		$id = $this->input->post('id');
		$score = $this->input->post('score');
		$uid = $this->session->userdata('uid');
		if(is_numeric($score)===false || is_numeric($id)===false){
			show_error('数据错误');
			exit;
		};
		$res = $this->rate_model->upd_rate($id,$score);
		$query = $this->rate_model->upd_user_brand($uid,$id,$score);
		if($query==='FALSE'){
			show_error('未能更新评分');
		}
		if($res){
			$this->output
    		->set_content_type('application/json')
    		->set_output(json_encode(array('success' => true)));
		}
	}
}
