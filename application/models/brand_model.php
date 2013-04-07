<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Brand_model extends CI_Model {
	function __construct(){
		parent::__construct();
		$this->load->database();
	}

	public function brand_query($id){
		$sql = "SELECT * from brand where id=$id";
		$query = $this->db->query($sql);
		$this->db->close();
		if($query->num_rows()>0){
			return $query->row();
		}else{
			show_error('抱歉，没有相关结果');
		}
	}
	public function posts_query($id){
		$sql = "SELECT * from posts where relate_brand=$id";
		$query = $this->db->query($sql);
		$this->db->close();
		if($query->num_rows()>0){
			return $query->result();
		}else{
			return null;
		}
	}
	public function is_subscribe($uid,$bid){
		$query = $this->db->query("SELECT * from subscribe where user_id='$uid' and brand_id='$bid'");
		if($query->num_rows()>0){
			return true;
		}else{
			return false;
		}
	}
	public function add_subscribe($uid,$bid){
		$sql = "INSERT INTO subscribe (user_id,brand_id) values ('$uid','$bid')";
		$query = $this->db->query($sql);
		if($query){
			echo true;
		}else{
			echo false;
		}
	}
	public function cancel_subscribe($uid,$bid){
		$sql = "DELETE from subscribe WHERE user_id='$uid' and brand_id='$bid'";
		$query = $this->db->query($sql);
		if($query){
			return true;
		}else{
			return false;
		}
	}
}