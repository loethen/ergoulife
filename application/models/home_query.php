<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home_query extends CI_Model {
	function __construct(){
		parent::__construct();
		$this->load->database();
	}
	function brand_list(){
		$sql = "select * from brand order by id desc limit 0,15";
		$query =  $this->db->query($sql);
		$result = $query->result();
		return $result;
	}
}