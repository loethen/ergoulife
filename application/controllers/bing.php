<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Bing extends CI_Controller{
	function __construct(){
		parent::__construct();
	}
	function bing_proxy(){
 		$acctKey = 'R1vjR4XIMYfnaj0FUZjUmKrV8WAQGP5Bh3t6rvItfDM=';
		$rootUri = 'https://api.datamarket.azure.com/Bing/Search/v1';
		$key = $_GET['query'];
		$query = urlencode($key);
		$requestUri = "$rootUri/Image?\$format=json&Query=%27$query%27";
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
}