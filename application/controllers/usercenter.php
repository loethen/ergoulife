<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Usercenter extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->model('uc');
		$this->load->library('image_lib');
		if(!$this->session->userdata('log_in')){
			redirect('sign/signin');
		}
	}
	public function index(){
		self::user_set();
	}
	public function user_set(){
		$uid = $this->session->userdata('uid');
		$query = $this->uc->user_info($uid);
		$this->load->view('include/header',array('res'=>$query->row()));
		$this->load->view('usercenter/normal_user');
		$this->load->view('include/footer');
	}
	public function setpw(){
		$this->form_validation->set_rules('oldpw','oldpassword','required');
		$this->form_validation->set_rules('newpw','newpassword','required|matches[repw]');
		$this->form_validation->set_rules('repw','repassword','required');
		if($this->form_validation->run()==false){
			self::user_set();
		}else{
			$oldpw = $this->input->post('oldpw');
			$uid = $this->session->userdata('uid');
			$query = $this->uc->user_info($uid);
			if($query->num_rows()>0){
				$row = $query->row();
				print(md5($oldpw.'imergou007'));
				if(md5($oldpw.'imergou007')===$row->password){
					$pw = md5($this->input->post('newpw').'imergou007');
					$query = $this->uc->update_pw($pw,$uid);
					if($query){
						$this->load->view('include/header',array('res'=>$row,'success'=>'密码更新成功'));
						$this->load->view('usercenter/normal_user');
						$this->load->view('include/footer');
					}else{
						show_error('服务器错误，请重试');
					}
				}else{
					$this->load->view('include/header',array('res'=>$row,'error'=>'旧密码不正确'));
					$this->load->view('usercenter/normal_user');
					$this->load->view('include/footer');
				}
			}else{
				show_error('服务器错误，请重试');
			}
		}
	}
	public function set_profile(){
		  $this->form_validation->set_rules('profile','个人签名','required');
		  if($this->form_validation->run()==false){
		  		self::user_set();
		  }else{
		  		$profile = $this->input->post('profile',true);
		  		$uid = $this->session->userdata('uid');
		  		$query = $this->uc->update_profile($profile,$uid);
		  		if($query){
		  			$query = $this->uc->user_info($uid);
					$this->load->view('include/header',array('res'=>$query->row(),'success'=>'个人签名更新成功'));
					$this->load->view('usercenter/normal_user');
					$this->load->view('include/footer');
				}else{
					show_error('服务器错误，请重试');
				}
		  }
	}
}
