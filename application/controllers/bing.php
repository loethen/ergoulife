<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
include APPPATH.'libraries/upyun.class.php';
class Bing extends CI_Controller{
	function __construct(){
		parent::__construct();
	}
	function bing_proxy(){
 		$acctKey = 'R1vjR4XIMYfnaj0FUZjUmKrV8WAQGP5Bh3t6rvItfDM=';
		$rootUri = 'https://api.datamarket.azure.com/Bing/Search/v1';
		$key = $_GET['query'];
		$query = urlencode($key);
		$requestUri = "$rootUri/Image?\$format=json&\$top=30&Query=%27$query%27&ImageFilters=%27Size%3Alarge%27&Market=%27zh-CN%27";
		$auth = base64_encode("$acctKey:$acctKey"); 

		$data = array(
		'http' => array(
		'request_fulluri' => true,
		// ignore_errors can help debug – remove for production. This option added in PHP 5.2.10
		'ignore_errors' => true,
		'header' => "Authorization: Basic $auth")
		);

		$context = stream_context_create($data);
		// Get the response from Bing.

		$response = file_get_contents($requestUri, 0, $context);

		// Send the response back to the browser.

		echo $response;
	}
	function pd_upload(){
		$config['upload_path'] = './uploads/pd';
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size'] = '200';
		$config['max_width'] = '1024';
		$config['max_height'] = '800';
		$config['encrypt_name'] = TRUE;
		$this->load->library('upload',$config); //上传图片
		if (!$this->upload->do_upload('pdimg')){
		    echo json_encode(array('state'=>false));
		}else{
			$file = $this->upload->data();
			$upyun = new UpYun('im007', 'ergou', '123.123.');
			try {
				$opts = array(
				        UpYun::X_GMKERL_TYPE    => 'square', // 缩略图类型
				        UpYun::X_GMKERL_VALUE   => 310, // 缩略图大小
				        UpYun::X_GMKERL_QUALITY => 310, // 缩略图压缩质量
				        UpYun::X_GMKERL_UNSHARP => True // 是否进行锐化处理
				    );
				$fh = fopen($file['full_path'], 'rb');
				$rsp = $upyun->writeFile('/b2c/'.$file['file_name'], $fh, True, $opts);   // 上传图片，自动创建目录
				fclose($fh);
				echo json_encode(array('state'=>true,'filename'=>$file['file_name']));
			}catch(Exception $e) {
				echo json_encode(array('state'=>false,'msg'=>$e->getMessage()));
			}
		}
	}
}