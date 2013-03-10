<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Subject_query extends CI_Model {
	function __construct(){
		parent::__construct();
		$this->load->database();
	}

	public function subject_query($id){
		$sql = "select * from brand where id=$id";
		$query = $this->db->query($sql);
		if($query->num_rows()>0){
			return $query->result();
		}else{
			show_error('抱歉，没有相关结果');
		}
	}
}