<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Comment_model extends CI_Model{
	function __construct(){
		parent::__construct();
		$this->load->database();
	}
	public function add_comment($pid,$sid,$uid,$username,$content){
		$sql = "INSERT INTO comments (parent_id,subject_id,user_id,username,created,content) VALUES (
				'$pid','$sid','$uid','$username',NUll,'$content'
			)";
		$query = $this->db->query($sql);
		return $query;
	}
	public function show_comment($s_id){
		$sql = "SELECT * FROM comments where subject_id='$s_id' LIMIT 0,10";
		$query = $this->db->query($sql);
		if($query->num_rows()>0){
			return $query->result();
		}else{
			return FALSE;
		}
	}

}