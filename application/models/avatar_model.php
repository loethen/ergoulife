<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Avatar_model extends CI_Model {
	function __construct(){
		parent::__construct();
		$this->load->database();
	}
	function insert_avatar($avatar){
		$uid = $this->session->userdata('uid');
		$sql = "UPDATE user set avatar='$avatar' where uid=$uid";
		$query =  $this->db->query($sql);
		return $query;
	}
	function get_avatar(){
		$uid = $this->session->userdata('uid');
		$sql = "select * from user where uid='$uid'";
		$query =  $this->db->query($sql);
		return $query->row();
	}
}