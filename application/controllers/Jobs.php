<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jobs extends CI_Controller {

  public function __construct(){
      parent::__construct();  
      $this->data['base_url'] = base_url();
      $this->data['csrf'] = array(
    'name' => $this->security->get_csrf_token_name(),
    'hash' => $this->security->get_csrf_hash()
    );    


  }
  public function check_login(){
    if(!$this->session->userdata('admin_session')){    
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
        'title'=>'Jobs',
        'page'=>'job'
      ); 
      $this->load->vars($this->data);
      $this->template->adminview('jobs',$data,FALSE);   
    }
  }
  public function viewjobrefno(){    
    $chk = $this->check_login();
    if($chk){
      $data=array(
        'title'=>'View Applicants',
        'page'=>'refno',
        'jobs'=>$this->db->get_where('appliedjobs',array('jobid'=>$this->uri->segment(2)))->result()
      );
      $this->load->vars($this->data);
      $this->template->adminview('viewrefno',$data,FALSE);   
    }
  }
  public function postjob(){    
    $chk = $this->check_login();
    if($chk){
      $data=array(
        'title'=>'Post an opportunity',
        'page'=>'addjob',
        'counties'=>$this->db->select('*')->from('countries')->get()->result_array(),
        'industries'=>$this->db->select('*')->from('industries')->get()->result_array()
      ); 
      $this->load->vars($this->data);
      $this->template->adminview('postjob',$data,FALSE);   
    }
  }

  public function editJob(){    
    $chk = $this->check_login();
    if($chk){
      $data=array(
        'title'=>'Edit Post an opportunity',
        'page'=>'editjob',
        'counties'=>$this->db->select('*')->from('countries')->get()->result_array(),
        'job'=>$this->db->get_where('jobs',array('jobid'=>$this->uri->segment(2)))->row(),
        'industries'=>$this->db->select('*')->from('industries')->get()->result_array()
      ); 
      $this->load->vars($this->data);
      $this->template->adminview('editjob',$data,FALSE);   
    }
  }

  public function jobs_list($value='')
  {
    $draw = intval($this->input->get("draw"));
    $start = intval($this->input->get("start"));
    $length = intval($this->input->get("length"));

    $query = $this->db->select('*')->from('jobs')
             ->join('countries','countries.cid=jobs.cid')
             ->get();
    $data = [];  $sno = 1; 
    foreach($query->result() as $r) {
     		
      $tab=array();
      $tab[]=$sno;
      $tab[]=$r->country;
      $tab[]=$r->company;
      $tab[]=$r->jobtitle;
      $tab[]=$r->town;
      $tab[]=$r->noposition;
      $tab[]=($r->status == 1) ? '<i class="fe fe-check text-success"></i>' : '<i class="fa fa-ban text-danger"></i>';
      $status =  ($r->status == 1) ? '<a href="#"  class="btn btn-sm bg-warning reject-job" title="Delete" id="'.$r->jobid.'"><i class="fa fa-ban fa-fw"></i>Reject</a>' :            
      '<a href="#"  class="btn btn-sm bg-success approve-jobs" title="Delete" id="'.$r->jobid.'"><i class="fa fa-ban fa-fw "></i>Approve</a>';
      
      $tab[]=
      '<div class="actions text-right">      
      <a href="'.base_url().'view-refno/'.$r->jobid.'" class="btn btn-sm bg-info-light" title="View Letter of introduction reference number" id="'.$r->cid.'"><i class="fe fe-eye"></i> View Ref.No</a>
              <a href="'.base_url().'edit-job/'.$r->jobid.'" class="btn btn-sm bg-success-light" title="Edit" id="'.$r->cid.'"><i class="fe fe-pencil"></i> Edit</a>
              <a href="#" class="btn btn-sm bg-danger-light delete-jobs" title="Delete" id="'.$r->jobid.'"><i class="fe fe-trash"></i>Delete</a>'.$status.
              '</div>';
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
  public function delete_job(){  
    if($this->db->delete('jobs',array('jobid'=>$this->input->post('id')))){
    
      echo json_encode(["status"=>1,"msg"=>"job deleted successfully"]);
    }else{
      echo json_encode(["status"=>0,"msg"=>"error!"]);
    }    
  }
  public function approve_job(){  
    $this->db->where('jobid',$this->input->post('id'));
    if($this->db->update('jobs',array('status'=>1))){
    
      echo json_encode(["status"=>1,"msg"=>"job approved!"]);
    }else{
      echo json_encode(["status"=>0,"msg"=>"error!"]);
    }    
  }
  public function ban_job(){  
    $this->db->where('jobid',$this->input->post('id'));
    if($this->db->update('jobs',array('status'=>0))){
    
      echo json_encode(["status"=>1,"msg"=>"job rejected!"]);
    }else{
      echo json_encode(["status"=>0,"msg"=>"error!"]);
    }    
  }
  public function add_job(){   
    if($this->input->post('action') == 'add'){
      if($this->db->insert('jobs',array(
        'jobtype'=>$this->input->post('jobtype'), 
        'jobdate'=>date('Y-m-d',strtotime($this->input->post('jobdate'))), 
        'company'=>$this->input->post('cname'), 
        'jobtitle'=>$this->input->post('title'),
        'jobdesc'=>htmlentities($this->input->post('jobdesc')), 
        'noposition'=>$this->input->post('nopost'), 
        'industryid'=>$this->input->post('indid'),
        'cid'=>$this->input->post('county'),
        'town'=>$this->input->post('town'), 
        'street'=>$this->input->post('street'), 
        'building'=>$this->input->post('building'), 
        'floor'=>$this->input->post('floor'), 
        'doorno'=>$this->input->post('doorno'), 
        'status'=>1
      ))){
        echo json_encode(["status"=>1,"msg"=>"job posted successfully"]);
      }else{
        echo json_encode(["status"=>0,"msg"=>"error!"]);
      }
    }
    if($this->input->post('action') == 'edit'){
      $this->db->where('jobid',$this->input->post('jobid'));
      if($this->db->update('jobs',array(
        'jobtype'=>$this->input->post('jobtype'), 
        'jobdate'=>date('Y-m-d',strtotime($this->input->post('jobdate'))), 
        'company'=>$this->input->post('cname'), 
        'jobtitle'=>$this->input->post('title'),
        'jobdesc'=>htmlentities($this->input->post('jobdesc')), 
        'noposition'=>$this->input->post('nopost'), 
        'industryid'=>$this->input->post('indid'),
        'cid'=>$this->input->post('county'),
        'town'=>$this->input->post('town'), 
        'street'=>$this->input->post('street'), 
        'building'=>$this->input->post('building'), 
        'floor'=>$this->input->post('floor'), 
        'doorno'=>$this->input->post('doorno'), 
        'status'=>1
      ))){
        echo json_encode(["status"=>1,"msg"=>"job updated successfully"]);
      }else{
        echo json_encode(["status"=>0,"msg"=>"error!"]);
      }
    }

  }
  public function user_add_job(){   
    if($this->input->post('action') == 'add'){
      if($this->db->insert('jobs',array(
        'jobtype'=>$this->input->post('jobtype'), 
        'jobdate'=>date('Y-m-d',strtotime($this->input->post('jobdate'))), 
        'company'=>$this->input->post('cname'), 
        'jobtitle'=>$this->input->post('title'),
        'jobdesc'=>htmlentities($this->input->post('jobdesc')), 
        'noposition'=>$this->input->post('nopost'), 
        'industryid'=>$this->input->post('indid'),
        'cid'=>$this->input->post('county'),
        'town'=>$this->input->post('town'), 
        'street'=>$this->input->post('street'), 
        'building'=>$this->input->post('building'), 
        'floor'=>$this->input->post('floor'), 
        'doorno'=>$this->input->post('doorno'), 
        'status'=>0
      ))){
        echo json_encode(["status"=>1,"msg"=>"job posted successfully"]);
      }else{
        echo json_encode(["status"=>0,"msg"=>"error!"]);
      }
    }

  }
  public function updateCountry(){
    $numrows = $this->db->select('*')
              ->from('countries')
              ->where('country',$this->input->post('ecountry'))
              ->where('cid!=',$this->input->post('ecid'))
              ->get()->num_rows();
     
    if($numrows == 0){
         $this->db->where('cid',$this->input->post('ecid'));
        if($this->db->update('countries',array('country'=>$this->input->post('ecountry')))){
          echo json_encode(["status"=>1,"msg"=>"done"]);
        }else{
          echo json_encode(["status"=>0,"msg"=>"error!"]);
        }
    }else{
      echo json_encode(["status"=>0,"msg"=>"Already country exist!"]);
    }
  }
  public function getCountrybyid(){
    $q=$this->db->get_where('countries',array('cid'=>$this->input->post('id')))->row();  
    echo json_encode($q);
  }
 
  public function jobsreferenceno($value='')
  {
    $draw = intval($this->input->get("draw"));
    $start = intval($this->input->get("start"));
    $length = intval($this->input->get("length"));
   
    $jobid = $this->uri->segment(2);
    $query = $this->db->query("select * from appliedjobs where jobid=$jobid");
    $data = [];  $sno = 1; 
    print_r($query->result());
    foreach($query->result() as $r) {
     		
      $tab=array();
      $tab[]=$sno;
      $tab[]=$r->surname;
      $tab[]=$r->email;
      $tab[]=$r->refno;
      $tab[]=date('d-m-Y',strtotime($r->applieddate));   
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

}
?>