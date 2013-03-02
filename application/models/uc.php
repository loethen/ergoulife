<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Uc extends CI_Model {
	function __construct(){
		parent::__construct();
		$this->load->database();
		$this->load->helper('string');
	}
	public function exist($enname){
		$sql = "select * from brand where enname = '$enname'";
		$query = $this->db->query($sql);
		if($query->num_rows()>0){
			return false;
		}else{
			return true;
		}
	}
	public function brand_insert($enname,$cnname,$img,$area,$desc){
		$enname = quotes_to_entities($enname);
		if(self::exist($enname)==true){
			$sql = "insert into brand (enname,cnname,img,field,description) VALUES ('$enname','$cnname','$img','$area','$desc')";
			$this->db->query($sql);
			$this->db->close();
			return true;
		}else{
			return false;
		}
	}
	public function brand_query($start,$len){
		$sql = "select enname,cnname,img,field,description from brand order by id desc limit $start,$len";
		$query = $this->db->query($sql);
		$result = $query->result();
		$this->db->close();
		return $result;
	}
	public function brand_num(){
		$sql = "select * from brand";
		$query = $this->db->query($sql);
		return $query->num_rows();
	}
}