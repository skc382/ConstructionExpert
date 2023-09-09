<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Admin_model extends CI_Model
{

	public function __construct()
	{
		parent::__construct();
	}
  public function is_valid_login($username,$password)
  {
    // $password = md5($password);
    $this->db->select('user_id, profile_img,token,role');
    $this->db->from('administrators');
		$this->db->where('username',$username);
		$this->db->where('password',$password);
		$this->db->where_in('role',[1,2]);
	  $result = $this->db->get()->row_array();
    return $result;
  }

    public function admin_details($user_id)
	{
		$results = array();
		$results = $this->db->get_where('administrators',array('user_id'=>$user_id))->row_array();
		return $results;
	}

	public function update_profile($data)
	  {
			$user_id = $this->session->userdata('admin_id');
	    $results = $this->db->update('administrators', $data, array('user_id'=>$user_id));
	    return $results;
	  }

		public function change_password($user_id,$confirm_password,$current_password)
		{

	        $current_password = md5($current_password);
	        $this->db->where('user_id', $user_id);
	        $this->db->where(array('password'=>$current_password));
	        $record = $this->db->count_all_results('administrators');

	        if($record > 0){

	          // $confirm_password = md5($confirm_password);
	          $this->db->where('user_id', $user_id);
	          return $this->db->update('administrators',array('password'=>$confirm_password));
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
