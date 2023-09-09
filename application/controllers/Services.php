<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Services extends CI_Controller {

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
  public function addservice(){

      $this->db->insert('serviceproviders_services',array(
        'userid'=>$this->input->post('suserid'),
        'catid'=>$this->input->post('catid'),
        'servicetitle'=>$this->input->post('stitle'),
        'experience'=>$this->input->post('exp'),
        'servicedesc'=>$this->input->post('sdesc'),
        'servicelocation'=>$this->input->post('sloc')
        // 'price'=>$this->input->post('price')
      ));
     $lastid = $this->db->insert_id(); 
     
     $tags = $this->input->post('tagid');
     if(is_array($tags)){
     foreach($tags as $tid){
       $tagchk = $this->db->get_where('serviceproviders_services_tags',array(
        'user_serviceid'=>$lastid ,'tagid'=> $tid))->num_rows();
        if($tagchk == 0){
          $this->db->insert('serviceproviders_services_tags',array(
            'user_serviceid'=>$lastid,
            'tagid'=> $tid
          ));
        }
     }
    }
     
     $count = count($_FILES['file']['name']);
     $config = array(
      'upload_path' => './assets/img/featured/',
      'allowed_types' => 'png|jpg|jpeg|gif',
      'max_size' => '5000',
      'encrypt_name' => TRUE           
    );

     $pdfcount = count($_FILES['pdf_file']['name']);
     $pdfconfig = array(
      'upload_path' => './assets/img/featured/',
      'allowed_types' => 'pdf',
      'encrypt_name' => TRUE           
     );

     $this->load->library('upload');

     for($j=0; $j<$pdfcount; $j++)
     {           
         $_FILES['pdf_file']['name']= $_FILES['pdf_file']['name'][$j];
         $_FILES['pdf_file']['type']= $_FILES['pdf_file']['type'][$j];
         $_FILES['pdf_file']['tmp_name']= $_FILES['pdf_file']['tmp_name'][$j];
         $_FILES['pdf_file']['error']= $_FILES['pdf_file']['error'][$j];
         $_FILES['pdf_file']['size']= $_FILES['pdf_file']['size'][$j]; 

      $this->upload->initialize($pdfconfig);
         if ($this->upload->do_upload('pdf_file'))
         {  
              $upload_pdf = $this->upload->data(); 
               $this->db->insert('serviceproviders_service_pdf',array(
              'user_serviceid'=>$lastid,
              'pdf'=>  $upload_pdf['file_name']
            ));
        
                    
         }
     }


      
      // print_r($files);
     for($i=0; $i<$count; $i++)
     {           
         $_FILES['file']['name']= $_FILES['file']['name'][$i];
         $_FILES['file']['type']= $_FILES['file']['type'][$i];
         $_FILES['file']['tmp_name']= $_FILES['file']['tmp_name'][$i];
         $_FILES['file']['error']= $_FILES['file']['error'][$i];
         $_FILES['file']['size']= $_FILES['file']['size'][$i]; 
 
    
        //  echo  $_FILES['file']['name'];

     // $this->load->library('upload', $config);
         $this->upload->initialize($config);
         if ($this->upload->do_upload('file'))
         {          
            
          $upload_data = $this->upload->data(); 
          $this->db->insert('serviceproviders_service_images',array(
              'user_serviceid'=>$lastid,
              'serviceimage'=> $upload_data['file_name']
            ));
                          // image lib settings 
                 $img_source = './assets/img/featured/' . $upload_data['file_name'];
                $img_target = './assets/img/featured/thumb/'; 

                if(!is_dir($img_target)){
                  mkdir($img_target,0755,TRUE);
                }

                // image lib settings
                $configi = array(
                    'image_library' => 'gd2',
                    'source_image' => $img_source,
                    'new_image' => $img_target,
                    'maintain_ratio' => FALSE,
                    'width' => 420,
                    'height' => 270
                );
                $this->load->library('image_lib');
                
                $this->image_lib->initialize($configi);    
                $this->image_lib->resize();  
                $this->image_lib->clear();    
                    
         }
     }

     echo json_encode(["status"=>1,"msg"=>"Service added successfully"]);
     
  }

  public function editservice(){
    $this->db->where('user_serviceid',$this->input->post('userserviceid'));
    $this->db->update('serviceproviders_services',array(
      'userid'=>$this->input->post('suserid'),
      'catid'=>$this->input->post('catid'),
      'servicetitle'=>$this->input->post('stitle'),
      'experience'=>$this->input->post('exp'),
      'servicedesc'=>$this->input->post('sdesc'),
      'servicelocation'=>$this->input->post('sloc'),
      'price'=>$this->input->post('price')
    ));
   $lastid = $this->input->post('userserviceid');

      $tags = $this->input->post('tagid');
      $this->db->delete('serviceproviders_services_tags',array('user_serviceid'=>$lastid));
   foreach($tags as $tid){
     $tagchk = $this->db->get_where('serviceproviders_services_tags',array(
      'user_serviceid'=>$lastid ,'tagid'=> $tid))->num_rows();
      if($tagchk == 0){
        $this->db->insert('serviceproviders_services_tags',array(
          'user_serviceid'=>$lastid,
          'tagid'=> $tid
        ));
      }
   }
   
   $count = count($_FILES['file']['name']);
   $config = array(
    'upload_path' => './assets/img/featured/',
    'allowed_types' => 'png|jpg|jpeg|gif',
    'max_size' => '5000',
    'encrypt_name' => TRUE           
  );

   $pdfcount = count($_FILES['pdf_file']['name']);
   $pdfconfig = array(
    'upload_path' => './assets/img/featured/',
    'allowed_types' => 'pdf',
    'encrypt_name' => TRUE           
   );

   $this->load->library('upload');

  if(!empty($_FILES['pdf_file']['name'][0]))
  {
    for($j=0; $j<$pdfcount; $j++)
    { 
      $_FILES['pdf_file']['name']= $_FILES['pdf_file']['name'][$j];
      $_FILES['pdf_file']['type']= $_FILES['pdf_file']['type'][$j];
      $_FILES['pdf_file']['tmp_name']= $_FILES['pdf_file']['tmp_name'][$j];
      $_FILES['pdf_file']['error']= $_FILES['pdf_file']['error'][$j];
      $_FILES['pdf_file']['size']= $_FILES['pdf_file']['size'][$j]; 

      $this->upload->initialize($pdfconfig);
      if ($this->upload->do_upload('pdf_file'))
      {  
           $upload_pdf = $this->upload->data(); 
            $this->db->insert('serviceproviders_service_pdf',array(
           'user_serviceid'=>$lastid,
           'pdf'=>  $upload_pdf['file_name']
         ));     
                 
      }
    }
  }
   
  
if(!empty($_FILES['file']['name'][0]))
  {
   
   for($i=0; $i<$count; $i++)
   {           
       $_FILES['file']['name']= $_FILES['file']['name'][$i];
       $_FILES['file']['type']= $_FILES['file']['type'][$i];
       $_FILES['file']['tmp_name']= $_FILES['file']['tmp_name'][$i];
       $_FILES['file']['error']= $_FILES['file']['error'][$i];
       $_FILES['file']['size']= $_FILES['file']['size'][$i]; 

       $this->upload->initialize($config);
       if ($this->upload->do_upload('file'))
       {          

        $upload_data = $this->upload->data();          
        $data['filename'] = $upload_data['file_name'];
                   $this->db->insert('serviceproviders_service_images',array(
            'user_serviceid'=>$lastid,
            'serviceimage'=> $data['filename']
          ));
                        // image lib settings 
               $img_source = './assets/img/featured/' . $upload_data['file_name'];
              $img_target = './assets/img/featured/thumb/'; 

              if(!is_dir($img_target)){
                mkdir($img_target,0755,TRUE);
              }

              // image lib settings
              $configi = array(
                  'image_library' => 'gd2',
                  'source_image' => $img_source,
                  'new_image' => $img_target,
                  'maintain_ratio' => FALSE,
                  'width' => 420,
                  'height' => 270
              );
              $this->load->library('image_lib');
              
              $this->image_lib->initialize($configi);    
              $this->image_lib->resize();  
              $this->image_lib->clear();    
                  
       }
   }
   echo json_encode(["status"=>1,"msg"=>"Service edited successfully"]);
  }else{
    echo json_encode(["status"=>1,"msg"=>"Service edited successfully"]);
  }
 
   
}

  public function search1(){

     $keyword = $this->input->post('customword');
    $sloc = $this->input->post('sloc');
    $scat = $this->input->post('scat');
    // $price = $this->input->post('price');
    $exp = $this->input->post('exp');


    $config = array();
    $config["base_url"] =BASE_URL() . "search";
    $config["total_rows"] = $this->home->search_allservicecount($sloc,$scat,$exp,$keyword);
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
      'title'=>'Search Services',
      'page'=>'search services',      
      'categories'=>$this->home->listingcountbycatid(),
      'locations'=>$this->home->loadLocation(),
      'pageno' => ($this->uri->segment(2)) ? $this->uri->segment(2) : 0,
      "total_rows"=>$this->home->allservicecount(),
      'web'=>$this->home->getWebsiteSettings(),
      'upr'=>$this->home->getUserprofile(),
      'myservice'=> $this->home->search_get_allservices($config["per_page"],$page,$sloc,$scat,$exp,$keyword)
    ); 
    $this->load->vars($this->data);
    $this->template->myview('services',$data,FALSE); 
  
}

public function search(){

 $keyword = $this->input->post('customword');
 $sloc = $this->input->post('sloc');
 $scat = $this->input->post('scat');


 $config = array();
 $config["base_url"] =BASE_URL() . "search";
 $config["total_rows"] = $this->home->search_allservicecount_home($sloc,$scat,$keyword);
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
   'title'=>'Search Services',
   'page'=>'search',      
   'categories'=>$this->home->listingcountbycatid(),
   'locations'=>$this->home->loadLocation(),
   'pageno' => ($this->uri->segment(2)) ? $this->uri->segment(2) : 0,
   "total_rows"=>$this->home->allservicecount(),
   'web'=>$this->home->getWebsiteSettings(),
   'upr'=>$this->home->getUserprofile(),
   'myservice'=> $this->home->search_get_allservices_home($config["per_page"],$page,$sloc,$scat,$keyword)
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
    'simg'=>$this->home->getserviceimages(),
    'categories'=>$this->home->listingcountbycatid(),
    'oserv'=>$this->home->getservicedetailsbyuserid($sdet['userid'])             
  ); 
  $this->load->vars($this->data);    
  $this->template->myview('servicedetails',$data,FALSE);    
}




}
?>