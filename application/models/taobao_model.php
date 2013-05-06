<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Taobao_model extends CI_Model {
	function __construct(){
		parent::__construct();
		$this->load->database();
	}
	public function tb_add($num_iid,$author,$desc,$title,$shopname,$price,$link,$item_imgs,$wherefrom){
		$sql = "INSERT INTO posts 
				(num_iid,post_author,post_desc,post_title,shopname,price,link,item_imgs,wherefrom)
				values
				('$num_iid','$author','$desc','$title','$shopname','$price','$link','$item_imgs','$wherefrom')";
		$query = $this->db->query($sql);
		return $query ? true : false;
	}
	public function tb_exist($num_iid){
		$sql = "SELECT * FROM posts where num_iid='$num_iid'";
		if($this->db->query($sql)->num_rows()>0){
			return true;
		}
	}
}