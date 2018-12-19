<?php

Class Common_model extends CI_Model {

    function __construct() {
        parent::__construct();
	$this->load->database();
    }

   function set_db_config( $dbname ) {
       $config['hostname'] = 'mysqlhost';
		$config['username'] = 'root';
		$config['password'] = 'mysql';
		$config['database'] = $dbname;
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
	
	

   
}

?>
