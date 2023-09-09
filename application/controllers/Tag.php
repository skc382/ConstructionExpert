<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tag extends CI_Controller {

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
        'title'=>'Tags',
        'page'=>'tags'
      ); 
      $this->load->vars($this->data);
      $this->template->adminview('tags',$data,FALSE);   
    }
  }

  public function tag_list($value='')
  {
    $draw = intval($this->input->get("draw"));
    $start = intval($this->input->get("start"));
    $length = intval($this->input->get("length"));

    $query = $this->db->get("tags");
    $data = [];  $sno = 1; 
    foreach($query->result() as $r) {
     		
      $tab=array();
      $tab[]=$sno;    
      $tab[]=$r->tagname;
      $tab[]='<div class="actions text-right">
              <a href="#" class="btn btn-sm bg-success-light edit-tag" title="Edit" id="'.$r->tagid.'"><i class="fe fe-pencil"></i> Edit</a>
              <a href="#" class="btn btn-sm bg-danger-light delete-tag" title="Delete" id="'.$r->tagid.'"><i class="fe fe-trash"></i>Delete</a></div>';
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
  public function delete_tag(){  
    if($this->db->delete('tags',array('tagid'=>$this->input->post('id')))){
      echo json_encode(["status"=>1,"msg"=>"done"]);
    }else{
      echo json_encode(["status"=>0,"msg"=>"error!"]);
    }    
  }
  public function add_tag(){

    $numrows = $this->db->get_where('tags',array('tagname'=>$this->input->post('tagname')))->num_rows();
    if($numrows == 0){
        if($this->db->insert('tags',array('tagname'=>$this->input->post('tagname')))){
          echo json_encode(["status"=>1,"msg"=>"done"]);
        }else{
          echo json_encode(["status"=>0,"msg"=>"error!"]);
        }
    }else{
      echo json_encode(["status"=>0,"msg"=>"Already tag exist!"]);
    }
  }
  public function updateTag(){

    $numrows = $this->db->select('*')
              ->from('tags')
              ->where('tagname',$this->input->post('etagname'))
              ->where('tagid!=',$this->input->post('etagid'))
              ->get()->num_rows();
     
    if($numrows == 0){
         $this->db->where('tagid',$this->input->post('etagid'));
        if($this->db->update('tags',array('tagname'=>$this->input->post('etagname')))){
          echo json_encode(["status"=>1,"msg"=>"done"]);
        }else{
          echo json_encode(["status"=>0,"msg"=>"error!"]);
        }
    }else{
      echo json_encode(["status"=>0,"msg"=>"Already tag exist!"]);
    }
  }
  public function getTagbyid(){
    $q=$this->db->get_where('tags',array('tagid'=>$this->input->post('id')))->row();  
    echo json_encode($q);
  }



}
?>