<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Uc extends CI_Model {
	function __construct(){
		parent::__construct();
		$this->load->database();
		$this->load->helper('string');
	}
	public function brand_insert($cnname,$img,$area,$desc,$owner,$catid){
		$cnname = quotes_to_entities($cnname);
		if(empty($owner)){
			$sql = "INSERT INTO brand (cnname,img,field,description,catid) VALUES ('$cnname','$img','$area','$desc','$catid')";
		}else{
			$sql= "INSERT INTO brand (cnname,img,description,owner) VALUES ('$cnname','$img','$desc','$owner')";
		}
		$query = $this->db->query($sql);
		if($query){
			return true;
		}else{
			show_error('插入数据库出错');
		}
		$this->db->close();
		
	}
	public function brand_query($start,$len){
		$sql = "SELECT * from brand WHERE owner is null order by id desc limit $start,$len";
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
	public function brand_delete($id){
		$sql = "select * from brand where id=$id";
		$query = $this->db->query($sql);
		if($query->num_rows>0){
			$sql = "delete from brand where id=$id";
			$this->db->query($sql);
			$this->db->close();
			return true;
		}
	}
	public function product_query(){
		$query = $this->db->query("SELECT id,cnname FROM brand where owner IS NULL");
		$this->db->close();
		return $query->result();
	}
	public function cate_insert($cate_name){
		$query = $this->db->query("INSERT INTO category SET cate_name='$cate_name'");
		return $query;
	}
	public function cate_num(){
		$sql = "select * from category";
		$query = $this->db->query($sql);
		return $query->num_rows();
	}
	public function cate_query($start=null,$len=null){
		if(is_null($start) & is_null($len)){
			$sql = "SELECT * from category";
		}else{
			$sql = "SELECT * from category order by id asc limit $start,$len";
		}
		$query = $this->db->query($sql);
		$result = $query->result();
		$this->db->close();
		return $result;
	}
	public function cate_delete($id){
		$sql = "select * from category where id=$id";
		$query = $this->db->query($sql);
		if($query->num_rows>0){
			$sql = "delete from category where id=$id";
			$this->db->query($sql);
			$this->db->close();
			return true;
		}
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
}