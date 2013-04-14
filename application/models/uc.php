<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Uc extends CI_Model {
	function __construct(){
		parent::__construct();
		$this->load->database();
		$this->load->helper('string');
	}

	public function brand_insert($brandname,$img,$area,$desc,$cateid){
		$sql = "INSERT INTO brand (brandname,img,area,description,cateid) values (
				'$brandname','$img','$area','$desc','$cateid'
				)";
		$query = $this->db->query($sql);
		if($query){
			return true;
		}else{
			show_error('插入数据库出错');
		}
		$this->db->close();
	}
    public function brand_query($start,$len){
		$sql = "SELECT * from brand order by id desc limit $start,$len";
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
		}else{
			show_error('品牌不存在');
		}
	}

	public function post_insert($author,$title,$owner,$price,$link,$desc,$statu,$tagsid){
		$sql = "INSERT INTO posts (post_author,post_content,post_title,post_status,relate_brand,price,link) values (
				'$author','$desc','$title','$statu','$owner','$price','$link'
				)";
		$query = $this->db->query($sql);
		
		if($query){
			if(!is_null($tagsid)){
				$sql = "SELECT id from posts order by id desc limit 0,1";
				$query = $this->db->query($sql);
				$id = $query->row()->id;

				$arr = explode(",",$tagsid);
				
				$sql = "INSERT INTO post_tag (post_id,tag_id) values ('$id',?)"; 

				for($i=0;$i<count($arr);$i++){
					$this->db->query($sql,array($arr[$i]));
				}
				return true;
			}
			return true;
		}else{
			show_error('插入数据库出错');
		}
		$this->db->close();
	}
	
	public function brand_list(){
		$query = $this->db->query("SELECT id,brandname FROM brand");
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
}