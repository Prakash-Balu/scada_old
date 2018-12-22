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
        $config['hostname'] = 'mysqlhost';
		$config['username'] = 'root';
		$config['password'] = 'mysql';
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
	
	function get_device_details($type)
	{
		$device_data = $this->get_device_data_details( $type );
		$error_data = $this->get_error_data_details( $type );
		
		$device_time = strtotime($device_data->Date_S.' '.$device_data->Time_S);
		$error_time = strtotime($error_data->Date_S.' '.$error_data->Time_S);

		$val =$error_data;
		if($device_time > $error_time)
		{
			$val =$device_data;
		}
		return $val;		
	}
    function get_device_data_details( $type ) {
		$this->db2->select('*')->from('device_data_f'.$type);
		$this->db2->order_by('Record_Index','DESC');
		$this->db2->limit(1);
		$query = $this->db2->get();
        return $query->row();
	}
	
	function get_error_data_details( $type ) {
		$this->db2->select('*')->from('error_data_f'.$type);
		$this->db2->order_by('Record_Index','DESC');
		$this->db2->limit(1);
		$query = $this->db2->get();
          return $query->row();
    }
	
	function getDeviceList(  ) {
        $result = array();
	
		$Account_ID = $this->session->userdata('account_id');

        $this->db->select('distinct(Format_Type) as Format_Type')
				->where('Account_ID',$Account_ID)
				->where_not_in('Format_Type',1);
        $query = $this->db->get('device_register');
        
        return array_column($query->result_array(), 'Format_Type');
    }

   
}

?>
