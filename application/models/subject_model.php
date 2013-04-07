<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Subject_model extends CI_Model {
	function __construct(){
		parent::__construct();
		$this->load->database();
	}

	public function subject_query($id){
		$sql = "SELECT * from posts where id=$id";
		$query = $this->db->query($sql);
		$this->db->close();
		if($query->num_rows()>0){
			return $query->row();
		}else{
			show_error('抱歉，没有相关结果');
		}
	}
	public function brand_query($id){
		$sql = "SELECT * from brand where id=$id";
		$query = $this->db->query($sql);
		$this->db->close();
		if($query->num_rows()>0){
			return $query->row();
		}else{
			return false;
		}
	}
}