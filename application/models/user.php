<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Model {
	function __construct(){
		parent::__construct();
		$this->load->database();
	}

	public function user_insert($email,$password){
		$sql = "insert into user (email,password) VALUES ('$email','$password')";
		$this->db->query($sql);
	}

	public function login($email,$password){
		$query = $this->db->query("select * from user where email='$email'");
		return $query;
	}
}