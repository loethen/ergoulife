<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Taobao extends CI_Controller{
	function __construct(){
		parent::__construct();
		$this->load->library('TopClient');
		$this->topclient->appkey = '21478777';
		$this->topclient->secretKey = '0467bacb01868e15a3b49f1279f27734';
		$this->topclient->format = 'json';

	}
	function info(){
		$url = $this->input->post('url',true);
		$parse = parse_url($url);
		$str = $parse['query'];
		parse_str($str, $output);
		$id = $output['id'];
		$this->load->library('ItemGetRequest');
		$this->itemgetrequest->setFields("num_iid,title,price,item_img");
		$this->itemgetrequest->setNumIid($id);
		$this->itemgetrequest->setTrackIid("123_track_456");
		$resp = $this->topclient->execute($this->itemgetrequest, $sessionKey=null);
		echo $resp;
	}
}