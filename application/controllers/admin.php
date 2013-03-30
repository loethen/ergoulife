<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends CI_Controller {
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
		self::brand_page();
	}
	public function brand_page(){
		$res = $this->uc->cate_query();
		$this->load->view('include/header',array('res'=>$res));
		$this->load->view('admin/top_menu');
		$this->load->view('admin/index');
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
			redirect('admin');
		}
	}
	public function manage_brand($page=0){
		$url = site_url();
		$per_page = 10;
		$page_nums = $this->uc->brand_num();
		$page_output = null;
		if($page_nums>1){
			$this->load->library('pagination');
			$config['base_url'] = $url.'/admin/manage_brand/';
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
			$this->load->view('admin/top_menu');
			$this->load->view('admin/manage_brand');
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
		$this->load->view('admin/top_menu');
		$this->load->view('admin/add_product');
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
				redirect('admin/product_page');
			}
		}
	}
	public function category_page(){
		$this->load->view('include/header');
		$this->load->view('admin/top_menu');
		$this->load->view('admin/add_category');
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
			$config['base_url'] = $url.'/admin/category_manage/';
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
			$this->load->view('admin/top_menu');
			$this->load->view('admin/category_manage');
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