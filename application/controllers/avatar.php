<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Avatar extends CI_Controller {

	function __construct(){
		parent::__construct();
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
		if (!$this->upload->do_upload('avatar')){
		   echo json_encode(array('state'=>false));
		}else{
		   $this->load->library('image_lib');
		   $file = $this->upload->data();
		   $full_path = $file['full_path'];
		   $file_name = $file['file_name'];
		   $width = $file['image_width'];
		   $height = $file['image_height'];

		   $config['source_image'] = $full_path;
		   $config['maintain_ratio'] = TRUE;
		   if($width >= $height){
		       $config['master_dim'] = 'height';
		   }else{
		       $config['master_dim'] = 'width';
		   }
		   $config['width'] = 48;
		   $config['height'] = 48;
		   $this->image_lib->initialize($config);
		   $this->image_lib->resize();
		       
		   $config['maintain_ratio'] = FALSE;

		   if($width >= $height){
		       $config['x_axis'] = floor(($width * 48 / $height - 48)/2);
		   }else{
		       $config['y_axis'] = floor(($height * 48 / $width - 48)/2);
		   }

		   $this->image_lib->initialize($config);

		   if($this->image_lib->crop()){
		   		$array = array('state'=>true,'filename'=>$file_name);
		   		echo json_encode($array);
		   }else{
    			echo $this->image_lib->display_errors();
		   }
		}
	}	
}