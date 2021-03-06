<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Rate extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->model('rate_model');
	}
	public function update_rate()
	{
		$bid = $this->input->post('id');
		$score = $this->input->post('score');
		$uid = $this->session->userdata('uid');
		if(is_numeric($score)===false || is_numeric($bid)===false){
			show_error('数据错误');
			exit;
		};

		$this->rate_model->upd_rate($uid,$bid,$score);
		
		$this->output
    		->set_content_type('application/json')
    		->set_output(json_encode(array('success' => true)));
	}
}
