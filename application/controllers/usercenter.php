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
		self::brand_page();
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
			$config['upload_path'] = './uploads/';
			$config['allowed_types'] = 'gif|jpg|png';
			$config['max_size'] = '200';
			$config['max_width'] = '1024';
			$config['max_height'] = '768';
			$config['encrypt_name'] = TRUE;
			$this->load->library('upload',$config);
			if(!$this->upload->do_upload('imgfile')){
				show_error('上传图片出错');
				$error = array('error'=>$this->upload->display_errors());
				self::brand_page($error);
			}else{
				$data = $this->upload->data();
				$config = array();
				$config['source_image'] = $data['full_path'];
				$config['new_image'] = './uploads/';
				$config['master_dim'] = 'width';
				$config['width'] = 300;
				$config['height'] = 300;
				
				$this->load->library('image_lib', $config);
				$this->image_lib->initialize($config);
				$this->image_lib->resize();
				$this->image_lib->display_errors();

				$this->image_lib->clear();
				
				$config = array();

				$config['source_image'] = $data['full_path'];
				$config['new_image'] = './uploads/thumb/';
				$config['master_dim'] = 'width';
				$config['width'] = 150;
				$config['height'] = 150;
				$config['create_thumb'] = false;
				$this->image_lib->initialize($config);
				$this->image_lib->resize();
				$this->image_lib->display_errors();

				if($this->image_lib->resize()){
					$cnname = $this->input->post('cnbrand',true);
					$catid = $this->input->post('category',true);
					$img = $data['file_name'];
					$area = $this->input->post('area',true);
					$desc = $this->input->post('description',true);

					$this->load->helper('string');
					$desc = quotes_to_entities($desc);
					$result = $this->uc->brand_insert($cnname,$img,$area,$desc,'',$catid);
					redirect('usercenter');
				}else{
					 echo $this->image_lib->display_errors();
				};
			}
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
