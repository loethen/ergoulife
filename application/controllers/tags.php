<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Tags extends CI_Controller{
	function __construct(){
		parent::__construct();
		$this->load->model('tags_model');	
	}
	public function addtag(){
		$tag = $_POST['tag'];
		$row = $this->tags_model->add($tag);
		echo json_encode($row);
	}
}