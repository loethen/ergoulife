<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Index_query extends CI_Model {
	function __construct(){
		parent::__construct();
		$this->load->database();
	}
	public function post_list(){
		$sql = "SELECT * 
				from posts 
				where post_status='publish'
				order by post_date desc";
		$query =  $this->db->query($sql);
		$result = $query->result();
		return $result;
	}
	// public function tag_list($post_id){
	// 	$sql = "SELECT pt.post_id,t.*
	// 			from posts as p,tags as t,post_tag as pt 
	// 			where p.id = '$post_id'
	// 			and pt.tag_id = t.tag_id";
	// 	$query =  $this->db->query($sql);
	// 	$result = $query->result();
	// 	return $result;
	// }
	public function cloud_tag(){
		$sql = "SELECT *
				from tags limit 0,10";
		$query =  $this->db->query($sql);
		$result = $query->result();
		return $result;
	}
}