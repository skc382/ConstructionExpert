<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

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

  public function register(){
        $this->form_validation->set_rules('surname', 'Name', 'trim|required');
        $this->form_validation->set_rules('mobile', 'Mobile', 'trim|required|is_unique[users.phone]');
        $this->form_validation->set_rules('email', 'Email', 'trim|required|is_unique[users.email]');
        $this->form_validation->set_rules('pass', 'Password', 'trim|required');
        $this->form_validation->set_rules('role', 'Role', 'trim|required');
        $this->form_validation->set_rules('agree', 'Agree Terms and Conditions', 'required');
        $rolename=$this->db->get_where('roles',array('roleid'=>$this->input->post('role')))->row();
        
        if ($this->form_validation->run() == TRUE) {
          if($this->db->insert('users',array(
            'surname'=>$this->input->post('surname'),
            'email'=>$this->input->post('email'),
            'phone'=>$this->input->post('mobile'),
            'password'=>sha1($this->input->post('pass')),
            'roleid'=>$this->input->post('role'),
            'regdate'=>date('Y-m-d'),
            'status'=>0
            // 'status'=>($rolename == 'CR') ? 1 : 0
          ))){
            
            $id=$this->db->insert_id();    

            $web=$this->home->getWebsiteSettings(); 
            $this->load->library('email');
            $config['mailtype'] = 'html';
            $this->email->initialize($config);
            //$href = base_url()."?i=".base64_encode($id)."&e=".base64_encode($this->input->post('email'));
            $href = base_url('verify?i='.base64_encode($id).'&e='.base64_encode($this->input->post('email')));
            $content='<html><body><a href='.$href.'>Verify your email click here .</a></body></html>';

            $this->email->from($web[0]['sitemail'],$web[0]['sitename']);
            $this->email->to($this->input->post('email'));
            $this->email->subject('Verify your mail');
            $this->email->message($content);
            $this->email->send();




            echo json_encode(["status"=>2,"msg"=>'Thank you for registering here. Verification link sent to your mail']);

            
                    
           
            // $query = $this->db->select('users.*,roles.*')->from('users')
            // ->join('roles','roles.roleid=users.roleid')
            // ->where('userid',$id)
            // ->get();
            //   if($query->num_rows() == 1){
            //     $row=$query->row();
            //     $sessiondata=array(
            //       'user_id'=>$row->userid,
            //       'surname'=>$row->surname,
            //       'email'=>$row->email,
            //       'role'=>$row->roleid,
            //       'rolename'=>$row->roleflag
            //     );
            //     $this->session->set_userdata('ci_session_key_generate', TRUE);
            //     $this->session->set_userdata('user_session', $sessiondata);  
            //     if($row->roleflag == 'CR') {
            //       echo json_encode(["status"=>1,"msg"=>BASE_URL()."user-dashboard"]);
            //     }  else{
            //       echo json_encode(["status"=>2,"msg"=>'Thank you for registering here. We will activate your account shortly']);
            //     }         
                
            //  }
        }      
    
    } else {
      $errors = validation_errors();
      echo json_encode(["status"=>0,"msg"=>$errors]);
    } 
  }

  public function processForgot(){
    if($this->input->is_ajax_request()){
      $this->form_validation->set_rules('email','Email','required');      
      
        if ($this->form_validation->run()) {           
             
            $this->db->select('*');
            $this->db->from('users');
            $this->db->where('email',$this->input->post('email'));
            $query = $this->db->get();
              if($query->num_rows() == 1){
                $row=$query->row();
                // $sessiondata=array(
                //   'user_id'=>$row->userid,
                //   'surname'=>$row->surname,
                //   'email'=>$row->email,
                //   'role'=>$row->roleid,
                //   'rolename'=>$row->roleflag
                // );
                
                $web=$this->home->getWebsiteSettings(); 
                $this->load->library('email');
                $config['mailtype'] = 'html';
                $this->email->initialize($config);
            
                $href = base_url('changepassword?i='.base64_encode($row->userid));
                $content='<html><body><a href='.$href.'>click here to reset your password.</a></body></html>';
            
                $this->email->from($web[0]['sitemail'],$web[0]['sitename']);
                $this->email->to($this->input->post('email'),$row->surname);
                $this->email->subject('Reset your password');
                $this->email->message($content);
                $this->email->send();
                
                echo json_encode(["status"=>1,"msg"=>"Password link sent to your mail."]);
                
              }else{
                echo json_encode(["status"=>0,"msg"=>"Email not exist!"]);
              }

        } else {
          $error=validation_errors();
          echo json_encode(["status"=>0,"msg"=>$error]);
        }
     
    }
  }
  
  public function processUserLogin(){
    if($this->input->is_ajax_request()){
      $this->form_validation->set_rules('email','Email','required');        
      $this->form_validation->set_rules('password','Password','required');
        if ($this->form_validation->run()) {           
               $query = $this->db->select('users.*,roles.roleflag')->from('users')
               ->join('roles','roles.roleid=users.roleid')
               ->where('users.email',$this->input->post('email'))
               ->where('users.password',sha1($this->input->post('password')))
               ->where('roles.roleflag!=','AD')
               ->where('users.status',1)
               ->get();
            // $this->db->select('*');
            // $this->db->from('users');
            // $this->db->where($array);
            // $query = $this->db->get();
              if($query->num_rows() == 1){
                $row=$query->row();
                $sessiondata=array(
                  'user_id'=>$row->userid,
                  'surname'=>$row->surname,
                  'email'=>$row->email,
                  'role'=>$row->roleid,
                  'rolename'=>$row->roleflag
                );
                $this->db->where('userid',$row->userid);
                $this->db->update('users',array('isonline'=>1));
                $this->session->set_userdata('ci_session_key_generate', TRUE);
                $this->session->set_userdata('user_session', $sessiondata);
                
                echo json_encode(["status"=>1,"msg"=>BASE_URL()."user-dashboard"]);
                
              }else{
                echo json_encode(["status"=>0,"msg"=>"Invalid Login!"]);
              }

        } else {
          $error=validation_errors();
          echo json_encode(["status"=>0,"msg"=>$error]);
        }
     
    }
  }  
  
  public function user_profile(){
    $chk = $this->check_login();
    if($chk){
      $data=array(
        'title'=>'Profile',
        'page'=>'userprofile',
        'web'=>$this->home->getWebsiteSettings(),
        'upr'=>$this->home->getUserprofile(),
        'categories'=>$this->home->listingcountbycatid(),
        'supr'=>$this->home->getCompdetails()
      ); 
      $this->load->vars($this->data);
      $this->template->myview('profile',$data,FALSE); 
    }
  }
  public function dashboard(){  
    $chk = $this->check_login();
    if($chk){
      $data=array(
        'title'=>'Dashboard',
        'page'=>'dashboard',
        'upr'=>$this->home->getUserprofile(),
        'categories'=>$this->home->listingcountbycatid(),
        'totalads'=>$this->home->myadscount()
      ); 
      $this->load->vars($this->data);
      $this->template->myview('dashboard',$data,FALSE);   
    }     
  }
  public function updateprofile(){
    $password ='';
    if(!empty($_FILES['file']['name'][0]))
    {
        // upload settings
        $config = array(
          'upload_path' => './assets/img/author/',
          'allowed_types' => 'png|jpg|jpeg|gif',
          'max_size' => '1024',
          'encrypt_name'=>true
      );

      // load upload class
      $this->load->library('upload', $config);

      if (!$this->upload->do_upload('file'))
      {
          // case - failure            
          echo json_encode(["status"=>0,"msg"=>$this->upload->display_errors()]);
      }
      else
      {
          // case - success
          $upload_data = $this->upload->data();
          $data['filename'] = $upload_data['file_name'];
          $this->resize_image($data['filename']);  
          // delete previous profile image
          $img = $this->db->get_where('users',array('userid'=>$this->input->post('userid')))->row();  
          if(!empty($img->profileimg)){
          $sourcimg = './assets/img/author/' .$img->profileimg;
          $thumbimg = './assets/img/author/thumb/'.$img->profileimg;  
          unlink($sourcimg);
          unlink($thumbimg);
          }
          if(!empty($this->input->post('password'))){
            $password = sha1($this->input->post('password')); 
          }else{
            $password = $img->password;
          }
          $this->db->where('userid',$this->input->post('userid'));
          $this->db->update('users',array(
            'password'=>$password,
            'surname'=>$this->input->post('surname'),
            'email'=>$this->input->post('email'),
            'phone'=>$this->input->post('phone'),
            "profileimg"=>$data['filename']
          ));
          
         
          
          echo json_encode(["status"=>1,"msg"=>"Profile updated successfully","pic"=>$data['filename']]);
      }
    }else if (empty($_FILES['file']['name'][0]))  {  
      $img = $this->db->get_where('users',array('userid'=>$this->input->post('userid')))->row();    
      if(!empty($this->input->post('password'))){
        $password = sha1($this->input->post('password')); 
      }else{
        $password = $img->password;
      }
      $this->db->where('userid',$this->input->post('userid'));
      if($this->db->update('users',array(
        'password'=>$password,
        'surname'=>$this->input->post('surname'),
        'email'=>$this->input->post('email'),
        'phone'=>$this->input->post('phone')
      ))){
        echo json_encode(["status"=>1,"msg"=>"Profile updated successfully."]);
      }else{
        echo json_encode(["status"=>0,"msg"=>"Error"]);
      }
    }
  }

  public  function resize_image($filename)
  {
      $img_source = './assets/img/author/' . $filename;
      $img_target = './assets/img/author/thumb'; 

      if(!is_dir($img_target)){
        mkdir($img_target,0755,TRUE);
      }

      // image lib settings
      $config = array(
          'image_library' => 'gd2',
          'source_image' => $img_source,
          'new_image' => $img_target,
          'maintain_ratio' => TRUE,
          'width' => 70,
          'height' => 70
      );
      
      // load image library
      $this->load->library('image_lib', $config);
  
      // resize image
      if(!$this->image_lib->resize())
          echo $this->image_lib->display_errors();
      $this->image_lib->clear();
  }

  public function serviceprovider_list($value='')
  {
    $draw = intval($this->input->get("draw"));
    $start = intval($this->input->get("start"));
    $length = intval($this->input->get("length"));

    $query = $this->db->select('*')->from('users')
    ->join('roles','roles.roleid=users.roleid')
    ->where('roles.roleflag','SR')
    ->get();
    $data = [];  $sno = 1; 
    foreach($query->result() as $r) {
     		
      $tab=array();
      $tab[]=$sno;
      $tab[]=$r->surname;
      $tab[]=$r->email;
      $tab[]=$r->phone;
      $tab[]=($r->status == 1)  ? '<span class="text-success">Active</span>' : '<span class=" text-danger">Inctive</span>' ;
      $tab[]=date('d-m-Y',strtotime($r->regdate));
      if($r->status == 1){
        $action = '<a href="#" class="btn btn-sm bg-danger-light block-user" title="Block" id="'.$r->userid.'">Block</a>';
      }else{
        $action = '<a href="#" class="btn btn-sm bg-success-light activate-user" title="Activate" id="'.$r->userid.'">Activate</a>';
      }
      $tab[]='<div class="actions text-right">'.$action.
      ' <a href="'.base_url().'view-services/'.$r->userid.'" class="btn btn-sm bg-warning" title="View services">View Services</a></div>';
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

  public function activate_user(){  
    $this->db->where('userid',$this->input->post('id'));
    if($this->db->update('users',array('status'=>1))){
    
      echo json_encode(["status"=>1,"msg"=>"done"]);
    }else{
      echo json_encode(["status"=>0,"msg"=>"error!"]);
    }    
  }

  public function block_user(){  
    $this->db->where('userid',$this->input->post('id'));
    if($this->db->update('users',array('status'=>0))){
    
      echo json_encode(["status"=>1,"msg"=>"done"]);
    }else{
      echo json_encode(["status"=>0,"msg"=>"error!"]);
    }    
  }

  public function addcompanyprofile(){

   $numrows = $this->db->get_where('serviceproviders',array('userid'=>$this->input->post('suserid')))->num_rows();
   if($numrows == 0){
     $this->db->insert('serviceproviders',array(
       'userid'=>$this->input->post('suserid'),
       'companyname'=>$this->input->post('cname'),
       'about'=>htmlentities($this->input->post('about')),
       'address'=>$this->input->post('address')
     ));
     echo json_encode(["status"=>1,"msg"=>"saved successfully"]);
   }else if($numrows == 1){
    $this->db->where('userid',$this->input->post('suserid'));
    $this->db->update('serviceproviders',array(
      'companyname'=>$this->input->post('cname'),
      'about'=>htmlentities($this->input->post('about')),
      'address'=>$this->input->post('address')
    ));
    echo json_encode(["status"=>1,"msg"=>"saved successfully"]);
   }
   
  }

  public function add_service(){
    $chk = $this->check_login();
    if($chk){
      $data=array(
        'title'=>'Add Service',
        'page'=>'addservice',
        'web'=>$this->home->getWebsiteSettings(),
        'upr'=>$this->home->getUserprofile(),
        'categories'=>$this->home->loadCategories(),
        'tags'=>$this->home->loadTags()
      ); 
      $this->load->vars($this->data);
      $this->template->myview('addservice',$data,FALSE); 
    }
  }


  public function edit_service(){
    $chk = $this->check_login();
    if($chk){
      $data=array(
        'title'=>'Edit Service',
        'page'=>'editservice',
        'web'=>$this->home->getWebsiteSettings(),
        'upr'=>$this->home->getUserprofile(),
        'categories'=>$this->home->loadCategories(),
        'tags'=>$this->home->loadTags(),
        'tagids'=>$this->home->gettagidbyserviceid(),
        'pdfs'=>$this->home->getservicepdf($id=null),
        'servicedet'=>$this->home->getservicedetailsbyuserserviceid(),
        'simages'=>$this->home->getserviceimagesbyuserserviceid($id=null)
      ); 
      $this->load->vars($this->data);
      $this->template->myview('editservice',$data,FALSE); 
    }
  }

  public function user_services(){
    $chk = $this->check_login();
    if($chk){
      // $myservices_query = $this->db->query("SELECT * FROM `serviceproviders_services` JOIN categories on categories.catid=serviceproviders_services.catid JOIN serviceproviders_service_images on serviceproviders_service_images.user_serviceid=serviceproviders_services.user_serviceid WHERE serviceproviders_services.userid=".$this->session->userdata('user_session')['user_id']. " GROUP by serviceproviders_services.user_serviceid");

      $config = array();
      $config["base_url"] =BASE_URL() . "my-services";
      $config["total_rows"] = $this->home->myservicecount();
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
        'title'=>'My Services',
        'page'=>'myservices',        
        'pageno' => ($this->uri->segment(2)) ? $this->uri->segment(2) : 0,
        "total_rows"=>$this->home->myservicecount(),
        'web'=>$this->home->getWebsiteSettings(),
        'upr'=>$this->home->getUserprofile(),
        'categories'=>$this->home->listingcountbycatid(),
        'myservice'=> $this->home->get_myservices($config["per_page"],$page)
      ); 
      $this->load->vars($this->data);
      $this->template->myview('myservices',$data,FALSE); 
    }
  }

  public function user_services_list()
  {
     $id = $this->input->post('id');
    //$id = $this->uri->segment(3);

    $draw = intval($this->input->post("draw"));
    $start = intval($this->input->post("start"));
    $length = intval($this->input->post("length"));

    // $query = $this->db->query("SELECT * FROM `serviceproviders_services` JOIN categories on categories.catid=serviceproviders_services.catid JOIN serviceproviders_service_images on serviceproviders_service_images.user_serviceid=serviceproviders_services.user_serviceid WHERE serviceproviders_services.userid=$id group by serviceproviders_services.user_serviceid");

    $query = $this->db->select('*')->from('serviceproviders_services')
    ->join('categories','categories.catid=serviceproviders_services.catid')
    ->where('serviceproviders_services.userid',$id)
    ->get();
    // $query = $this->db->query("SELECT * FROM `serviceproviders_services` 
    // JOIN categories on categories.catid=serviceproviders_services.catid 
    // WHERE serviceproviders_services.userid=$id");
    $data = [];  $sno = 1; 
    foreach($query->result() as $r) {
      $img = $this->home->get_myserviceimg($r->user_serviceid);
      $tab=array();
      $tab[]=$sno;
        if(count($img) > 0){
        $tab[]='<img height="50" width="50" src="'.base_url().'/assets/img/featured/thumb/'.$img[0]['serviceimage'].'" alt="">';
      }else{
        $tab[]='';
      }

      $tab[]=isset($r->servicetitle) ? $r->servicetitle : "";
      $tab[]=isset($r->category) ? $r->category : "";
      $tab[]=($r->status == 1) ? 'Active' : 'Inactive';
      if($r->status == 1){
        $action = '<a href="#" class="btn btn-sm bg-danger-light block-service" title="Block" id="'.$r->user_serviceid.'">Block</a>';
      }else{
        $action = '<a href="#" class="btn btn-sm bg-success-light activate-service" title="Activate" id="'.$r->user_serviceid.'">Activate</a>';
      }
      if($r->edit_approved == 1){
        $action .= ' <a href="#" class="btn btn-sm bg-danger-light block-edit-service" title="Block Edit Service" id="'.$r->user_serviceid.'">Block Edit</a>';
      }else if($r->edit_approved == 2){
        $action .= ' <a href="#" class="btn btn-sm bg-success-light approve-edit-service" title="Approve Edit Service" id="'.$r->user_serviceid.'">Approve Edit</a>';
      }else{}

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


  public function approved_edit_service(){  
    $this->db->where('user_serviceid',$this->input->post('id'));
    if($this->db->update('serviceproviders_services',array('edit_approved'=>1))){
    
      echo json_encode(["status"=>1,"msg"=>"done"]);
    }else{
      echo json_encode(["status"=>0,"msg"=>"error!"]);
    }    
  }

  public function block_edit_service(){  
    $this->db->where('user_serviceid',$this->input->post('id'));
    if($this->db->update('serviceproviders_services',array('edit_approved'=>0))){
    
      echo json_encode(["status"=>1,"msg"=>"done"]);
    }else{
      echo json_encode(["status"=>0,"msg"=>"error!"]);
    }    
  }

  public function activate_service(){  
    $this->db->where('user_serviceid',$this->input->post('id'));
    if($this->db->update('serviceproviders_services',array('status'=>1))){
    
      echo json_encode(["status"=>1,"msg"=>"done"]);
    }else{
      echo json_encode(["status"=>0,"msg"=>"error!"]);
    }    
  }

  public function block_service(){  
    $this->db->where('user_serviceid',$this->input->post('id'));
    if($this->db->update('serviceproviders_services',array('status'=>0))){
    
      echo json_encode(["status"=>1,"msg"=>"done"]);
    }else{
      echo json_encode(["status"=>0,"msg"=>"error!"]);
    }    
  }

  public function serviceprovider_profile(){
    $chk = $this->check_login();
    
    if($chk){
      $data=array(
        'title'=>'Profile',
        'page'=>'srsprofile',
        'web'=>$this->home->getWebsiteSettings(),
        'upr'=>$this->home->getUserprofile(),            
        'oserv'=>$this->home->get_myservices_by_userid($this->uri->segment(2)) ,
        'supr'=>$this->home->getCompdetailsByuserid($this->uri->segment(2))
      ); 
      $this->load->vars($this->data);
      $this->template->myview('serviceprovider_profile',$data,FALSE); 
    }
  }

  public function job_notification(){
    $chk = $this->check_login();
    if($chk){

      $config = array();
      $config["base_url"] =BASE_URL() . "my-job-invitation/".$this->uri->segment(2);
      $config["total_rows"] = $this->home->myjobinvitecountbyuserid();
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
        'title'=>'Notification',
        'page'=>'jobinvite',        
        'pageno' => ($this->uri->segment(3)) ? $this->uri->segment(3) : 0,        
        'web'=>$this->home->getWebsiteSettings(),
        'upr'=>$this->home->getUserprofile(),
        'categories'=>$this->home->listingcountbycatid(),
        'bids'=> $this->home->get_myjob_invite_by_userid($config["per_page"],$page)
      ); 
      $this->load->vars($this->data);
      $this->template->myview('myjobinvitation',$data,FALSE); 
    }
  }


  public function workroom(){
    $chk = $this->check_login();

    if($chk){
      if($this->session->userdata('user_session')['rolename'] == 'CR')
      {
        // $this->db->where('workroomid',$this->uri->segment(2));
        // $this->db->update('workroom',array('isread'=>1));
        $data=array(
          'title'=>'Work Room',
          'page'=>'chat',
          'web'=>$this->home->getWebsiteSettings(),
          'upr'=>$this->home->getUserprofile(),
          'wrkdet'=>$this->home->get_serviceprovider_chatmsg_chatid($this->uri->segment(2))
        );
      }
      if($this->session->userdata('user_session')['rolename'] == 'SR')
      {
        // $this->db->where('workroomid',$this->uri->segment(2));
        // $this->db->update('workroom',array('isread'=>1));
        $data=array(
          'title'=>'Work Room',
          'page'=>'chat',
          'web'=>$this->home->getWebsiteSettings(),
          'upr'=>$this->home->getUserprofile(),
          'wrkdet'=>$this->home->get_customer_chatmsg_chatid($this->uri->segment(2))
        );
      }
 
      $this->load->vars($this->data);
      $this->template->myview('chat',$data,FALSE); 
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

  public function loadmsg(){
    $res=$this->db->select('*')->from('workroom')->where('workroomid',$this->input->post('wrkid'))->get()->result_array();
    foreach ($res as $k) {
      echo '<div class="offerermessage">
      <div class="description">
      <div class="info">
      <h3>'.ucfirst($k['senderid']).'</h3>
      <span>'.$k['message'].'</span>
      <p class="pull-right">'.date('d-M-Y',strtotime($k['msgdate'])).'</p>
      </div>
      
      </div>
      </div>';
    }
  }

  public function awardproject(){
    $numrows = $this->db->get_where('jobads',array('adid',$this->input->post('adid')))->num_rows();
    if($numrows == 0){
          $this->db->where('adid',$this->input->post('adid'));
          if($this->db->update('jobads',array(
            'awarded_userid'=>$this->input->post('receiverid'),
            'status'=>3
          ))){
            echo "1";
          }
   }else{
     echo "2";
   }
    
  }


  public function markprojectcomplete(){
    $this->db->where('adid',$this->input->post('adid'));
    if($this->db->update('jobads',array(      
      'status'=>4
    ))){
      echo "1";
    }
  }

  public function removeserviceimg(){
    $img = $this->db->get_where('serviceproviders_service_images',array('user_service_imgid'=>$this->input->post('id')))->row();      
      $sourcimg = './assets/img/featured/' .$img->serviceimage;
      $thumbimg = './assets/img/featured/thumb/'.$img->serviceimage; 
      unlink($sourcimg);
      unlink($thumbimg);
      if($this->db->delete('serviceproviders_service_images',array('user_service_imgid'=>$this->input->post('id')))){
        $simages=$this->home->getserviceimagesbyuserserviceid($this->input->post('usid'));
        foreach($simages as $sim){
          echo '<div class="col-md-2"><img height="80" width="80" src='.base_url().'assets/img/featured/thumb/'.$sim['serviceimage'].'><center><a id='.$sim['user_service_imgid'].' class="btn-action btn-delete" onClick="removeimg(this.id)" href="#" title="delete image"><i class="lni-trash"></i></a></center></div>';
        }
      } 
    
  }

  public function removeservicepdf(){
    $pdfs = $this->db->get_where('serviceproviders_service_pdf',array('pdfid'=>$this->input->post('id')))->row();      
    $sourcimg = './assets/img/featured/' .$pdfs->pdf;    
    unlink($sourcimg);    
    if($this->db->delete('serviceproviders_service_pdf',array('pdfid'=>$this->input->post('id')))){
      $docs=$this->home->getservicepdf($this->input->post('usid'));
      $i=1;
      foreach($docs as $d){
        echo '<div class="col-md-2"><center><a id='.$d['pdfid'].' class="btn-action btn-delete" 
        onClick="removepdf(this.id)" href="#" title="delete pdf"><i class="lni-trash"></i> PDF '.$i.'</a></center></div>';
        $i++;
      }
    }
  }

  public function delete_myservice(){  
    $image = $this->db->get_where('serviceproviders_service_images',array('user_serviceid'=>$this->uri->segment(2)))->result();  
    foreach($image as $img){
      $sourcimg = './assets/img/featured/' .$img->serviceimage;
      $thumbimg = './assets/img/featured/thumb/'.$img->serviceimage; 
      unlink($sourcimg);
      unlink($thumbimg);
    }
    $pdfs = $this->db->get_where('serviceproviders_service_pdf',array('user_serviceid'=>$this->uri->segment(2)))->result();  
    foreach($pdfs as $pdf){
      $sourcimg = './assets/img/featured/' .$pdf->pdf;
      unlink($sourcimg);
    }
    $this->db->delete('serviceproviders_service_pdf',array('user_serviceid'=>$this->uri->segment(2)));
    $this->db->delete('serviceproviders_services_tags',array('user_serviceid'=>$this->uri->segment(2)));
    if($this->db->delete('serviceproviders_services',array('user_serviceid'=>$this->uri->segment(2)))){
          
          redirect(BASE_URL('my-services'),'refresh');
    }    
  }

  public function sendeditrequest(){
    $this->db->where('user_serviceid',$this->input->post('id'));
    if($this->db->update('serviceproviders_services',array(      
      'edit_approved'=>2
    ))){
      echo 'Edit request sent to admin';
    }
  }

  public function verify(){
    // $id=1;$em='ak@gm.co';
    // $href = base_url('verify?i='.base64_encode($id).'&e='.base64_encode($em));
    // echo $href; echo '<br>';
    $id = base64_decode($this->input->get('i'));
    $mail = base64_decode($this->input->get('e'));

    $numrows = $this->db->get_where('users',array('userid'=>$id,'email'=>$mail))->num_rows();
    if($numrows == 1){
      $this->db->where('userid',$id);
      $this->db->update('users',array('status'=>1));
      
      redirect(base_url('login?i=1'));
      
    }

  }

  public function updatepassword(){

    $id = $this->input->post('userid');
    $pass = sha1($this->input->post('pass'));

        $database = array(
                'password' => $pass
              );

            $query = $this->db->where('userid',$id)
                        ->update('users', $database);
      if ($query) {
        echo json_encode(["status"=>1,"msg"=>"Password changed successfully"]); 
        //echo "MEI_TRUE";
      }else {
        echo json_encode(["status"=>0,"msg"=>"Password error"]); 
      } 

  }
  
  
    public function testse(){
    $img = $this->home->get_myserviceimg(58);
    print_r($img);
    if(count($img) > 0){
    echo $img[0]['serviceimage'];
    }
  }


}
?>