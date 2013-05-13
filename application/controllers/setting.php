<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Setting extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->model('user');
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
		$query = $this->user->user_info($uid);
		$active = $this->user->is_active($uid);
		$this->load->view('include/header',array('res'=>$query->row(),'active'=>$active));
		$this->load->view('usercenter/normal_user');
		$this->load->view('include/footer');
	}
	public function user_avatar(){
		$uid = $this->session->userdata('uid');
		$avatar = $_POST['filename'];
		$res = $this->user->update_avatar($avatar,$uid);
		if($res){
			echo json_encode(array('state'=>true));
		}
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
			$query = $this->user->user_info($uid);
			if($query->num_rows()>0){
				$row = $query->row();
				print(md5($oldpw.'imergou007'));
				if(md5($oldpw.'imergou007')===$row->password){
					$pw = md5($this->input->post('newpw').'imergou007');
					$query = $this->user->update_pw($pw,$uid);
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
		  $this->form_validation->set_rules('name','用户名','required');
		  if($this->form_validation->run()==false){
		  		self::user_set();
		  }else{
		  		$profile = $this->input->post('profile',true);
		  		$name = $this->input->post('name',true);
		  		$uid = $this->session->userdata('uid');
		  		$query = $this->user->update_profile($name,$profile,$uid);
		  		if($query){
		  			$query = $this->user->user_info($uid);
					$this->load->view('include/header',array('res'=>$query->row(),'success'=>'个人信息更新成功'));
					$this->load->view('usercenter/normal_user');
					$this->load->view('include/footer');
				}else{
					show_error('服务器错误，请重试');
				}
		  }
	}
	public function active_email(){
		$name = $this->session->userdata('username');
		$email = $this->session->userdata('email');
		$this->load->library('encrypt');
		$token = $this->encrypt->encode($email);
		$token = urlencode($token);
		$this->load->library('email');
		$this->email->from('im@ergoulife.com', 'ergou');
		$this->email->to($email); 
		$this->email->subject('激活你在ergoulife的邮件账户');

		$url = site_url('setting/active/'.$token);
		$html = "hi,'$name'<br>这是一封来自ergoulife.com的激活邮件<br>请点击以下链接完成激活<br>"."<a href='$url'>".$url."</a><br>二狗团队敬上";
		$this->email->message($html); 
		$this->email->send();

		echo 'success';
	}
	public function active(){
		if($this->session->userdata('log_in')){
			$encrypt = urldecode($this->uri->segment(3));
			$this->load->library('encrypt');
			$email = $this->encrypt->decode($encrypt);
			$user = $this->user->get_user($email);
			if($user->id = $this->session->userdata('uid')){
				$result = $this->user->add_user_meta($user->id,'active','true');
			}else{
				show_error('激活不成功');
			}
		}
		if($result){
			self::index();
		}else{
			$this->load->view('include/header',array('message'=>'激活失败'));
			$this->load->view('notice');
			$this->load->view('include/footer');
		}
	}
}
