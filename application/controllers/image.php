<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Image extends CI_Controller {

	function __construct(){
		parent::__construct();
	}
	public function upload(){
		$config['upload_path'] = './uploads/';
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size'] = '200';
		$config['max_width'] = '2024';
		$config['max_height'] = '1768';
		$config['encrypt_name'] = TRUE;
		$this->load->library('upload',$config); //上传图片
		if($this->upload->do_upload('imgfile')){
			$data = $this->upload->data();
			$resize = self::resize($data);
			if($resize){
				$json = json_encode($data);
			}else{
				show_error('调整图片大小失败');
			}
		}else{
			show_error('上传图片失败');
		}
		echo $json;
	}
	public function resize($data){
		$config = array();
		$config['source_image'] = $data['full_path'];
		$config['new_image'] = './uploads/';
		$config['master_dim'] = 'width';
		$config['width'] = 300;
				
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