<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

  public function __construct(){
      parent::__construct(); 
      $this->load->model('Home_model','home'); 
      $this->data['base_url'] = base_url();
      $this->data['csrf'] = array(
        'name' => $this->security->get_csrf_token_name(),
        'hash' => $this->security->get_csrf_hash()
        );
        
  }
  public function index(){
    $data=array(
      'title'=>'Home',
      'page'=>'home',
      'web'=>$this->home->getWebsiteSettings(),
      'categories'=>$this->home->listingcountbycatid(),
      'locations'=>$this->home->loadLocation(),
    //   'locations'=>$this->home->servicelocation(),
      'myservice'=> $this->home->get_allservices(5,0),
      'posts'=>$this->home->getLatestposts(),
      'tags'=>$this->home->loadTags(),
      'reviews'=>$this->home->loadReviews()

    ); 
    $this->load->vars($this->data);    
    $this->template->myview('index',$data,FALSE);    
  }

  public function about(){
    $data=array(
      'title'=>'About Us',
      'page'=>'about',
      'web'=>$this->home->getWebsiteSettings(),
      'categories'=>$this->home->listingcountbycatid()
    );     
    $this->load->vars($this->data);   
    $this->template->myview('about',$data,FALSE); 
  }

  public function contact(){
    $data=array(
      'title'=>'Contact Us',
      'page'=>'contact',
      'web'=>$this->home->getWebsiteSettings(),
      'categories'=>$this->home->listingcountbycatid(),
      'categories'=>$this->home->loadCategories()
    );     
    $this->load->vars($this->data);   
    $this->template->myview('contact',$data,FALSE); 
  }

  public function getquote(){
    $data=array(
      'title'=>'Get Quote',
      'page'=>'getquote',
      'web'=>$this->home->getWebsiteSettings(),
      'categories'=>$this->home->listingcountbycatid(),
      'categories'=>$this->home->loadCategories()
    );     
    $this->load->vars($this->data);   
    $this->template->myview('getquote',$data,FALSE); 
  }
  
  
    public function testmail(){
    $web=$this->home->getWebsiteSettings(); 
    $this->load->library('email');
    $config['mailtype'] = 'html';
    $this->email->initialize($config);

    

    $this->email->from('amru0014@gmail.com');
    $this->email->to($web[0]['sitemail'],$web[0]['sitename']);
    $this->email->subject('Customer inquiry');
    $this->email->message('hi');
    if($this->email->send()){
    echo '<div class="alert alert-success"> Thanks for submission your details are kept confidential according to our privacy policy.. we\'ll get back to u soon with best quotation. </b></div>';     
    }else{
        $this->email->print_debugger();
    }

   

  }
  
  public function testzoho(){
     
    
        // $config = array(
        //     'protocol' => 'smtp',
        //     'smtp_crypto'=>'ssl',
        //     'smtp_host' => 'mail.constructionexpert.in',
        //     'smtp_port' => 465, //465
        //     'smtp_user' => 'contact@constructionexpert.in',
        //     'smtp_pass' => 'yP%ho#VS]DzK',
        //     'mailtype' => 'text',
        //     'charset' => 'utf8',
        //     'wordwrap' => TRUE
        // );
        
        
        $config = array(
            'protocol' => 'smtp',
            'smtp_crypto'=>'ssl',
            'smtp_host' => 'constructionexpert.in',
            'smtp_port' => 465, //465
            'smtp_user' => 'contact@constructionexpert.in',
            'smtp_pass' => 'sniffy007',
            'mailtype' => 'html',
            'charset' => 'utf8',
            'wordwrap' => TRUE
        );
        
        $this->load->library('email',$config);

        $this->email->set_newline("\r\n");
        $this->email->from('contact@constructionexpert.in');
        $this->email->to('contact@constructionexpert.in');
        $this->email->subject('This is an email test.');
        $this->email->message('<b>It is working</b>.');
        //$this->email->send();
        //echo $this->email->print_debugger();
        
        if($this->email->send())
        {
            echo $this->email->print_debugger();
            echo 'Your email was sent';
        }
        else
        {
           echo $this->email->print_debugger();
        }
  }

  public function send_mail(){
    $web=$this->home->getWebsiteSettings(); 
    $name=$this->input->post('name');
    $useremail=$this->input->post('email');
    $phone=$this->input->post('phone');
    $description=$this->input->post('msg');
    $config['protocol']    = 'smtp';    
    $config['smtp_host']    = 'constructionexpert.in';    
    $config['smtp_port']    = 465;    
    $config['smtp_user']    = 'contact@constructionexpert.in';    
    $config['smtp_pass']    = 'sniffy007';	
    $config['smtp_crypto'] = "ssl";    
    $config['charset']    = 'iso-8859-1';    
    $config['mailtype'] = 'text/html'; // or html    $config['authentication'] = 'plain'; // bool whether to validate email or not	$config['validation'] = FALSE;	$config['wordwrap'] = TRUE;	$this->load->library('email');
    $this->email->initialize($config);		$this->email->set_newline("\r\n");	$this->email->set_mailtype("html");

    $content='<html><body><p>Fullname : '.$name.'</p><p>Email : '.$useremail.'</p><p>Phone : '.$phone.'</p><p>Message : '.$description.'</p></body></html>';

    $this->email->from($web[0]['sitemail']);
    $this->email->to($web[0]['sitemail'],$web[0]['sitename']);
    $this->email->subject('Customer inquiry from - '.$useremail);
    $this->email->message($content);
    if($this->email->send()){
    echo '<div class="alert alert-success"> Thanks for submission your details are kept confidential according to our privacy policy.. we\'ll get back to u soon with best quotation...... </div>';    
    }else{    // echo $this->email->print_debugger();		/* $config['protocol']    = 'smtp';    $config['smtp_host']    = 'ssl://smtp.gmail.com';    $config['smtp_port']    = 465;    $config['smtp_user']    = 'contact@constructionexpert.in';    $config['smtp_pass']    = 'sniffy007';    $config['charset']    = 'utf-8';    $config['newline']    = "\r\n";    $config['mailtype'] = 'html'; // or html    $config['validation'] = FALSE; // bool whether to validate email or not          $this->email->initialize($config);		$content='<html><body><p>Fullname : '.$name.'</p><p>Email : '.$useremail.'</p><p>Phone : '.$phone.'</p><p>Message : '.$description.'</p></body></html>';    $this->email->from($useremail);    $this->email->to('venkata.mahesh123@gmail.com',$web[0]['sitename']);    $this->email->subject('Customer inquiry');    $this->email->message($content);    $this->email->send();    echo $this->email->print_debugger(); */     // $this->load->view('email_view');
    
echo '<div class="alert alert-danger">'.$this->email->print_debugger().' </div>';
    
    }
  }
  public function send_mail_user(){
    $web=$this->home->getWebsiteSettings(); 
    $name=$this->input->post('name');
    $useremail=$this->input->post('email');
    $phone=$this->input->post('phone');
    $cmpname=$this->input->post('cmpname');
    $city=$this->input->post('city');
    $pincode=$this->input->post('pincode');
    $address=empty($this->input->post('address')) ? $this->input->post('address') : "";
    $description=empty($this->input->post('msg')) ? $this->input->post('msg') : "";
    $catid=$this->input->post('catid');
    
    $config['protocol']    = 'smtp';    
    $config['smtp_host']    = 'constructionexpert.in';    
    $config['smtp_port']    = 465;    
    $config['smtp_user']    = 'contact@constructionexpert.in';    
    $config['smtp_pass']    = 'sniffy007';	
    $config['smtp_crypto'] = "ssl";    
    $config['charset']    = 'iso-8859-1';    
    $config['mailtype'] = 'text/html'; // or html    $config['authentication'] = 'plain'; // bool whether to validate email or not	$config['validation'] = FALSE;	$config['wordwrap'] = TRUE;	$this->load->library('email');
    $this->email->initialize($config);		$this->email->set_newline("\r\n");	$this->email->set_mailtype("html");
    
    
        $getcat =  $this->home->getCategorybyid($catid);
    if($this->db->insert('inquiries',array(
      'fullname'=>$name,
      'email'=>$useremail,
      'phone'=>$phone,
      'companyname'=>$cmpname,
      'city'=>$city,
      'pincode'=>$pincode,
      'address'=>$address,
      'description'=>$description,
      'catid'=>$catid
    ))) {

      $content='<html><body><p>Category : '.$getcat->category.'</p><p>Fullname : '.$name.'</p><p>Email : '.$useremail.'</p><p>Phone : '.$phone.'</p><p>Company Name : '.$cmpname.'</p><p>City : '.$city.'</p><p>Address : '.$address.'</p><p>Pincode : '.$pincode.'</p><p>Description : '.$description.'</p></body></html>';

       $this->email->from($web[0]['sitemail']);
      $this->email->to($web[0]['sitemail'],$web[0]['sitename']);
      $this->email->subject('Customer quote request - '.$useremail);
      $this->email->message($content);
        if($this->email->send()){
    echo '<div class="alert alert-success"> Thanks for submission your details are kept confidential according to our privacy policy.. we\'ll get back to u soon with best quotation...... </div>';    
        }else{    // echo $this->email->print_debugger();		/* $config['protocol']    = 'smtp';    $config['smtp_host']    = 'ssl://smtp.gmail.com';    $config['smtp_port']    = 465;    $config['smtp_user']    = 'contact@constructionexpert.in';    $config['smtp_pass']    = 'sniffy007';    $config['charset']    = 'utf-8';    $config['newline']    = "\r\n";    $config['mailtype'] = 'html'; // or html    $config['validation'] = FALSE; // bool whether to validate email or not          $this->email->initialize($config);		$content='<html><body><p>Fullname : '.$name.'</p><p>Email : '.$useremail.'</p><p>Phone : '.$phone.'</p><p>Message : '.$description.'</p></body></html>';    $this->email->from($useremail);    $this->email->to('venkata.mahesh123@gmail.com',$web[0]['sitename']);    $this->email->subject('Customer inquiry');    $this->email->message($content);    $this->email->send();    echo $this->email->print_debugger(); */     // $this->load->view('email_view');
        
    echo '<div class="alert alert-danger">'.$this->email->print_debugger().' </div>';
        
        }
    //   $this->email->send();

      // if($this->session->userdata('user_session')['rolename'] == 'SR'){
      //   $this->email->from($web[0]['sitemail'],$web[0]['sitename']);
      //   $this->email->to($this->session->userdata('user_session')['email']);
      //   $this->email->subject('Customer inquiry');
      //   $this->email->message($content);
      //   $this->email->send();
      // }

     // echo '<div class="alert alert-success"> Thanks for submission your details are kept confidential according to our privacy policy.. we\'ll get back to u soon with best quotation. </b></div>';

    }


  }

  public function send_mail_srs(){
    $web=$this->home->getWebsiteSettings(); 
    $name=$this->input->post('name');
    $useremail=$this->input->post('email');
    $phone=$this->input->post('phone');
    $cmpname="";
    $city=$this->input->post('city');
    $pincode=$this->input->post('pincode');
    $address=$this->input->post('address');
    $description=$this->input->post('msg');
    $userserviceid=$this->input->post('userserviceid');
  
    $config['protocol']    = 'smtp';    
    $config['smtp_host']    = 'constructionexpert.in';    
    $config['smtp_port']    = 465;    
    $config['smtp_user']    = 'contact@constructionexpert.in';    
    $config['smtp_pass']    = 'sniffy007';	
    $config['smtp_crypto'] = "ssl";    
    $config['charset']    = 'iso-8859-1';    
    $config['mailtype'] = 'text/html'; // or html    $config['authentication'] = 'plain'; // bool whether to validate email or not	$config['validation'] = FALSE;	$config['wordwrap'] = TRUE;	$this->load->library('email');
    $this->email->initialize($config);		$this->email->set_newline("\r\n");	$this->email->set_mailtype("html");
        
    if($this->db->insert('inquiries',array(
      'fullname'=>$name,
      'email'=>$useremail,
      'phone'=>$phone,
      'companyname'=>$cmpname,
      'city'=>$city,
      'pincode'=>$pincode,
      'address'=>$address,
      'description'=>$description,
      'user_serviceid'=>$userserviceid
    ))) {

      $content='<html><body><p><a>Service Details : '.BASE_URL() . 'serviceprovider-details/'.$userserviceid.'</a></p><p>Fullname : '.$name.'</p><p>Email : '.$useremail.'</p><p>Phone : '.$phone.'</p><p>Company Name : '.$cmpname.'</p><p>City : '.$city.'</p><p>Address : '.$address.'</p><p>Pincode : '.$pincode.'</p><p>Description : '.$description.'</p></body></html>';

       $this->email->from($useremail);
      $this->email->to($web[0]['sitemail'],$web[0]['sitename']);
      $this->email->subject('Customer inquiry about specific service');
      $this->email->message($content);
          if($this->email->send()){
    echo '<div class="alert alert-success"> Thanks for submission your details are kept confidential according to our privacy policy.. we\'ll get back to u soon with best quotation...... </div>';    
        }else{    // echo $this->email->print_debugger();		/* $config['protocol']    = 'smtp';    $config['smtp_host']    = 'ssl://smtp.gmail.com';    $config['smtp_port']    = 465;    $config['smtp_user']    = 'contact@constructionexpert.in';    $config['smtp_pass']    = 'sniffy007';    $config['charset']    = 'utf-8';    $config['newline']    = "\r\n";    $config['mailtype'] = 'html'; // or html    $config['validation'] = FALSE; // bool whether to validate email or not          $this->email->initialize($config);		$content='<html><body><p>Fullname : '.$name.'</p><p>Email : '.$useremail.'</p><p>Phone : '.$phone.'</p><p>Message : '.$description.'</p></body></html>';    $this->email->from($useremail);    $this->email->to('venkata.mahesh123@gmail.com',$web[0]['sitename']);    $this->email->subject('Customer inquiry');    $this->email->message($content);    $this->email->send();    echo $this->email->print_debugger(); */     // $this->load->view('email_view');
        
    echo '<div class="alert alert-danger">'.$this->email->print_debugger().' </div>';
        
        }

      // if($this->session->userdata('user_session')['rolename'] == 'SR'){
      //   $this->email->from($web[0]['sitemail'],$web[0]['sitename']);
      //   $this->email->to($this->session->userdata('user_session')['email']);
      //   $this->email->subject('Customer inquiry');
      //   $this->email->message($content);
      //   $this->email->send();
      // }

      //echo '<div class="alert alert-success"> Thanks for submition your details are kept confidential according to our privacy policy.. we\'ll get back to u soon with best quotation. </b></div>';

    }


  }

  public function register(){
    if(!$this->session->userdata('user_session')){  
    $data=array(
      'title'=>'Register',
      'page'=>'register',
      'web'=>$this->home->getWebsiteSettings(),
      'categories'=>$this->home->listingcountbycatid(),
      'category'=>$this->home->loadCategories(),
      'servicelocation'=>$this->home->loadLocation(),
      'roles'=>$this->home->loadRoles()
    );   
    $this->load->vars($this->data);  
    $this->template->myview('register',$data,FALSE); 
    }
  }
  public function login(){
    if(!$this->session->userdata('user_session')){  
    $data=array(
      'title'=>'Login',
      'page'=>'login',
      'categories'=>$this->home->listingcountbycatid(),
      'web'=>$this->home->getWebsiteSettings()
    );  
    $this->load->vars($this->data);     
    $this->template->myview('login',$data,FALSE); 
    }else{
      $this->index();
    }
  }
  public function forgotpassword(){
    if(!$this->session->userdata('user_session')){  
    $data=array(
      'title'=>'Forgot Password',
      'page'=>'forgot',
      'categories'=>$this->home->listingcountbycatid(),
      'web'=>$this->home->getWebsiteSettings()
    );  
    $this->load->vars($this->data);     
    $this->template->myview('forgotpassword',$data,FALSE); 
    }else{
      $this->index();
    }
  }
  public function changepassword(){
    if(!$this->session->userdata('user_session')){  
    $data=array(
      'title'=>'Reset Password',
      'page'=>'resetpass',
      'categories'=>$this->home->listingcountbycatid(),
      'web'=>$this->home->getWebsiteSettings()
    );  
    $this->load->vars($this->data);     
    $this->template->myview('resetpassword',$data,FALSE); 
    }else{
      $this->index();
    }
  }
  public function logout()
	{
    $this->db->where('userid',$this->session->userdata('user_session')['user_id']);
    $this->db->update('users',array('isonline'=>0));
    $this->session->unset_userdata('user_session');
    $this->session->unset_userdata('ci_session_key_generate');    
    $this->session->sess_destroy();
    $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, no-transform, max-age=0,post-check=0,pre-check=0');
    $this->output->set_header('Pragma: no-cache');
    
    redirect(base_url());
    
  } 




  public function services(){

      $config = array();
      $config["base_url"] =BASE_URL() . "services";
      $config["total_rows"] = $this->home->allservicecount();
      $config["per_page"] = 10;
      $config["uri_segment"] = 2;
        //config for bootstrap pagination class integration
        $config['full_tag_open'] = '<div class="pagination-bar">
        <nav><ul class="pagination justify-content-center">';                  
        $config['full_tag_close'] = '</ul></nav></div>';
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
        'title'=>'Services',
        'page'=>'services',      
        'categories'=>$this->home->listingcountbycatid(),
        'locations'=>$this->home->servicelocation(),    
        'pageno' => ($this->uri->segment(2)) ? $this->uri->segment(2) : 0,
        "total_rows"=>$this->home->allservicecount(),
        'web'=>$this->home->getWebsiteSettings(),
        'upr'=>$this->home->getUserprofile(),
        'myservice'=> $this->home->get_allservices($config["per_page"],$page)
      ); 
      $this->load->vars($this->data);
      $this->template->myview('services',$data,FALSE); 
    
  }
    public function serviceprovider_details(){
      $sdet=$this->home->getservicedetails();
    $data=array(
      'title'=>'Services',
      'page'=>'allservice',
      'web'=>$this->home->getWebsiteSettings(),
      'sdet'=> $sdet,
      'stags'=>$this->home->getservicetags(),
      'pdfs'=>$this->home->getservicepdf($id=null),
      'simg'=>$this->home->getserviceimages(),
      'categories'=>$this->home->listingcountbycatid(),
      'oserv'=>$this->home->getservicedetailsbyuserid($sdet['userid'])             
    ); 
    $this->load->vars($this->data);    
    $this->template->myview('servicedetails',$data,FALSE);    
  }

  public function download_servicepdf($filename = NULL){
    
        // load download helder
        $this->load->helper('download');
        // read file contents
        $data = file_get_contents(base_url('/aseets/img/featured/'.$filename));
        force_download($filename, $data);

  }


  public function services_category(){

    $config = array();
    $config["base_url"] =BASE_URL() . "service-category/".$this->uri->segment(2);
    $config["total_rows"] = $this->home->allservicecount_bycategory();
    $config["per_page"] = 10;
    $config["uri_segment"] = 3;
      //config for bootstrap pagination class integration
      $config['full_tag_open'] = '<div class="pagination-bar">
      <nav><ul class="pagination justify-content-center">';                  
      $config['full_tag_close'] = '</ul></nav></div>';
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
      'title'=>'Service Category ',
      'page'=>'category_services',      
      'categories'=>$this->home->listingcountbycatid(),
      'locations'=>$this->home->loadLocation(),
      "total_rows"=>$this->home->allservicecount_bycategory(),
      'web'=>$this->home->getWebsiteSettings(),
      'upr'=>$this->home->getUserprofile(),
      'myservice'=> $this->home->get_allservices_bycategory($config["per_page"],$page)
    ); 
    $this->load->vars($this->data);
    $this->template->myview('servicecategory',$data,FALSE); 
  
}

public function loadservicetitle(){
    // POST data
    $postData = $this->input->post('search');
    // get data
    $data = $this->home->loadservicetitle($postData);
    echo json_encode($data);
  
}



}
?>