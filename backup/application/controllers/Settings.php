<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Settings extends CI_Controller {

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
        'title'=>'Website Settings',
        'page'=>'setting',
        'web'=>$this->home->getWebsiteSettings()
      ); 
      $this->load->vars($this->data);
      $this->template->adminview('setting',$data,FALSE);   
    }  
  }

  public function bannerimage(){
    $chk = $this->check_login();
    if($chk){
      $data=array(
        'title'=>'Banner Image',
        'page'=>'banner',
        'web'=>$this->home->getWebsiteSettings()
      ); 
      $this->load->vars($this->data);
      $this->template->adminview('banner',$data,FALSE);   
    }  
  }

  public function getusers(){
    $r=$this->db->get_where('users',array('roleid'=>1))->row();
    print_r($r);
  }

  public function updateprofile(){
    $chk = $this->check_login();
    if($chk){
      $data=array(
        'title'=>'Profile',
        'page'=>'profile',
        'pro'=>$this->db->get_where('users',array('roleid'=>1))->row()
      ); 
      $this->load->vars($this->data);
      $this->template->adminview('profile',$data,FALSE);   
    } 
  }
  public function update_profile(){
    if(!empty($this->input->post('pass'))){
        $pass =sha1($this->input->post('pass'));
        $this->db->where('userid',$this->input->post('userid'));
        if($this->db->update('users',array(
          'username'=>$this->input->post('username'),     
          'password'=>$pass,
          'surname'=>$this->input->post('surname'),
          'email'=>$this->input->post('email'),      
          'phone'=>$this->input->post('phone')
        ))){
          echo json_encode(["status"=>1,"msg"=>"Profile updated successfully."]);
        }else{
          echo json_encode(["status"=>0,"msg"=>"Error"]);
        }
    }else{
      $this->db->where('userid',$this->input->post('userid'));
      if($this->db->update('users',array(
        'username'=>$this->input->post('username'),
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
  
  public function update_bannerimage(){

    $config = array(
      'upload_path' => './assets/img/background/',
      'allowed_types' => 'png|jpg|jpeg|gif',
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
      //print_r($upload_data);
      if($upload_data['image_width'] == 1600 && $upload_data['image_height']==1067)
      {
      $data['filename'] = $upload_data['file_name'];
      $this->resize_bannerimage($data['filename']);  
      // delete previous logo
      $img = $this->db->get_where('settings')->row();  
      $sourcimg = './assets/img/background/' .$img->bannerlogo;
      $thumbimg = './assets/img/background/thumb/'.$img->bannerlogo;  
      unlink($sourcimg);
      unlink($thumbimg);
          
      $this->db->update('settings',array(
        "bannerlogo"=>$data['filename']
      ));
      echo json_encode(["status"=>1,"msg"=>"Banner image updated successfully"]);
     }else{
      echo json_encode(["status"=>0,"msg"=>"image dimension should be 1600x1067"]);
     }
  }

  }


  public  function resize_bannerimage($filename)
  {
      $img_source = './assets/img/background/' . $filename;
      $img_target = './assets/img/background/thumb'; 

      if(!is_dir($img_target)){
        mkdir($img_target,0755,TRUE);
      }

      // image lib settings
      $config = array(
          'image_library' => 'gd2',
          'source_image' => $img_source,
          'new_image' => $img_target,
          'maintain_ratio' => TRUE,
          'width' => 1600,
          'height' => 1067
      );
      
      // load image library
      $this->load->library('image_lib', $config);
  
      // resize image
      if(!$this->image_lib->resize())
          echo $this->image_lib->display_errors();
      $this->image_lib->clear();
  }
  
  public function update_site(){

    if(!empty($_FILES['file']['name'][0]))
    {
        // upload settings
        $config = array(
          'upload_path' => './backend/img/web/',
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
          // delete previous logo
          $img = $this->db->get_where('settings')->row();  
          $sourcimg = './backend/img/web/' .$img->sitelogo;
          $thumbimg = './backend/img/web/thumb/'.$img->sitelogo;  
          unlink($sourcimg);
          unlink($thumbimg);
          $about=$this->input->post('about');        
          $this->db->update('settings',array(
            'about'=>htmlentities($about),
            'sitename'=>$this->input->post('sitename'),
            'sitemail'=>$this->input->post('siteamil'),
            'sitephone'=>$this->input->post('sitephone'),
            'siteaddress'=>$this->input->post('siteaddr'),
            'fb'=>$this->input->post('fb'),
            'tw'=>$this->input->post('tw'),
            "sitelogo"=>$data['filename'],
            'todaytip'=>$this->input->post('todaytip')
          ));
          echo json_encode(["status"=>1,"msg"=>"Website setting updated successfully"]);
      }
    }else if (empty($_FILES['images']['name'][0]))  {
      $about=$this->input->post('about');
      if($this->db->update('settings',array(
        'about'=>htmlentities($about),
        'sitename'=>$this->input->post('sitename'),
        'sitemail'=>$this->input->post('siteamil'),
        'sitephone'=>$this->input->post('sitephone'),
        'siteaddress'=>$this->input->post('siteaddr'),
        'fb'=>$this->input->post('fb'),
        'tw'=>$this->input->post('tw'),
        'todaytip'=>$this->input->post('todaytip')
      ))){
        echo json_encode(["status"=>1,"msg"=>"Website setting updated successfully."]);
      }else{
        echo json_encode(["status"=>0,"msg"=>"Error"]);
      }
    }

  }

  public  function resize_image($filename)
  {
      $img_source = './backend/img/web/' . $filename;
      $img_target = './backend/img/web/thumb'; 

      if(!is_dir($img_target)){
        mkdir($img_target,0755,TRUE);
      }

      // image lib settings
      $config = array(
          'image_library' => 'gd2',
          'source_image' => $img_source,
          'new_image' => $img_target,
          'maintain_ratio' => TRUE,
          'width' => 222,
          'height' => 35
      );
      
      // load image library
      $this->load->library('image_lib', $config);
  
      // resize image
      if(!$this->image_lib->resize())
          echo $this->image_lib->display_errors();
      $this->image_lib->clear();
  }

}
?>