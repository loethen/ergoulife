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
		if($this->session->userdata('admin')==true){
			self::brand_page();
		}else{
			self::user_set();
		}
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
						$this->load->view('include/header',array('res'=>$res,'success'=>'密码更新成功'));
						$this->load->view('usercenter/normal_user');
						$this->load->view('include/footer');
					}else{
						show_error('服务器错误，请重试');
					}
				}else{
					$this->load->view('include/header',array('res'=>$query->row(),'error'=>'旧密码不正确'));
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
					$this->load->view('include/header',array('res'=>$res,'success'=>'个人签名更新成功'));
					$this->load->view('usercenter/normal_user');
					$this->load->view('include/footer');
				}else{
					show_error('服务器错误，请重试');
				}
		  }
	}
	public function brand_page(){
		$res = $this->uc->cate_query();
		$this->load->view('include/header',array('res'=>$res));
		$this->load->view('usercenter/top_menu');
		$this->load->view('usercenter/index');
		$this->load->view('include/footer');
	}
	public function add_brand(){
		$this->form_validation->set_rules('cnbrand','品牌名称','required|is_unique[brand.cnname]');
		$this->form_validation->set_rules('area','产地','required');
		$this->form_validation->set_rules('description','品牌描述','required');
		if($this->form_validation->run()==false){
			self::index();
		}else{
			$cnname = $this->input->post('cnbrand',true);
			$catid = $this->input->post('category',true);
			$img = $this->input->post('path',true);
			$area = $this->input->post('area',true);
			$desc = $this->input->post('description',true);

			$this->load->helper('string');
			$desc = quotes_to_entities($desc);
			$result = $this->uc->brand_insert($cnname,$img,$area,$desc,'',$catid);
			redirect('usercenter');
		}
	}
	public function manage_brand($page=0){
		$url = site_url();
		$per_page = 10;
		$page_nums = $this->uc->brand_num();
		$page_output = null;
		if($page_nums>1){
			$this->load->library('pagination');
			$config['base_url'] = $url.'/usercenter/manage_brand/';
			$config['total_rows'] = $page_nums;
			$config['per_page'] = 10; 
			$config['full_tag_open'] = "<ul>";
			$config['full_tag_close'] = "</ul>";
			$config['prev_tag_open'] = '<li>';
			$config['prev_tag_close'] = '</li>';
			$config['next_tag_open'] = '<li>';
			$config['next_tag_close'] = '</li>';
			$config['cur_tag_open'] = '<li class="disabled"><a>';
			$config['cur_tag_close'] = '</a></li>';
			$config['num_tag_open'] = '<li>';
			$config['num_tag_close'] = '</li>';
			$per_page = $config['per_page'];
			$this->pagination->initialize($config);
			$page_output = $this->pagination->create_links();
		}

		$res = $this->uc->brand_query($page,$per_page);
		if($this->session->userdata('admin')==true){
			$this->load->view('include/header',array('res'=>$res,'page_output'=>$page_output));
			$this->load->view('usercenter/top_menu');
			$this->load->view('usercenter/manage_brand');
			$this->load->view('include/footer');
		}else{
			redirect('sign/signin');
		}
		
	}
	public function delete_brand($id){
		$this->uc->brand_delete($id);
		echo 'success';
	}
	public function product_page(){
		$arr = $this->uc->product_query();
		$this->load->view('include/header',array('res'=>$arr));
		$this->load->view('usercenter/top_menu');
		$this->load->view('usercenter/add_product');
		$this->load->view('include/footer');
	}
	public function add_product(){
		$this->form_validation->set_rules('pname','产品名称','required');
		$this->form_validation->set_rules('owner','所属品牌','required');
		$this->form_validation->set_rules('description','品牌描述','required');
		$this->form_validation->set_rules('path','图片','required');
		if($this->form_validation->run()==false){
			self::product_page();
		}else{
			$pname = $this->input->post('pname',true);
			$owner = $this->input->post('owner',true);
			$img = $this->input->post('path',true);
			$desc = $this->input->post('description',true);
			$this->load->helper('string');
			$desc = quotes_to_entities($desc);
			$result = $this->uc->brand_insert($pname,$img,'',$desc,$owner,'');
			if(!$result){
				$error = array('error'=>'该产品已经存在');
				self::product_page($error);
			}else{
				redirect('usercenter/product_page');
			}
		}
	}
	public function category_page(){
		$this->load->view('include/header');
		$this->load->view('usercenter/top_menu');
		$this->load->view('usercenter/add_category');
		$this->load->view('include/footer');		
	}
	public function add_category(){
		$this->form_validation->set_rules('category','分类名称','required|is_unique[category.cate_name]');
		if($this->form_validation->run()==FALSE){
			show_error('分类已经存在');
			exit;
		}
		$cate_name = $this->input->post('category');
		$query = $this->uc->cate_insert($cate_name);
		if($query){
			self::category_page();
		}else{
			show_error('插入分类出错');
			die();
		}
	}
	public function category_manage($page=0){
		$url = site_url();
		$per_page = 10;
		$page_nums = $this->uc->cate_num();
		$page_output = null;
		if($page_nums>1){
			$this->load->library('pagination');
			$config['base_url'] = $url.'/usercenter/category_manage/';
			$config['total_rows'] = $page_nums;
			$config['per_page'] = 10; 
			$config['full_tag_open'] = "<ul>";
			$config['full_tag_close'] = "</ul>";
			$config['prev_tag_open'] = '<li>';
			$config['prev_tag_close'] = '</li>';
			$config['next_tag_open'] = '<li>';
			$config['next_tag_close'] = '</li>';
			$config['cur_tag_open'] = '<li class="disabled"><a>';
			$config['cur_tag_close'] = '</a></li>';
			$config['num_tag_open'] = '<li>';
			$config['num_tag_close'] = '</li>';
			$per_page = $config['per_page'];
			$this->pagination->initialize($config);
			$page_output = $this->pagination->create_links();
		}

		$res = $this->uc->cate_query($page,$per_page);
		if($this->session->userdata('admin')==true){
			$this->load->view('include/header',array('res'=>$res,'page_output'=>$page_output));
			$this->load->view('usercenter/top_menu');
			$this->load->view('usercenter/category_manage');
			$this->load->view('include/footer');
		}else{
			redirect('sign/signin');
		}
		
	}
	public function delete_cate($id){
		$this->uc->cate_delete($id);
		echo 'success';
	}
}
