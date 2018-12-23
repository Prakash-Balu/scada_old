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
		$this->db2 = $this->load->database($this->Common_model->set_db_config(), TRUE);
	}
 
	function index() {
		
		$type_list = $this->Common_model->getDeviceList(  );//get devic type list
		//print_r($type_list);
		$data['green']=$data['blue']=$data['red']=$data['gray']=array();
		$total_device = count($type_list);
		if(!empty($type_list))
		{
			$green_array = array('Run', 'RUN', 'M/C Running', 'M/C Running');
			$blue_array = array('GRIDDROP', 'griddrop', 'Grid Drop', 'Grid Drop');
			$red_array = array_merge($green_array,$blue_array);
			$total_count=0;
			$i=0;
			$green=$blue=$red=$gray=array();
			
			foreach($type_list as $list)
			{
				$val	=	$this->Common_model->get_device_details( $list->Format_Type, $list->IMEI );
				
				if(!empty($val))
				{
					/** get current time from DB and then check device date is less then 1 hour for current time */
					$query = $this->db2->query('select (NOW() - INTERVAL 2 HOUR) as curr_time', TRUE);
					$curr_time = strtotime($query->row()->curr_time);

					$device_time = strtotime($val->Date_S.' '.$val->Time_S);
					/** less then 1 hour for current time then it's gray color*/
					if($device_time > $curr_time)
					{
						$gray[] = $val;
					}
					elseif(in_array($val->Status,$green_array))
					{
						$green[] = $val;
					}elseif(in_array($val->Status,$blue_array)){
						$blue[] = $val;
					}elseif(in_array($val->Status,$red_array)){
						$red[] = $val;
					}
				}
				$total_count = $list->cnt;
			}
			$data['response']['green'] = array('count'=> count($green),'name'=>'WTG RUN','total'=>$total_count);
			$data['response']['red']= array('count'=> count($red),'name'=>'WTG GRID DROP','total'=>$total_count);
			$data['response']['blue']= array('count'=> count($blue),'name'=>'WTG ERROR','total'=>$total_count);
			$data['response']['gray']= array('count'=> count($gray),'name'=>'WTG SCADA OFF','total'=>$total_count);
		}
		
		$this->load->view('dashboard/index',$data);
	}
	
	function chart1() {
		
		echo json_encode($data['chart']);exit;
	}
	
	
 
}


 
?>
