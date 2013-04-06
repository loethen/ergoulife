<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Allbrand_model extends CI_Model {
	function __construct(){
		parent::__construct();
		$this->load->database();
	}
	function brand_list($id){
		$sql = "SELECT id,brandname,area,cateid from brand where cateid='$id'";
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