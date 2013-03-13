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
		$this->db->trans_start();
		$res = $this->rate_model->upd_rate($uid,$bid,$score);
		$res1 = $this->rate_model->upd_user_brand($uid,$bid,$score);
		$this->db->trans_complete();
		if ($this->db->trans_status() === FALSE)
		{
		    show_error('更新分数出错');
		}
		if($res===TRUE){
			$this->output
    		->set_content_type('application/json')
    		->set_output(json_encode(array('success' => true)));
		}
	}
}
