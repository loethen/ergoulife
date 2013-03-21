<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Image extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->library('image_lib');
	}
	public function upload(){
		$config['upload_path'] = './uploads/';
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size'] = '200';
		$config['max_width'] = '1024';
		$config['max_height'] = '768';
		$config['encrypt_name'] = TRUE;
		$this->load->library('upload',$config); //上传图片
		if($this->upload->do_upload('imgfile')){
			$data = $this->upload->data();
			$json = json_encode($data);
		}else{
			show_error('上传失败');
		}
		echo $json;
	}
	public function resize(){

	}
	public function crop(){

	}
}