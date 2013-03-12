<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Rate_model extends CI_Model {
	function __construct(){
		parent::__construct();
		$this->load->database();
	}

	public function upd_rate($id,$score){
		$sql = "select * from brand_rate where brandid=$id";
		$query = $this->db->query($sql);
		switch ($score) {
			case '1':
				$star = 'star1';
				break;
			case '2':
				$star = 'star2';
				break;
			case '3':
				$star = 'star3';
				break;
			case '4':
				$star = 'star4';
				break;
			case '5':
				$star = 'star5';
				break;
			default:
				show_error('评分不在范围内。');
				break;
		}
		
		if($query->num_rows()>0){
			$sql = "UPDATE brand_rate set $star = $star+1 where brandid = $id";
			$query = $this->db->query($sql);
			return $query;
		}else{
			$sql = "INSERT INTO brand_rate (brandid,$star) VALUES ('$id',$star+1)";
			$query = $this->db->query($sql);
			return $query;
		}
	}
}