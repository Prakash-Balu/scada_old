<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
                                          
class Dashboard extends CI_Controller {
 
	public $sessionUsername;
	function __construct(){	
		parent::__construct();
		$this->load->helper(array('url', 'language'));	
		$this->load->helper('form');
		$this->load->library('session');
		$this->sessionUsername = $this->session->userdata('username');
		if(empty($this->sessionUsername)){
			redirect('');
		}
		$this->load->view('layout/header');
		$this->load->model("login/Login_model");
	}
 
	function index() {
		$this->load->view('dashboard/index');
	}
	
	function chart1() {
		$data['chart']	=	$this->Login_model->loginValidation( $formvalues );
		//$this->load->view('dashboard/index',$data);

		echo json_encode($data['chart']);exit;
	}
	
	
 
}


 
?>