<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
include APPPATH.'libraries/TopSdk.php';
class Taobao extends CI_Controller{
	function __construct(){
		parent::__construct();
	}
	public function info(){
		$c = new TopClient;
		$c->appkey = "21478777";
		$c->secretKey = "0467bacb01868e15a3b49f1279f27734";
		$c->format = 'json';
		$req = new ItemGetRequest;
		$req->setFields("detail_url,num_iid,title,nick,type,cid,seller_cids,props,input_pids,input_str,pic_url,num,valid_thru,list_time,delist_time,stuff_status,location,price,post_fee,express_fee,ems_fee,has_discount,freight_payer,has_invoice,has_warranty,has_showcase,modified,increment,approve_status,postage_id,product_id,auction_point,property_alias,item_img,prop_img,sku,video,outer_id,is_virtual");

		$url = $this->input->post('url',true);
		$regexp = '/^http:\/\/(item\.taobao\.com|detail\.tmall\.com)\/item\.htm\?.*?id=([\d]+).*$/i';
		$matches = array();
		if(preg_match($regexp, $url, $matches)){
			$id = $matches[2];
			$req->setNumIid($id);
			$resp = $c->execute($req, $sessionKey=null);
			echo json_encode($resp);
		}else{
			echo json_encode(array('error'=>'不是有效的淘宝链接'));
			exit();
		}	
	}
	public function tbnew(){
		$data = $this->input->post(null,true);

		$author = $this->session->userdata('uid');
		$title = $data['title'];
		$shopname = $data['shopname'];
		$price = $data['price'];
		$link = $data['url'];
		$item_imgs = $data['itemimgs'];
		$desc = $data['description'];
		$num_iid = $data['num_iid'];
		$from = 'taobao';

		$this->load->model('taobao_model');
		$result = $this->taobao_model->tb_add($num_iid,$author,$desc,$title,$shopname,$price,$link,$item_imgs,$from);
		if($result){
			$this->load->view('include/header');
			$this->load->view('create_suc');
			$this->load->view('include/footer');
		}
	}
	public function b2cnew(){
		$data = $this->input->post(null,true);

		$author = $this->session->userdata('uid');
		$title = $data['title'];
		$shopname = $data['shopname'];
		$price = $data['price'];
		$link = $data['url'];
		$item_imgs = $data['itemimgs'];
		$desc = $data['description'];
		$from = 'b2c';

		$this->load->model('taobao_model');
		$result = $this->taobao_model->tb_add('',$author,$desc,$title,$shopname,$price,$link,$item_imgs,$from);
		if($result){
			$this->load->view('include/header');
			$this->load->view('create_suc');
			$this->load->view('include/footer');
		}
	}
}