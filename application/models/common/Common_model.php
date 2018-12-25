<?php

Class Common_model extends CI_Model {
	//public $db2;
    function __construct() {
        parent::__construct();
		$this->load->database();
		$this->load->library('session');
		$this->db2 = $this->load->database($this->set_db_config(), TRUE);
    }

   function set_db_config(  ) {
        $config['hostname'] = DB_HOST;
		$config['username'] = DB_USERNAME;
		$config['password'] = DB_PASSWORD;
		$config['database'] = $this->session->userdata('db_name');
		$config['dbdriver'] = 'mysqli';
		$config['dbprefix'] = '';
		$config['pconnect'] = FALSE;
		$config['db_debug'] = TRUE;
		$config['cache_on'] = FALSE;
		$config['cachedir'] = '';
		$config['char_set'] = 'utf8';
		$config['dbcollat'] = 'utf8_general_ci';
        return $config;
	}
	
	function get_device_details($type, $imei)
	{
		$val =array();
		$device_data = $this->get_device_data_details( $type, $imei );
		$error_data = $this->get_error_data_details( $type, $imei );
		if(!empty($device_data) && !empty($error_data))
		{
			$device_time = strtotime($device_data->Date_S.' '.$device_data->Time_S);
			$error_time = strtotime($error_data->Date_S.' '.$error_data->Time_S);

			$val =$error_data;
			if($device_time > $error_time)
			{
				$val =$device_data;
			}
		}
		return $val;		
	}
    function get_device_data_details( $type , $imei) {
		//skip for format type 1
		($type == 1? $type = "" : $type = "_f".$type);
		$this->db2->select('*')->from('device_data'.$type);
		$this->db2->where('IMEI',$imei);
		$this->db2->order_by('Record_Index','DESC');
		$this->db2->limit(1);
		$query = $this->db2->get();
		//echo $this->db2->last_query();
        return $query->row();
	}
	
	function get_error_data_details( $type, $imei ) {
		//skip for format type 1
		($type == 1? $type = "" : $type = "_f".$type);
		$this->db2->select('*')->from('error_data'.$type);
		$this->db2->where('IMEI',$imei);
		$this->db2->order_by('Record_Index','DESC');
		$this->db2->limit(1);
		$query = $this->db2->get();
		//echo $this->db2->last_query();
          return $query->row();
    }
	
	function getDeviceList(  ) {
        $result = array();
	
		$Account_ID = $this->session->userdata('account_id');

        $this->db->select('IMEI, Format_Type , (SELECT  count(*) as cnt FROM `device_register` WHERE `Account_ID` = '.$Account_ID.') as cnt')
				->where('Account_ID',$Account_ID);
				//->where_not_in('Format_Type',1);
		$query = $this->db->get('device_register');
    
        return $query->result();
	}
	
	function get_region_site_list(  ) {
        $result = array();
	
		$Account_ID = $this->session->userdata('account_id');

        $this->db->select('Site_Location,Region, Device_Name, Format_Type,IMEI, LOC_No, capacity, Connect_Feeder')
				->where('Account_ID',$Account_ID)
				->where("Region!=''");
			//	->group_by('Region,Site_Location');
        $query = $this->db->get('device_register');
        return $query->result_array();
    }

   
}

?>
