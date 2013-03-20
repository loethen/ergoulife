<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Uc extends CI_Model {
	function __construct(){
		parent::__construct();
		$this->load->database();
		$this->load->helper('string');
	}
	public function exist($cnname){
		$sql = "select * from brand where cnname = '$cnname'";
		$query = $this->db->query($sql);
		if($query->num_rows()>0){
			return false;
		}else{
			return true;
		}
	}
	public function brand_insert($cnname=NULL,$img=NULL,$area=NULL,$desc=NULL,$owner=NULL){
		$enname = quotes_to_entities($enname);
		if(self::exist($cnname)){
			if(is_null($owner)){
				$sql = "INSERT INTO brand SET cnname='$cnname',img='$img',field='$area',description='$desc'";
			}else{
				$sql= "INSERT INTO brand (cnname,img,description,owner) VALUES ('$cnname','$img','$desc','$owner')";
			}
			$this->db->query($sql);
			$this->db->close();
			return true;
		}else{
			show_error('该品牌已经存在');
		}
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
		return $query->result();
	}
}