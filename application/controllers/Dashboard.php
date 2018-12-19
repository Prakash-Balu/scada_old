<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
                                          
class Dashboard extends CI_Controller {
 
	public $sessionUsername;
	public $sessionDbname;
	function __construct(){	
		parent::__construct();
		$this->load->helper(array('url', 'language'));	
		$this->load->helper('form');
		$this->load->library('session');
		$this->sessionUsername = $this->session->userdata('username');
		$this->sessionDbname = $this->session->userdata('db_name');
		if(empty($this->sessionUsername)){
			redirect('');
		}
		$this->load->view('layout/header');
		$this->load->model("common/Common_model");
		$config = $this->Common_model->set_db_config($this->sessionDbname);
		$this->db2 = $this->load->database($config, TRUE);
	}
 
	function index() {
		$type_list = array(7,8);//get devic type list
		$data['green']=$data['blue']=$data['red']=$data['gray']=array();
		if(!empty($type_list))
		{
			$green_array = array('Run', 'RUN', 'M/C Running', 'M/C Running');
			$blue_array = array('GRIDDROP', 'griddrop', 'Grid Drop', 'Grid Drop');
			$red_array = array_merge($green_array,$blue_array);
			$i=0;
			$green=$blue=$red=$gray=array();
			foreach($type_list as $list)
			{
				$val	=	$this->Common_model->get_device_details( $list );
				//print_r($val->Status);
				
				if(in_array($val->Status,$green_array))
				{
					$green[] = $val;
				}elseif(in_array($val->Status,$blue_array)){
					$blue[] = $val;
				}elseif(in_array($val->Status,$red_array)){
					$red[] = $val;
				}else{
					$gray[] = $val;
				}
				
			}
			$data['response']['green'] = array('count'=> count($green),'name'=>'WTG RUN','total'=>0);
			$data['response']['red']= array('count'=> count($red),'name'=>'WTG GRID DROP','total'=>0);
			$data['response']['blue']= array('count'=> count($blue),'name'=>'WTG ERROR','total'=>0);
			$data['response']['gray']= array('count'=> count($gray),'name'=>'WTG SCADA OFF','total'=>0);
		}
		
		$this->load->view('dashboard/index',$data);
	}
	
	function chart1() {
		
		echo json_encode($data['chart']);exit;
	}
	
	
 
}


 
?>
