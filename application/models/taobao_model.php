<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Taobao_model extends CI_Model {
	function __construct(){
		parent::__construct();
		$this->load->database();
	}
	public function tb_add($num_iid,$author,$desc,$title,$shopname,$price,$link,$item_imgs){
		$sql = "INSERT INTO posts 
				(num_iid,post_author,post_desc,post_title,shopname,price,link,item_imgs)
				values
				('$num_iid','$author','$desc','$title','$shopname','$price','$link','$item_imgs')";
		$query = $this->db->query($sql);
		return $query ? true : false;
	}
}