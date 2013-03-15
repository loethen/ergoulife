<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Rate_model extends CI_Model {
	function __construct(){
		parent::__construct();
		$this->load->database();
	}
	public function rate_query($id){
		$sql = "select * from brand_rate where brandid=$id";
		$query = $this->db->query($sql);
		$this->db->close();
		if($query->num_rows()>0){
			return $query->row();
		}else{
			$arr = array('star5'=>0,'star4'=>0,'star3'=>0,'star2'=>0,'star1'=>0);
			return json_decode(json_encode ($arr), FALSE);
		}
	}
	public function upd_rate($uid,$bid,$score){
		$sql = "SELECT * from brand_rate where brandid='$bid'";
		$query = $this->db->query($sql);
		$star = 'star'.$score;
		if($query->num_rows()>0){
			$rate = self::have_rate($uid,$bid);
			$s = 'star'.$rate;
			$this->db->trans_start();
			$this->db->query("UPDATE brand_rate set $s = $s-1 where brandid = '$bid'");
			$this->db->query("UPDATE brand_rate set $star = $star+1 where brandid = '$bid'");
			$this->db->trans_complete();
			if ($this->db->trans_status() === FALSE)
			{
			    show_error('更新分数出错');
			}else{
				return TRUE;
			}
		}else{
			$sql = "INSERT INTO brand_rate (brandid,$star) VALUES ($bid,$star+1)";
			$query = $this->db->query($sql);
			if($query){
				return TRUE;
			}else{
				show_error('插入评分出错');
			}
		}
	}

	public function have_rate($uid,$bid){
		$sql = "SELECT * FROM user_brand where uid='$uid' and bid='$bid'";
		$query = $this->db->query($sql);
		
		if($query->num_rows()>0){
			$row = $query->row();
			$rate = $row->rate;
		}else{
			$rate = 0;
		}
		return $rate;
	}

	public function upd_user_brand($uid,$bid,$score){
		$sql = "SELECT * FROM user_brand where uid='$uid' and bid='$bid'";
		$query = $this->db->query($sql);
		if($query->num_rows()>0){
			$query = $this->db->query("UPDATE user_brand SET rate='$score' where uid='$uid' and bid='$bid'");
		}else{
			$query = $this->db->query("INSERT INTO user_brand SET uid='$uid',bid='$bid',rate='$score'");
		}
		return $query;
	}
}