<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Index_query extends CI_Model {
	function __construct(){
		parent::__construct();
		$this->load->database();
	}
	function brand_list($id){
		$sql = "SELECT * from brand where catid='$id'";
		$query =  $this->db->query($sql);
		$result = $query->result();
		return $result;
	}
	function cat_query(){
		$sql = "SELECT * from category";
		$query = $this->db->query($sql);
		return $query->result();
	}
}