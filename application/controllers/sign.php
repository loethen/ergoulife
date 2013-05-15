<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Sign extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->library('form_validation');
	}
	public function signup_form()
	{
		$this->load->view('include/sign-header');
		$this->load->view('sign/signup');
		$this->load->view('include/sign-footer');
	}

	public function signin_form(){
		$this->load->view('include/sign-header');
		$this->load->view('sign/signin');
		$this->load->view('include/sign-footer');
	}
	public function signup(){
		$this->load->database();
		$this->form_validation->set_rules('name','昵称','required');
		$this->form_validation->set_rules('email','邮件地址','trim|required|valid_emai|is_unique[user.email]');
		$this->form_validation->set_rules('password','密码','trim|required');
		if($this->form_validation->run()==FALSE){
			self::signup_form();
		}else{
			$post = $this->input->post(NULL,TRUE);
			$password = md5($post['password'].'imergou007');
			$this->load->model('user');
			$query = $this->user->user_insert($post['name'],$post['email'],$password);
			if($query){
				self::signin($post['email'],$post['password']);
			}
		}
	}
	public function signin($e=null,$p=null){
		$this->form_validation->set_rules('email','Email','trim|required|valid_email');
		$this->form_validation->set_rules('password','密码','trim|required');
		if($this->form_validation->run()==false){
			self::signin_form();
		}else{
			$email = is_null($e) ? $this->input->post('email',true) : $e;
			$password = is_null($p) ? $this->input->post('password',true) : $p;
			$this->load->model('user');
			$query = $this->user->login($email,$password);
			if($query->num_rows()>0){
				$key = "imergou007";
				$password = md5($password.$key);
				$row = $query->row();
				if($row->password === $password){
					$uid = $row->uid;
					$email = $row->email;
					$name = $row->name;
					$ergousess = array(
							'username' => $name,
							'email' => $email,
							'uid' => $uid,
							'log_in' => true 
						);
					$this->session->set_userdata($ergousess);

					if($uid == 1){
						$this->session->set_userdata('admin',true);
					}
					$cur_url=$this->input->post('cur_url',true);
					if(!empty($cur_url)){
						redirect($cur_url);
					}
					$session_url = $this->session->userdata('refurl');
					header('Location:'.$session_url);
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
		redirect('home');
	}
	public function is_login(){
		$arr = array('is_login'=>$this->session->userdata('log_in'));
		$this->output
    	->set_content_type('application/json')
    	->set_output(json_encode($arr));
	}
	public function quick_sign(){
		$cur_url = $_POST['cur_url'];
		$this->load->view('sign/quick_signin',array('cur_url'=>$cur_url));
	}
}
