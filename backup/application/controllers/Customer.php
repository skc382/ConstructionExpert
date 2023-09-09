<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Customer extends CI_Controller {

  public function __construct(){
      parent::__construct();   
      $this->load->model('Home_model','home'); 
      $this->data['web'] = $this->home->getWebsiteSettings();
      $this->data['base_url'] = base_url();
      $this->data['csrf'] = array(
        'name' => $this->security->get_csrf_token_name(),
        'hash' => $this->security->get_csrf_hash()
        );       
  }
  public function check_login(){
    if(!$this->session->userdata('user_session')){ 
      $data=array('page'=>'login') ;
      $this->load->vars($this->data);
      $this->template->myview('login',$data,FALSE);    
    }else{
      return true;
    }
  }

  public function postjob(){
    $chk = $this->check_login();
    if($chk){
        $data=array(
          'title'=>'Post An Ads',
          'page'=>'postads',
          'web'=>$this->home->getWebsiteSettings(),      
          'categories'=>$this->home->loadCategories(),
          'upr'=>$this->home->getUserprofile()
        );     
        $this->load->vars($this->data);
        $this->template->myview('postjob',$data,FALSE); 
    }
  }

  public function postad(){
        $this->form_validation->set_rules('title', 'Ad Title', 'trim|required');
        $this->form_validation->set_rules('catid', 'Category', 'trim|required');
        // $this->form_validation->set_rules('price', 'Budget', 'trim|required');
       // $this->form_validation->set_rules('addescription', 'Ad Details', 'trim|required');
        if ($this->form_validation->run() == TRUE) {
          if($this->db->insert('jobads',array(
            'userid'=>$this->session->userdata('user_session')['user_id'],
            'title'=>$this->input->post('title'),
            'catid'=>$this->input->post('catid'),
            'jobdesc'=>htmlentities($this->input->post('addescription')),
            'budget'=>$this->input->post('price'),
            'status'=>1
          ))){
          echo json_encode(["status"=>1,"msg"=>"Your job posted successfully"]);
          }
        }else{
          $errors = validation_errors();
          echo json_encode(["status"=>0,"msg"=>$errors]);
        }
  }

  public function user_ads(){
    $chk = $this->check_login();
    if($chk){

      $config = array();
      $config["base_url"] =BASE_URL() . "my-ads";
      $config["total_rows"] = $this->home->myadscount();
      $config["per_page"] = 10;
      $config["uri_segment"] = 2;
        //config for bootstrap pagination class integration
        $config['full_tag_open'] = '<ul class="pagination justify-content-center">';                  
        $config['full_tag_close'] = '</ul>';
        $config['num_tag_open'] = '<li  class="page-item page-link">';
        $config['num_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="page-item"><a class="page-link active" href="#">';
        $config['cur_tag_close'] = '</a></li>';
        $config['prev_link'] = '<a class="page-link">Prev</a>';
        $config['prev_tag_open'] = '<li class="page-item">';
        $config['prev_tag_close'] = '</li>';
    
        $config['next_link'] = '<a class="page-link">Next</a>';
        $config['next_tag_open'] = '<li class="page-item">';
        $config['next_tag_close'] = '</li>';
      $this->load->library("pagination");
                 
      $this->pagination->initialize($config);      
      $page = ($this->uri->segment(2)) ? $this->uri->segment(2) : 0;
      $this->data["links"] = $this->pagination->create_links();
      $data=array(
        'title'=>'My Ads',
        'page'=>'myads',        
        'pageno' => ($this->uri->segment(2)) ? $this->uri->segment(2) : 0,
        "total_rows"=>$this->home->myadscount(),
        'web'=>$this->home->getWebsiteSettings(),
        'upr'=>$this->home->getUserprofile(),
        'categories'=>$this->home->loadCategories(),
        'myservice'=> $this->home->get_myads($config["per_page"],$page)
      ); 
      $this->load->vars($this->data);
      $this->template->myview('myads',$data,FALSE); 
    }
  }

  public function ad_details(){
    $chk = $this->check_login();
    if($chk){
        $data=array(
          'title'=>'Ad Details',
          'page'=>'adinfo',
          'web'=>$this->home->getWebsiteSettings(),      
          'adsdet'=>$this->home->get_ad_details(),
          'srs'=>$this->home->serviceproviderlist(),
          'categories'=>$this->home->loadCategories(),
          'upr'=>$this->home->getUserprofile()
        );     
        $this->load->vars($this->data);
        $this->template->myview('ad_details',$data,FALSE); 
    }
  }

  public function invitesrs(){
    
    if($this->input->is_ajax_request()){
       
       $adid  = $this->input->post('adid');
       $srsuid  = $this->input->post('srsuid');
       $chatid  = "W".$adid.rand(10*45, 100*98); 
       $numrows=$this->db->get_where('jobinvitation',array('adid'=>$adid,'userid'=>$srsuid))->num_rows();
       if($numrows == 1){
        echo json_encode(["status"=>0,"msg"=>"<span class='alert alert-warning'>Job invitation already sent to this user!</span>"]);
       }else{
         if($this->db->insert('jobinvitation',array(
          'adid'=>$adid,
          'userid'=>$srsuid,
          'chatid'=>$chatid
         ))){
        echo json_encode(["status"=>1,"msg"=>"<span class='alert alert-success'>Job invitation sent to user successfully</span>"]);
         }
       }
    }
    
  }

  public function job_proposals(){
    $chk = $this->check_login();
    if($chk){

      $config = array();
      $config["base_url"] =BASE_URL() . "view-job-proposals/".$this->uri->segment(2);
      $config["total_rows"] = $this->home->myadsbidcountbyadid($this->uri->segment(2));
      $config["per_page"] = 10;
      $config["uri_segment"] = 3;
        //config for bootstrap pagination class integration
        $config['full_tag_open'] = '<ul class="pagination justify-content-center">';                  
        $config['full_tag_close'] = '</ul>';
        $config['num_tag_open'] = '<li  class="page-item page-link">';
        $config['num_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="page-item"><a class="page-link active" href="#">';
        $config['cur_tag_close'] = '</a></li>';
        $config['prev_link'] = '<a class="page-link">Prev</a>';
        $config['prev_tag_open'] = '<li class="page-item">';
        $config['prev_tag_close'] = '</li>';
    
        $config['next_link'] = '<a class="page-link">Next</a>';
        $config['next_tag_open'] = '<li class="page-item">';
        $config['next_tag_close'] = '</li>';
      $this->load->library("pagination");
                 
      $this->pagination->initialize($config);      
      $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
      $this->data["links"] = $this->pagination->create_links();
      $data=array(
        'title'=>'View Proposals',
        'page'=>'viewbids',        
        'pageno' => ($this->uri->segment(3)) ? $this->uri->segment(3) : 0,        
        'web'=>$this->home->getWebsiteSettings(),
        'upr'=>$this->home->getUserprofile(),
        'categories'=>$this->home->loadCategories(),
        'bids'=> $this->home->get_myads_bids_by_adid($config["per_page"],$page)
      ); 
      $this->load->vars($this->data);
      $this->template->myview('myadsnotification',$data,FALSE); 
    }
  }

  public function customer_enquiry_list(){
    $draw = intval($this->input->get("draw"));
    $start = intval($this->input->get("start"));
    $length = intval($this->input->get("length"));

    $query = $this->db->select('jobads.*,users.surname,categories.category')->from('jobads')
    ->join('categories','categories.catid=jobads.catid')
    ->join('users','users.userid=jobads.userid')
    ->join('roles','roles.roleid=users.roleid')
    ->where('roles.roleflag','CR')
    ->order_by('jobads.adid','desc')
    ->get();
    $data = [];  $sno = 1; 
    foreach($query->result() as $r) {
     		
      $tab=array();
      $tab[]=$sno;
      $tab[]=date('d-m-Y',strtotime($r->postdate));
      $tab[]=$r->surname;
      // $tab[]=$r->title;
      $tab[]=$r->category;
      if($r->status == 1)  {        
        $status =  '<span class="text-info">Active</span>';
      }
       else if($r->status == 2)  {        
        $status =  '<span class="text-danger">Inactive</span>';
        }
        else if($r->status == 3)  {        
          $status =  '<span class="text-success">Awarded</span>';
          }
          else if($r->status == 4)  {        
            $status =  '<span class="text-success">Completed</span>';
            }else{}
            $tab[]=$status;

      $tab[]='<div class="actions text-right"><a href="#" id='.$r->adid.' class="btn btn-sm bg-info viewad" title="View Enquiry Details">View</a>
        <a href="'.base_url().'invite-service-provider/'.$r->adid.'" class="btn btn-sm bg-warning" title="Invite Service Provider">Invite</a>
        <a href="'.base_url().'view-job-notification/'.$r->adid.'" class="btn btn-sm bg-info" title="View Job Request">Notification</a>
        </div>';
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
  public function viewad_details_byId(){

    $adid = $this->input->post('adid');
    $res = $this->db->select('jobads.*,users.surname,categories.category')->from('jobads')
    ->join('categories','categories.catid=jobads.catid')
    ->join('users','users.userid=jobads.userid')
    ->where('jobads.adid',$adid)
    ->get()->row();
    echo json_encode(array(
      "adid"=> $res->adid,
      "budget"=> $res->budget,
      "category"=> $res->category,
      "catid"=> $res->catid,
      "jobdesc"=>html_entity_decode($res->jobdesc),
      "postdate"=> $res->postdate,
      "status"=> $res->status,
      "surname"=> $res->surname,
      "title"=> $res->title
    ));

  }


  public function serviceprovider_list(){

    $draw = intval($this->input->get("draw"));
    $start = intval($this->input->get("start"));
    $length = intval($this->input->get("length"));

    $query = $this->db->select('*')->from('users')
    ->join('roles','roles.roleid=users.roleid')
    ->where('roles.roleflag','SR')
    ->get();
    $data = [];  $sno = 1; 
    foreach($query->result() as $r) {
      $status = ($r->isonline == 1) ? 'avatar-online' : 'avatar-offline';
      $img = isset($r->profileimg) ? 'assets/img/author/thumb/'.$r->profileimg : 'assets/img/author/img1.jpg';
     $img = '<div class="avatar '.$status.'">
      <img class="avatar-img rounded-circle"  src="'.base_url().$img.'">   
      </div>';
      $tab=array();
      $tab[]=$sno;
      $tab[]=$img." ".$r->surname."<br><i class='fe fe-mail'></i> : ".$r->email."<br><i class='fe fe-phone'></i> : ".$r->phone;         
      $tab[]='<input type="checkbox" value='.$r->userid.' ><br>
      <a href="'.base_url().'view-services/'.$r->userid.'" target="new" class="btn btn-sm bg-warning" title="View services">View Services</a>';
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

  public function sendjobrequest(){
     $userids = json_decode($this->input->post('userids'));
     foreach($userids as $srsid){
      $adid  = $this->input->post('adid');
      $srsuid  = $srsid;
      $chatid  = "W".$adid.rand(10*45, 100*98); 
      $numrows=$this->db->get_where('jobinvitation',array('adid'=>$adid,'userid'=>$srsuid))->num_rows();
      if($numrows == 0){
     
        $this->db->insert('jobinvitation',array(
         'adid'=>$adid,
         'userid'=>$srsuid,
         'isadmin_approved'=>1,
         'chatid'=>$chatid
        ));
      }
     }
     echo json_encode(["status"=>1,"msg"=>"<span class='alert alert-success'>Job invitation sent to user successfully</span>"]);
  }

  

}
?>