<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Sign extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->helper('url');
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
				$password = md5($password.'imergou007');
				$row = $query->row();
				if($row->password === $password){
					$uid = $row->uid;
					$email = $row->email;
					$arr = explode('@', $email);
					$ergousess = array(
							'username' => $arr[0],
							'email' => $email,
							'log_in' => true 
						);
					$this->session->set_userdata($ergousess);
					redirect('home');
				}else{
					echo "登录失败";
				}
			}else{
				echo "登录失败";
			}
		}
		
	}
}
