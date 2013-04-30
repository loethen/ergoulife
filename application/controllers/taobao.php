<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
include APPPATH.'libraries/TopSdk.php';
class Taobao extends CI_Controller{
	function __construct(){
		parent::__construct();
	}
	function info(){
		$c = new TopClient;
		$c->appkey = "21478777";
		$c->secretKey = "0467bacb01868e15a3b49f1279f27734";
		$c->format = 'json';
		$req = new ItemGetRequest;
		$req->setFields("detail_url,num_iid,title,nick,type,cid,seller_cids,props,input_pids,input_str,pic_url,num,valid_thru,list_time,delist_time,stuff_status,location,price,post_fee,express_fee,ems_fee,has_discount,freight_payer,has_invoice,has_warranty,has_showcase,modified,increment,approve_status,postage_id,product_id,auction_point,property_alias,item_img,prop_img,sku,video,outer_id,is_virtual");

		$url = $this->input->post('url',true);
		$parse = parse_url($url);
		$str = $parse['query'];
		parse_str($str, $output);
		$id = $output['id'];
		$req->setNumIid($id);
		$resp = $c->execute($req, $sessionKey=null);
		echo json_encode($resp);
	}
}