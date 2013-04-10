<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Index_query extends CI_Model {
	function __construct(){
		parent::__construct();
		$this->load->database();
	}
	function post_list(){
		$sql = "SELECT * from posts where post_status='publish' order by post_date desc";
		$query =  $this->db->query($sql);
		$result = $query->result();
		return $result;
	}
}