<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Create extends CI_Controller{
	function __construct(){
		parent::__construct();
	}
	function index(){
		$this->load->view('include/header');
		$this->load->view('create');
		$this->load->view('include/footer');
	}
}