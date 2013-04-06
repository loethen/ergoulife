<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Avatar extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model('avatar_model');
		$this->load->helper(array('form', 'url'));
	}
	public function upload(){
		$config['upload_path'] = './uploads/avatar';
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size'] = '200';
		$config['max_width'] = '1024';
		$config['max_height'] = '768';
		$config['encrypt_name'] = TRUE;
		$this->load->library('upload',$config); //上传图片
		if($this->upload->do_upload('avatar')){
			$data = $this->upload->data();
			$resize = self::resize($data);
			if($resize){
				$avatar = $data['file_name'];
				$query = $this->avatar_model->insert_avatar($avatar);
				if($query){
					self::avatar_thumb();
				}
			}else{
				show_error('调整图片大小失败');
			}
		}else{
			show_error('上传图片失败');
		}
	}
	public function avatar_thumb(){
		$row = $this->avatar_model->get_avatar();
		$this->load->view('include/header',array('row'=>$row));
		$this->load->view('usercenter/avatar');
		$this->load->view('include/footer');
	}
	public function resize($data){
		$config = array();
		$config['source_image'] = $data['full_path'];
		$config['new_image'] = './uploads/avatar';
		$config['master_dim'] = 'width';
		$config['width'] = 160;
				
		$this->load->library('image_lib', $config);
		$this->image_lib->initialize($config);
		if($this->image_lib->resize()){
			return TRUE;
		}else{
			return $this->image_lib->display_errors();
		}
	}
	public function crop(){
		$config = array();
		$config['source_image'] = $_POST['src'];
		$config['new_image'] = './uploads/thumb/';
		$config['width'] = $_POST['w'];
		$config['height'] = $_POST['h'];
		$config['x_axis'] = $_POST['x'];
		$config['y_axis'] = $_POST['y'];
		$config['maintain_ratio'] = FALSE;
		$this->load->library('image_lib', $config);
		$this->image_lib->initialize($config);
		if($this->image_lib->crop()){
			if($config['width']>150){
				$this->image_lib->clear();
				$config = array();
				$config['source_image'] = './uploads/thumb/'.$_POST['fname'];
				$config['new_image'] = './uploads/thumb';
				$config['maintain_ratio'] = FALSE;
				$config['width'] = 150;
				$config['height'] = 120;
				$config['quality'] = 100;
				$this->image_lib->initialize($config);
				if($this->image_lib->resize()){
					echo 'success';
				}else{
					return $this->image_lib->display_errors();
				}
			}else{
				$this->image_lib->clear();
				$config = array();
				$config['source_image'] = './uploads/thumb/'.$_POST['fname'];
				$config['new_image'] = './uploads/thumb';
				$config['maintain_ratio'] = FALSE;
				$config['width'] = 150;
				$config['height'] = 120;
				$config['quality'] = 100;
				$this->image_lib->initialize($config);
				if($this->image_lib->resize()){
					echo 'success';
				}else{
					return $this->image_lib->display_errors();
				}
			}
			
		}else{
			show_error($this->image_lib->display_errors());
		}
	}
}