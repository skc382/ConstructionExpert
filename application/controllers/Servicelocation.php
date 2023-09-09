<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Servicelocation extends CI_Controller {

  public function __construct(){
      parent::__construct();  
      $this->load->model('Home_model','home');  
      $this->data['base_url'] = base_url();
      $this->data['web'] = $this->home->getWebsiteSettings();
      $this->data['csrf'] = array(
    'name' => $this->security->get_csrf_token_name(),
    'hash' => $this->security->get_csrf_hash()
    );    


  }
  public function check_login(){
    if(!$this->session->userdata('admin_session')){   
      $this->data['title']='Admin Login';    
      $this->load->vars($this->data);
      $this->load->view('admin/login',$this->data);     
    }else{
      return true;
    }
  }  
  public function index(){    
    $chk = $this->check_login();
    if($chk){
      $data=array(
        'title'=>'Service Location',
        'page'=>'location'
      ); 
      $this->load->vars($this->data);
      $this->template->adminview('location',$data,FALSE);   
    }
  }

  public function location_list($value='')
  {
    $draw = intval($this->input->get("draw"));
    $start = intval($this->input->get("start"));
    $length = intval($this->input->get("length"));

    $query = $this->db->get("location ");
    $data = [];  $sno = 1; 
    foreach($query->result() as $r) {
     		
      $tab=array();
      $tab[]=$sno;    
      $tab[]=$r->location;
      $tab[]='<div class="actions text-right">
              <a href="#" class="btn btn-sm bg-success-light edit-loc" title="Edit" id="'.$r->locid.'"><i class="fe fe-pencil"></i> Edit</a>
              <a href="#" class="btn btn-sm bg-danger-light delete-loc" title="Delete" id="'.$r->locid.'"><i class="fe fe-trash"></i>Delete</a></div>';
       $data[] = $tab; 
         $sno=$sno+1;
          
    }

    $result = array(
               "draw" => $draw,
               "recordsTotal" => $query->num_rows(),
               "recordsFiltered" => $query->num_rows(),
               "data" => $data
          );
    echo json_encode($result);
  }
  public function delete_loc(){  
    if($this->db->delete('location',array('locid'=>$this->input->post('id')))){
      echo json_encode(["status"=>1,"msg"=>"done"]);
    }else{
      echo json_encode(["status"=>0,"msg"=>"error!"]);
    }    
  }
  public function add_loc(){

    $numrows = $this->db->get_where('location',array('location'=>$this->input->post('tagname')))->num_rows();
    if($numrows == 0){
        if($this->db->insert('location',array('location'=>$this->input->post('tagname')))){
          echo json_encode(["status"=>1,"msg"=>"done"]);
        }else{
          echo json_encode(["status"=>0,"msg"=>"error!"]);
        }
    }else{
      echo json_encode(["status"=>0,"msg"=>"Already location exist!"]);
    }
  }
  public function updateLoc(){

    $numrows = $this->db->select('*')
              ->from('location')
              ->where('location',$this->input->post('etagname'))
              ->where('locid!=',$this->input->post('etagid'))
              ->get()->num_rows();
     
    if($numrows == 0){
         $this->db->where('locid',$this->input->post('etagid'));
        if($this->db->update('location',array('location'=>$this->input->post('etagname')))){
          echo json_encode(["status"=>1,"msg"=>"done"]);
        }else{
          echo json_encode(["status"=>0,"msg"=>"error!"]);
        }
    }else{
      echo json_encode(["status"=>0,"msg"=>"Already tag exist!"]);
    }
  }
  public function getTagbyid(){
    $q=$this->db->get_where('location',array('locid'=>$this->input->post('id')))->row();  
    echo json_encode($q);
  }



}
?>