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
		$this->form_validation->set_rules('brandname','品牌名称','required|is_unique[brand.brandname]');
		$this->form_validation->set_rules('area','产地','required');
		$this->form_validation->set_rules('description','品牌描述','required');
		$this->form_validation->set_rules('category','所属分类','required');
		if($this->form_validation->run()==false){
			self::index();
		}else{
			$brandname = $this->input->post('brandname',true);
			$cateid = $this->input->post('category',true);
			$img = $this->input->post('path',true);
			$area = $this->input->post('area',true);
			$desc = $this->input->post('description',true);

			$this->load->helper('string');
			$desc = quotes_to_entities($desc);
			$result = $this->uc->brand_insert($brandname,$img,$area,$desc,$cateid);
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
	public function product_page($msg=null){
		$brand = $this->uc->brand_list();
		$this->load->view('include/header',array('res'=>$brand,'status'=>$msg));
		$this->load->view('admin/top_menu');
		$this->load->view('admin/add_product');
		$this->load->view('include/footer');
	}
	public function add_product(){
		$this->form_validation->set_rules('title','标题','required');
		$this->form_validation->set_rules('price','价格','required');
		$this->form_validation->set_rules('link','直达链接','required');
		$this->form_validation->set_rules('owner','所属品牌','required');
		$this->form_validation->set_rules('description','品牌描述','required');

		if($this->form_validation->run()==false){
			self::product_page();
		}else{
			$author = $this->session->userdata('uid');
			$title = $this->input->post('title',true);
			$owner = $this->input->post('owner',true);
			$price = $this->input->post('price',true);
			$link = $this->input->post('link',true);
			$desc = $this->input->post('description',true);
			$statu = $this->input->post('statu',true);
			$result = $this->uc->post_insert($author,$title,$owner,$price,$link,$desc,$statu);
			if($result){
				self::product_page($msg='文章发布成功');
			}else{
				self::product_page($msg='文章发布失败');
			}
		}
	}
	public function manage_product(){

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