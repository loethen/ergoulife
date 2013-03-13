<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Rate_model extends CI_Model {
	function __construct(){
		parent::__construct();
		$this->load->database();
	}

	public function upd_rate($uid,$bid,$score){
		$sql = "select * from brand_rate where brandid=$bid";
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
			$rate = self::have_rate($uid,$bid);
			$s = 'star'.$rate;
			$this->db->trans_start();
			$this->db->query("UPDATE brand_rate set $s = $s-1 where brandid = $bid");
			$this->db->query("UPDATE brand_rate set $star = $star+1 where brandid = $bid");
			$this->db->trans_complete();
			if ($this->db->trans_status() === FALSE)
			{
			    show_error('更新分数出错');
			}else{
				return TRUE;
			}
			
		}else{
			$sql = "INSERT INTO brand_rate (brandid,$star) VALUES ('$bid',$star+1)";
			$query = $this->db->query($sql);
			return $query;
		}
		$this->db->close();
	}

	public function have_rate($uid,$bid){
		$sql = "select * from user_brand where uid='$uid' and bid='$bid'";
		$query = $this->db->query($sql);
		$this->db->close();
		if($query->num_rows()>0){
			$row = $query->row();
			$rate = $row->rate;
		}else{
			$rate = 0;
		}
		return $rate;
	}

	public function upd_user_brand($uid,$bid,$score){
		$sql = "select * from user_brand where uid='$uid' and bid='$bid'";
		$query = $this->db->query($sql);
		if($query->num_rows()>0){
			$sql = "update user_brand set rate='$score' where uid='$uid' and bid='$bid'";
		}else{
			$sql = "insert into user_brand (uid,bid,rate) values ('$uid','$bid','$score')";
		}
		$query = $this->db->query($sql);
		return $query;
	}
}