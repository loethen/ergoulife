<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Comments_model extends CI_Model{
	function __construct(){
		parent::__construct();
		$this->load->database();
	}
	public function add_comment($reply_id,$post_id,$user_id,$content){
		$sql = "INSERT INTO comments (reply_id,post_id,user_id,content) VALUES (
				'$reply_id','$post_id','$user_id','$content'
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