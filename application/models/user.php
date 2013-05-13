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
	public function user_insert($name,$email,$password){
		$sql = "insert into user (name,email,password) VALUES ('$name','$email','$password')";
		return $this->db->query($sql);
	}
	public function login($email,$password){
		$query = $this->db->query("select * from user where email='$email'");
		return $query;
	}
	public function get_user($email){
		$query = $this->db->query("SELECT * from user where email='$email'");
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
	public function update_profile($name,$profile,$uid){
		$query = $this->db->query("UPDATE user set name='$name', profile='$profile' where uid='$uid'");
		$this->db->close();
		return $query;
	}
	public function update_avatar($avatar,$uid){
		$query = $this->db->query("UPDATE user set avatar='$avatar' where uid='$uid'");
		$this->db->close();
		return $query;
	}
	public function add_user_meta($uid,$key,$value){
		$sql = "SELECT * FROM usermeta where user_id='$uid' and meta_key='$key'";
		$query = $this->db->query($sql);
		if($query->num_rows()>0){
			$query = $this->db->query("UPDATE usermeta set
									meta_value='$value'
									where 
									user_id='$uid' 
									and 
									meta_key='$key'
								  ");
		}else{
			$query = $this->db->query("INSERT INTO usermeta 
									(user_id,meta_key,meta_value)
									VALUES
									('$uid','$key','$value')
								  ");
		}
		return $query ? true : false;
	}
	public function is_active($uid){
		$sql = "SELECT * FROM usermeta where user_id='$uid' and meta_key='active' and meta_value='true'";
		$query = $this->db->query($sql);
		return $query->num_rows>0 ? false : true;
	}
}