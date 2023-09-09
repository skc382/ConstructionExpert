<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard_model extends CI_Model {

	public function __construct() {

        parent::__construct();
        $this->load->database();
        date_default_timezone_set('UTC');
    }
	 
		public function admin_details($user_id)
		{
			$results = array();
			$results = $this->db->get_where('users',array('user_id'=>$user_id))->row_array();
			return $results;
		}

		public function update_profile($data)
	  {
			$user_id = $this->session->userdata('admin_id');
	    $results = $this->db->update('users', $data, array('user_id'=>$user_id));
	    return $results;
	  }

		public function change_password($user_id,$confirm_password,$current_password)
		{

	        $current_password = md5($current_password);
	        $this->db->where('user_id', $user_id);
	        $this->db->where(array('password'=>$current_password));
	        $record = $this->db->count_all_results('users');

	        if($record > 0){

	          $confirm_password = md5($confirm_password);
	          $this->db->where('user_id', $user_id);
	          return $this->db->update('users',array('password'=>$confirm_password));
	        }else{
	          return 2;
	        }
		}


	   


}

/* End of file Api_model.php */
/* Location: ./application/models/Api_model.php */
