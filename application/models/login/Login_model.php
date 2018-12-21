<?php

Class Login_model extends CI_Model {

    function __construct() {
        parent::__construct();
		$this->load->database();
    }

    function loginValidation( $options ) {
		/** variable declarion*/
        $userDetail = array();
		$username = (!empty($options['username'])) ? $this->specialCharacterRemoval($options['username']) : '';
		$password = (!empty($options['password'])) ? $options['password'] : '';

		/** validate empty or not */
        if (empty($username) || empty($password))
            return $userDetail;
		
		/** convert password md5 format*/
        $pass = $password;
		
		/** check login credential using username*/
        $userDetail = $this->getLoginUserCredentialDetail($username);

		/** validate user given password vs DB password */
        if (!empty($userDetail) && $pass) {
            if ($userDetail['0']['password'] != $pass) {
                $userDetail = array();
            }
        }
        return $userDetail;
    }

    function getLoginUserCredentialDetail( $username ) {
        $result = array();
        if (empty($username)) {
            return $result;
        }

		$this->db->select('Password as password,Username as username, Parent_ID,Db_Name,User_Type_ID')
				->where('Username',$username);
		$query = $this->db->get('user_master');
        
        return $query->result_array();
    }

    function getDeviceList( $username ) {
        $result = array();
        if (empty($username)) {
            return $result;
        }

        $this->db->select('username, device_type')
                ->where('username',$username);
        $query = $this->db->get('device_master');
        
        return array_column($query->result_array(), 'device_type');
    }
	
	 function specialCharacterRemoval( $string ) {
       return preg_replace('#[^\w()/.%\-]#'," ", $string);
    }

   
}

?>