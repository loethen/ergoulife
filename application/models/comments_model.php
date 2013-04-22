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
	public function show_comment($pid){
		$sql = "SELECT c.*,u.avatar,u.name,u.uid FROM comments as c,user as u 
				where c.post_id='$pid' 
				and c.user_id = u.uid
				order by created desc";
		$query = $this->db->query($sql);
		if($query->num_rows()>0){
			return $query->result();
		}else{
			return FALSE;
		}
	}
	public function updateCount($pid){
		$sql = "UPDATE posts set comment_count=comment_count+1 where id='$pid'";
		$query = $this->db->query($sql);
		if($query){
			return true;
		}
	}
}