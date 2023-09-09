<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class User_model extends CI_Model
{

	public function __construct()
	{
		parent::__construct();
	}
  public function is_valid_login($username,$password)
  {
    // $password = md5($password);
    $this->db->select('id,name,apikey');
    $this->db->from('users');
		$this->db->where('username',$username);
		$this->db->where('password',$password);
	  $result = $this->db->get()->row_array();
    return $result;
  }

	public function update_profile($data)
	  {
			$user_id = $this->session->userdata('user_id');
	    $results = $this->db->update('users', $data, array('id'=>$user_id));
	    return $results;
	  }

		public function change_password($user_id,$confirm_password,$current_password)
		{

	        // $current_password = md5($current_password);
	        $this->db->where('id', $user_id);
	        $this->db->where(array('password'=>$current_password));
	        $record = $this->db->count_all_results('users');

	        if($record > 0){

	          // $confirm_password = md5($confirm_password);
	          $this->db->where('id', $user_id);
	          return $this->db->update('users',array('password'=>$confirm_password));
	        }else{
	          return 2;
	        }
		}
		public function user_details($id)
		{
			return $this->db->get_where('users',array('id'=>$id))->row_array();
		}

}
?>
