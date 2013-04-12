<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Tags_model extends CI_Model {
	function __construct(){
		parent::__construct();
		$this->load->database();
	}
	public function add($tag){
		$query = $this->db->query("SELECT * from tags where tag_name='$tag'");
		if($query->num_rows()>0){
			
		}else{
			$this->db->query("INSERT INTO tags set tag_name='$tag'");
			$query = $this->db->query("SELECT * from tags where tag_name='$tag'");
		}
		return $query->row();
	}
}