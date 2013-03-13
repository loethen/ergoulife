<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Sign extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->library('form_validation');
	}
	public function signup_form()
	{
		$this->load->view('include/header');
		$this->load->view('sign/signup');
		$this->load->view('include/footer');
	}

	public function signin_form(){
		$this->load->view('include/header');
		$this->load->view('sign/signin');
		$this->load->view('include/footer');
	}
	public function signup(){
		$this->load->database();
		$this->form_validation->set_rules('email','Email','trim|required|valid_emai|is_unique[user.email]');
		$this->form_validation->set_rules('password','密码','trim|required|matches[repassword]');
		$this->form_validation->set_rules('repassword','确认密码','required');
		if($this->form_validation->run()==FALSE){
			self::signup_form();
		}else{
			$email = $this->input->post('email');
			$password = md5($this->input->post('password').'imergou007');
			$this->load->model('user');
			$this->user->user_insert($email,$password);
			$this->load->view('include/header');
			$this->load->view('notice',array('message'=>'welcome<br />恭喜你注册成功，快去登录吧！'));
			$this->load->view('include/footer');
		}
	}
	public function signin(){
		$this->form_validation->set_rules('email','Email','trim|required|valid_email');
		$this->form_validation->set_rules('password','密码','trim|required');
		if($this->form_validation->run()==false){
			self::signin_form();
		}else{
			$email = $this->input->post('email',true);
			$password = $this->input->post('password',true);
			$this->load->model('user');
			$query = $this->user->login($email,$password);
			if($query->num_rows()>0){
				$key = "imergou007";
				$password = md5($password.$key);
				$row = $query->row();
				if($row->password === $password){
					$uid = $row->uid;
					$email = $row->email;
					$arr = explode('@', $email);
					$ergousess = array(
							'username' => $arr[0],
							'email' => $email,
							'uid' => $uid,
							'log_in' => true 
						);
					$this->session->set_userdata($ergousess);


					// 友言登陆
					$uname = $arr[0];
					$uface = "http://v2.uyan.cc/code/images/duface.png";
					$ulink = "ergoulife.com";
					$expire = "3600";

					$desstr = file_get_contents("http://api.uyan.cc?mode=des&uid=$uid&uname=".urlencode($uname)."&email=".urlencode($email)."&uface=".urlencode($uface)."&ulink=".urlencode($ulink)."&expire=$expire&key=".urlencode($key));

					setcookie('syncuyan', $desstr, time() + 3600, '/', 'ergoulife.com'); 
					// 友言登陆结束

					if($uid == 1){
						$this->session->set_userdata('admin',true);
					}
					$cur_url=$this->input->post('cur_url',true);
					if(!empty($cur_url)){
						redirect($cur_url);
					}
					redirect('home');
				}else{
					$this->load->view('include/header',array('error'=>'密码错误，请重试'));
					$this->load->view('sign/signin');
					$this->load->view('include/footer');
				}
			}else{
				$this->load->view('include/header',array('error'=>'用户不存在，注册新用户试试吧'));
				$this->load->view('sign/signin');
				$this->load->view('include/footer');
			}
		}
		
	}

	public function logout(){
		$this->session->sess_destroy();
		setcookie('syncuyan', 'logout', time() + 3600, '/', 'ergoulife.com');
		redirect('home');
	}
	public function is_login(){
		$arr = array('is_login'=>$this->session->userdata('log_in'));
		$this->output
    	->set_content_type('application/json')
    	->set_output(json_encode($arr));
	}
	public function quick_sign(){
		$cur_url = $this->input->post('cur_url');
		$this->load->view('sign/quick_signin',array('cur_url'=>$cur_url));
	}
}
