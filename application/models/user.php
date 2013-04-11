<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Model {
	function __construct(){
		parent::__construct();
		$this->load->database();
	}
	static $uid;
	static private function get_uid(){
		return $this->uid = $this->session->userdata('uid');
	}
	public function user_insert($email,$password){
		$sql = "insert into user (email,password) VALUES ('$email','$password')";
		$this->db->query($sql);
	}

	public function login($email,$password){
		$query = $this->db->query("select * from user where email='$email'");
		return $query;
	}
	public function user_info($uid){
		$sql = "SELECT * from user where uid = '$uid'";
		$query = $this->db->query($sql);
		$this->db->close();
		return $query;
	}
	public function update_pw($pw,$uid){
		$query = $this->db->query("UPDATE user set password='$pw' where uid='$uid'");
		$this->db->close();
		return $query;
	}
	public function update_profile($profile,$uid){
		$query = $this->db->query("UPDATE user set profile='$profile' where uid='$uid'");
		$this->db->close();
		return $query;
	}
	public function update_avatar($avatar,$uid){
		$query = $this->db->query("UPDATE user set avatar='$avatar' where uid='$uid'");
		$this->db->close();
		return $query;
	}
}