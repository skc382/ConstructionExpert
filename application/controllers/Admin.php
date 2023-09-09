<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

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
     if(!$this->session->userdata('admin_session')){ 
      $this->data['title']='Admin Login';
        $this->load->vars($this->data);
        $this->load->view('admin/login',$this->data);     
      }else{
        $this->dashboard();
      }
  }
  public function processLogin(){
    if($this->input->is_ajax_request()){
      $this->form_validation->set_rules('username','Username','required');        
      $this->form_validation->set_rules('password','Password','required');
        if ($this->form_validation->run()) {
            $array=array(
              'username'=>$this->input->post('username'),
              'password'=>sha1($this->input->post('password')),
              'roleid'=>1
               );
            $this->db->select('*');
            $this->db->from('users');
            $this->db->where($array);
            $query = $this->db->get();
              if($query->num_rows() == 1){
                $row=$query->row();
                $sessiondata=array(
                  'authid'=>$row->userid,
                  'username'=>$row->username,
                  'email'=>$row->email
                );
                $this->session->set_userdata('ci_session_key_generate', TRUE);
                $this->session->set_userdata('admin_session', $sessiondata);
                
                echo json_encode(["status"=>1,"msg"=>"Login successful"]);
                
              }else{
                echo json_encode(["status"=>0,"msg"=>"Invalid Login!"]);
              }

        } else {
          $error=validation_errors();
          echo json_encode(["status"=>0,"msg"=>$error]);
        }
     
    }
  }
  public function dashboard(){  
    $chk = $this->check_login();
    if($chk){
      $data=array(
        'title'=>'Dashboard',
        'page'=>'dashboard'
      ); 
      $this->load->vars($this->data);
      $this->template->adminview('dashboard',$data,FALSE);   
    }     
  }
  public function logout()
	{
    $this->session->unset_userdata('admin_session');
    $this->session->unset_userdata('ci_session_key_generate');    
    $this->session->sess_destroy();
    $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, no-transform, max-age=0,post-check=0,pre-check=0');
    $this->output->set_header('Pragma: no-cache');
    $this->index();
  }
  public function serviceproviders(){    
    $chk = $this->check_login();
    if($chk){
      $data=array(
        'title'=>'Service Providers',
        'page'=>'srs'
      ); 
      $this->load->vars($this->data);
      $this->template->adminview('serviceproviders',$data,FALSE);   
    }
  }
  public function user_services(){    
    $chk = $this->check_login();
    if($chk){
      $data=array(
        'title'=>'Service Provider Services',
        'page'=>'usrsrs',
        'serviceid'=>$this->uri->segment(2)
      ); 
      $this->load->vars($this->data);
      $this->template->adminview('userservices',$data,FALSE);   
    }
  }

  public function enquiries(){    
    $chk = $this->check_login();
    if($chk){
      $data=array(
        'title'=>'Customer Ads',
        'page'=>'enquiries'
      ); 
      $this->load->vars($this->data);
      $this->template->adminview('enquiries',$data,FALSE);   
    }
  }

  public function invitesrs(){    
    $chk = $this->check_login();
    if($chk){
      $data=array(
        'title'=>'Invite Service Provider',
        'page'=>'invitesrs',
        'enqdet'=>$this->home->get_ad_details()
      ); 
      $this->load->vars($this->data);
      $this->template->adminview('invitesrs',$data,FALSE);   
    }
  }


  public function jobnotification(){    
    $chk = $this->check_login();
    if($chk){
      $data=array(
        'title'=>'Job Request',
        'page'=>'jobnotify',
        'enqdet'=>$this->home->get_ad_details()
      ); 
      $this->load->vars($this->data);
      $this->template->adminview('invitations',$data,FALSE);   
    }
  }

  public function workroom(){    
    $chk = $this->check_login();
    if($chk){
      $data=array(
        'title'=>'Chat',
        'page'=>'chat',
        'custjobdet'=>$this->home->get_customer_chatmsg_chatid($this->uri->segment(2)),
        'srsdet'=>$this->home->get_serviceprovider_chatmsg_chatid($this->uri->segment(2))
      ); 
      $this->load->vars($this->data);
      $this->template->adminview('chat',$data,FALSE);   
    }
  }

  public function loadmsg(){
    $res=$this->db->select('*')->from('workroom')->where('workroomid',$this->input->post('wrkid'))->get()->result_array();
    foreach ($res as $k) {
      echo '
      <div class="text-muted">
      '.date('d-M-Y',strtotime($k['msgdate'])).' :
      '.ucfirst($k['senderid']).' -
      '.$k['message'].'
      
      </div>';
    }
  }
  
  public function sendmsg(){
    $this->db->insert('workroom',array(
      'workroomid'=>$this->input->post('wrkid'),
      'senderid'=>$this->input->post('senderid'),
      'receiverid'=>$this->input->post('receiverid'),
      'message'=>$this->input->post('msg'),
      'issender_read'=>1
    ));
  }

  public function viewjobnotification(){
    $id = $this->input->post('id');
    $draw = intval($this->input->post("draw"));
    $start = intval($this->input->post("start"));
    $length = intval($this->input->post("length"));

    $query = $this->db->query("SELECT * FROM `jobinvitation` JOIN users on users.userid=jobinvitation.userid  WHERE jobinvitation.adid=$id order by invitationid desc");
    $data = [];  $sno = 1; 
    foreach($query->result() as $r) {
      $status = ($r->isonline == 1) ? 'avatar-online' : 'avatar-offline';
      $img = isset($r->profileimg) ? 'assets/img/author/thumb/'.$r->profileimg : 'assets/img/author/img1.jpg';
     $img = '<div class="avatar '.$status.'">
      <img class="avatar-img rounded-circle"  src="'.base_url().$img.'">   
      </div>';
      $tab=array();
      $tab[]=$sno;
      $tab[]=date('d-m-Y g:i A',strtotime($r->invitationdate));
      $tab[]=$img." ".$r->surname."<br><i class='fe fe-mail'></i> : ".$r->email."<br><i class='fe fe-phone'></i> : ".$r->phone;      
      $tab[]=($r->isadmin_approved == 1) ? '<span class="badge badge-pill badge-success">Approved</span>' : '<span class="badge badge-pill badge-warning">waiting for admin approval</span>';
      if($r->isadmin_approved == 1){
        $action = '<a href="#" class="btn btn-sm bg-danger-light unapprove-invite" title="Block" id="'.$r->invitationid.'">Block</a>';
      }else{
        $action = '<a href="#" class="btn btn-sm bg-primary-light approve-invite" title="Approve" id="'.$r->invitationid.'">Approve</a>';
      }
      $action .= '<a href="'.base_url().'work-room/'.$r->chatid.'" class="btn btn-sm bg-warning-light" title="Chat Room">Chat Room</a>';

      $tab[]=$action;
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

  public function approve_invitation(){  
    $this->db->where('invitationid',$this->input->post('id'));
    if($this->db->update('jobinvitation',array('isadmin_approved'=>1))){
    
      echo json_encode(["status"=>1,"msg"=>"done"]);
    }else{
      echo json_encode(["status"=>0,"msg"=>"error!"]);
    }    
  }

  public function unapprove_invitation(){  
    $this->db->where('invitationid',$this->input->post('id'));
    if($this->db->update('jobinvitation',array('isadmin_approved'=>0))){
    
      echo json_encode(["status"=>1,"msg"=>"done"]);
    }else{
      echo json_encode(["status"=>0,"msg"=>"error!"]);
    }    
  }

  public function newarticle(){    
    $chk = $this->check_login();
    if($chk){
      $data=array(
        'title'=>'Create a new post',
        'page'=>'createpost'
      ); 
      $this->load->vars($this->data);
      $this->template->adminview('createpost',$data,FALSE);   
    }
  }

  public function editarticle(){    
    $chk = $this->check_login();
    if($chk){
      $data=array(
        'title'=>'Edit Post',
        'page'=>'editpost',
        'postdet'=>$this->db->get_where('blogpost',array('blogid'=>$this->uri->segment(2)))->row_array()
      ); 
      $this->load->vars($this->data);
      $this->template->adminview('editpost',$data,FALSE);   
    }
  }

  public function updatepost(){
    $this->db->where('blogid',$this->input->post('blogid'));
    if($this->db->update('blogpost',array(
      'blogtitle'=>$this->input->post('title'),
      'blogcontent'=>$this->input->post('content')
    ))){
        echo "1";
    }
  }

  public function view_comments(){    
    $chk = $this->check_login();
    if($chk){
      $data=array(
        'title'=>'View Comments',
        'page'=>'comments',
        'cmt'=>$this->home->getallcommentsbypostid()
      ); 
      $this->load->vars($this->data);
      $this->template->adminview('viewcomments',$data,FALSE);   
    }
  }

  public function viewarticles(){    
    $chk = $this->check_login();
    if($chk){
      $data=array(
        'title'=>'View Posts',
        'page'=>'viewpost'
      ); 
      $this->load->vars($this->data);
      $this->template->adminview('viewpost',$data,FALSE);   
    }
  }

  public function addpost(){
    if($this->db->insert('blogpost',array(
      'blogtitle'=>$this->input->post('title'),
      'blogcontent'=>$this->input->post('content'),
      'postedby'=>$this->session->userdata('admin_session')['username']
    ))){
      echo json_encode(["status"=>1,"msg"=>"Post created successfully."]);
    }
  }


  public function viewblogposts(){
    $id = $this->input->post('id');
    $draw = intval($this->input->post("draw"));
    $start = intval($this->input->post("start"));
    $length = intval($this->input->post("length"));

    $query = $this->db->query("SELECT * FROM blogpost order by blogid desc");
    $data = [];  $sno = 1; 
    foreach($query->result() as $r) {    
      $tab=array();
      $tab[]=$sno;
      $tab[]=date('d-m-Y g:i A',strtotime($r->postdate));  
      $tab[]=$r->blogtitle;       
      $tab[]='<div class="actions text-right">
      <a href="'.base_url().'view-comments/'.$r->blogid.'" class="btn btn-sm bg-info-light" title="Edit" id="'.$r->blogid.'"><i class="fe fe-eye"></i> View Comments</a>
      <a href="'.base_url().'edit-post/'.$r->blogid.'" class="btn btn-sm bg-success-light" title="Edit" id="'.$r->blogid.'"><i class="fe fe-pencil"></i> Edit</a>
      <a href="#" class="btn btn-sm bg-danger-light delete-comments" title="Delete" id="'.$r->blogid.'"><i class="fe fe-trash"></i>Delete</a></div>';

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

  public function delete_post(){  
    if($this->db->delete('blogpost',array('blogid'=>$this->input->post('id')))){
    
      echo json_encode(["status"=>1,"msg"=>"done"]);
    }else{
      echo json_encode(["status"=>0,"msg"=>"error!"]);
    }    
  }

  public function viewblogcomments(){
    $id = $this->input->post('id');
    $draw = intval($this->input->post("draw"));
    $start = intval($this->input->post("start"));
    $length = intval($this->input->post("length"));

    $query = $this->db->select('*')->from('blogcomments')
    ->where('blogid',$this->input->post('id'))->get();
    $data = [];  $sno = 1; 
    foreach($query->result() as $r) {    
      $tab=array();
      $tab[]=$sno;      
      $tab[]=$r->fname . "<br>".$r->fmail. "<br>". date('d-m-Y g:i A',strtotime($r->cmtdate));  
      $tab[]=$r->message;  
      if($r->isapproved == 1){
        $action = '<a href="#" class="btn btn-sm bg-danger-light block-cmt" title="Block" id="'.$r->cmtid.'">Block</a>';
      }else{
        $action = '<a href="#" class="btn btn-sm bg-success-light approve-cmt" title="Approve" id="'.$r->cmtid.'">Approve</a>';
      }     
      $tab[]='<div class="actions text-right">'.$action.'   
      <a href="#" class="btn btn-sm bg-danger-light delete-comment" title="Delete" id="'.$r->cmtid.'"><i class="fe fe-trash"></i>Delete</a></div>';

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

  public function approve_comment(){
    $this->db->where('cmtid',$this->input->post('id'));
    if($this->db->update('blogcomments',array('isapproved'=>1))){
    
      echo json_encode(["status"=>1,"msg"=>"done"]);
    }else{
      echo json_encode(["status"=>0,"msg"=>"error!"]);
    } 
  }

  public function block_comment(){
    $this->db->where('cmtid',$this->input->post('id'));
    if($this->db->update('blogcomments',array('isapproved'=>0))){
    
      echo json_encode(["status"=>1,"msg"=>"done"]);
    }else{
      echo json_encode(["status"=>0,"msg"=>"error!"]);
    } 
  }

  public function delete_comment(){
    $this->db->where('cmtid',$this->input->post('id'));
    if($this->db->delete('blogcomments')){
    
      echo json_encode(["status"=>1,"msg"=>"done"]);
    }else{
      echo json_encode(["status"=>0,"msg"=>"error!"]);
    } 
  }

  public function viewmailinquiries(){
    $id = $this->input->post('id');
    $draw = intval($this->input->post("draw"));
    $start = intval($this->input->post("start"));
    $length = intval($this->input->post("length"));

    $query = $this->db->query("SELECT * FROM inquiries where catid is not null order by inquiryid desc");
    $data = [];  $sno = 1; 
    foreach($query->result() as $r) {  
        $getcat =  $this->home->getCategorybyid($r->catid);
      $tab=array();
      $tab[]=$sno;
      $tab[]=date('d-m-Y g:i A',strtotime($r->inquirydate));  
      $tab[]='Category :'.$getcat->category.'<br>Name: '.$r->fullname.'<br>Company Name: '.$r->companyname.'<br>Address:'.$r->address.'-'.$r->pincode.'<br>City:'.$r->city.'<br>Email:'.$r->email.'<br>Phone:'.$r->phone.'<br>';  
      $tab[]=$r->description;       
      if($r->isread == 1){
        $action = '<a href="#" class="btn btn-sm bg-danger-light unread-inquiry" title="Unread" id="'.$r->inquiryid.'">Unread</a>';
      }else{
        $action = '<a href="#" class="btn btn-sm bg-success-light read-inquiry" title="Read" id="'.$r->inquiryid.'">Read</a>';
      }     
      $tab[]='<div class="actions text-right">'.$action.'   
      <a href="#" class="btn btn-sm bg-danger-light delete-inquiry" title="Delete" id="'.$r->inquiryid.'"><i class="fe fe-trash"></i>Delete</a></div>';

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


  public function mailinquiries(){    
    $chk = $this->check_login();
    if($chk){
      $data=array(
        'title'=>'Customer Email Enquiries',
        'page'=>'crinquiry'
      ); 
      $this->load->vars($this->data);
      $this->template->adminview('viewmailenquiries',$data,FALSE);   
    }
  }

  public function viewsrmailinquiries(){
    $id = $this->input->post('id');
    $draw = intval($this->input->post("draw"));
    $start = intval($this->input->post("start"));
    $length = intval($this->input->post("length"));

    $query = $this->db->query("SELECT * FROM inquiries where user_serviceid is not  null order by inquiryid desc");
    $data = [];  $sno = 1; 
    foreach($query->result() as $r) {   
        
      $tab=array();
      $tab[]=$sno;
      $tab[]=date('d-m-Y g:i A',strtotime($r->inquirydate));  
      $tab[]='Name: '.$r->fullname.'<br>Company Name: '.$r->companyname.'<br>Address:'.$r->address.'<br>Pincode:'.$r->pincode.'<br>City:'.$r->city.'<br>Email:'.$r->email.'<br>Phone:'.$r->phone.'<br>';  
      $tab[]='<a target="new" href='.BASE_URL() . 'serviceprovider-details/'.$r->user_serviceid.'>Service details</a><br>'.$r->description;       
      if($r->isread == 1){
        $action = '<a href="#" class="btn btn-sm bg-danger-light unread-inquiry" title="Unread" id="'.$r->inquiryid.'">Unread</a>';
      }else{
        $action = '<a href="#" class="btn btn-sm bg-success-light read-inquiry" title="Read" id="'.$r->inquiryid.'">Read</a>';
      }     
      $tab[]='<div class="actions text-right">'.$action.'   
      <a href="#" class="btn btn-sm bg-danger-light delete-inquiry" title="Delete" id="'.$r->inquiryid.'"><i class="fe fe-trash"></i>Delete</a></div>';

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

  public function srmailinquiries(){    
    $chk = $this->check_login();
    if($chk){
      $data=array(
        'title'=>'Customer Email Enquiries about Service',
        'page'=>'srinquiry'
      ); 
      $this->load->vars($this->data);
      $this->template->adminview('viewserviceinquiries',$data,FALSE);   
    }
  }

  public function delete_srinq(){  
    if($this->db->delete('inquiries',array('inquiryid'=>$this->input->post('id')))){
    
      echo json_encode(["status"=>1,"msg"=>"done"]);
    }else{
      echo json_encode(["status"=>0,"msg"=>"error!"]);
    }    
  }

  public function markread_inquriy(){  
    $this->db->where('inquiryid',$this->input->post('id'));
    if($this->db->update('inquiries',array('isread'=>1))){
    
      echo json_encode(["status"=>1,"msg"=>"done"]);
    }else{
      echo json_encode(["status"=>0,"msg"=>"error!"]);
    }    
  }

  public function markunread_inquriy(){  
    $this->db->where('inquiryid',$this->input->post('id'));
    if($this->db->update('inquiries',array('isread'=>0))){
    
      echo json_encode(["status"=>1,"msg"=>"done"]);
    }else{
      echo json_encode(["status"=>0,"msg"=>"error!"]);
    }    
  }

  public function viewfeedback(){    
    $chk = $this->check_login();
    if($chk){
      $data=array(
        'title'=>'View Testimonials',
        'page'=>'feedback'
      ); 
      $this->load->vars($this->data);
      $this->template->adminview('viewtestimonials',$data,FALSE);   
    }
  }

  public function viewfeedbacks(){
    $id = $this->input->post('id');
    $draw = intval($this->input->post("draw"));
    $start = intval($this->input->post("start"));
    $length = intval($this->input->post("length"));

    $query = $this->db->query("SELECT * FROM  testimonials order by tid desc");
    $data = [];  $sno = 1; 
    foreach($query->result() as $r) {    
      $tab=array();
      $tab[]=$sno;
      $tab[]=$r->name;  
      $tab[]=$r->feedback;       
      $tab[]='<div class="actions text-right">
      <a href="#" class="btn btn-sm bg-success-light edit-feed" title="Edit" id="'.$r->tid.'"><i class="fe fe-pencil"></i> Edit</a>
      <a href="#" class="btn btn-sm bg-danger-light delete-feed" title="Delete" id="'.$r->tid.'"><i class="fe fe-trash"></i>Delete</a></div>';

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

  public function add_feedback(){

        if($this->db->insert('testimonials',array(
          'name'=>$this->input->post('uname'),
          'feedback'=>$this->input->post('msg')
          ))){
          echo json_encode(["status"=>1,"msg"=>"done"]);
        }else{
          echo json_encode(["status"=>0,"msg"=>"error!"]);
        }
  }
  public function delete_feedback(){  
    if($this->db->delete('testimonials',array('tid'=>$this->input->post('id')))){
      echo json_encode(["status"=>1,"msg"=>"done"]);
    }else{
      echo json_encode(["status"=>0,"msg"=>"error!"]);
    }    
  }
  public function getfeedbyid(){
    $q=$this->db->get_where('testimonials',array('tid'=>$this->input->post('id')))->row();  
    echo json_encode($q);
  }
  public function updateFeed(){

         $this->db->where('tid',$this->input->post('etagid'));
        if($this->db->update('testimonials',array(
          'name'=>$this->input->post('euname'),
          'feedback'=>$this->input->post('emsg')
          ))){
          echo json_encode(["status"=>1,"msg"=>"done"]);
        }else{
          echo json_encode(["status"=>0,"msg"=>"error!"]);
        }

  }


}
?>