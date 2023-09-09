<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Category extends CI_Controller {

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
        'title'=>'Categories',
        'page'=>'category'
      ); 
      $this->load->vars($this->data);
      $this->template->adminview('category',$data,FALSE);   
    }
  }

  public function category_list($value='')
  {
    $draw = intval($this->input->get("draw"));
    $start = intval($this->input->get("start"));
    $length = intval($this->input->get("length"));

    $query = $this->db->get("categories");
    $data = [];  $sno = 1; 
    foreach($query->result() as $r) {
     		
      $tab=array();
      $tab[]=$sno;
      $tab[]='<h2 class="table-avatar">
      <a href="profile.html" class="avatar avatar-sm mr-2">
        <img class="avatar-img" src="assets/img/category/thumb/'.$r->orgimage.'">
      </a>
      </h2>';
      $tab[]=$r->category;
      $tab[]='<div class="actions text-right">
              <a href="#" class="btn btn-sm bg-success-light edit-country" title="Edit" id="'.$r->catid.'"><i class="fe fe-pencil"></i> Edit</a>
              <a href="#" class="btn btn-sm bg-danger-light delete-country" title="Delete" id="'.$r->catid.'"><i class="fe fe-trash"></i>Delete</a></div>';
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
  public function delete_category(){  
    $img = $this->db->get_where('categories',array('catid'=>$this->input->post('id')))->row();  
    $sourcimg = './assets/img/category/' .$img->orgimage;
    $thumbimg = './assets/img/category/thumb/'.$img->orgimage; 
    if($this->db->delete('categories',array('catid'=>$this->input->post('id')))){
      unlink($sourcimg);
      unlink($thumbimg);
      echo json_encode(["status"=>1,"msg"=>"done"]);
    }else{
      echo json_encode(["status"=>0,"msg"=>"error!"]);
    }    
  }
  public function add_category(){

    if(isset($_FILES["file"]["name"]))  
    { 
          // upload settings
          $config = array(
            'upload_path' => './assets/img/category/',
            'allowed_types' => 'png|jpg|jpeg|gif',
            'max_size' => '1024',
            'encrypt_name'=>true
        );

        // load upload class
        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('file'))
        {
            // case - failure
            // $upload_error = array('error' => $this->upload->display_errors());
            echo json_encode(["status"=>0,"msg"=>$this->upload->display_errors()]);
        }
        else
        {
            // case - success
            $upload_data = $this->upload->data();
            $data['filename'] = $upload_data['file_name'];
            $this->resize_image($data['filename']);
            $this->db->insert('categories',array(
              "category"=>$this->input->post('catname'),
              "orgimage"=>$data['filename']
            ));
            echo json_encode(["status"=>1,"msg"=>"done"]);
            // $data['success'] = '<div class="alert alert-success text-center">Image uploaded & resized successfully!</div>';
            // $this->load->view('upload_view', $data);
        }
    } 

    // $numrows = $this->db->get_where('categories',array('category'=>$this->input->post('catname')))->num_rows();
    // if($numrows == 0){
    //     if($this->db->insert('categories',array('category'=>$this->input->post('catname')))){
    //       echo json_encode(["status"=>1,"msg"=>"done"]);
    //     }else{
    //       echo json_encode(["status"=>0,"msg"=>"error!"]);
    //     }
    // }else{
    //   echo json_encode(["status"=>0,"msg"=>"Already category exist!"]);
    // }
  }
  public function updateCategory(){

    if(!empty($_FILES['file']['name'][0]))
    { 
          // upload settings
          $config = array(
            'upload_path' => './assets/img/category/',
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
            $this->db->where('catid',$this->input->post('ecid'));
            $this->db->update('categories',array(
              "category"=>$this->input->post('ecatname'),
              "orgimage"=>$data['filename']
            ));
            echo json_encode(["status"=>1,"msg"=>"done"]);
        }
    }else if (empty($_FILES['images']['name'][0]))  {
      $this->db->where('catid',$this->input->post('ecid'));
      $this->db->update('categories',array('category'=>$this->input->post('ecatname')));
      echo json_encode(["status"=>1,"msg"=>"imgdone"]);
    }


    // $numrows = $this->db->select('*')
    //           ->from('categories')
    //           ->where('category',$this->input->post('ecatname'))
    //           ->where('catid!=',$this->input->post('ecid'))
    //           ->get()->num_rows();
     
    // if($numrows == 0){
    //      $this->db->where('catid',$this->input->post('ecid'));
    //     if($this->db->update('categories',array('category'=>$this->input->post('ecatname')))){
    //       echo json_encode(["status"=>1,"msg"=>"done"]);
    //     }else{
    //       echo json_encode(["status"=>0,"msg"=>"error!"]);
    //     }
    // }else{
    //   echo json_encode(["status"=>0,"msg"=>"Already category exist!"]);
    // }
  }
  public function getCategorybyid(){
    $q=$this->db->get_where('categories',array('catid'=>$this->input->post('id')))->row();  
    echo json_encode($q);
  }

  public  function resize_image($filename)
  {
      $img_source = './assets/img/category/' . $filename;
      $img_target = './assets/img/category/thumb'; 

      if(!is_dir($img_target)){
        mkdir($img_target,0755,TRUE);
      }

      // image lib settings
      $config = array(
          'image_library' => 'gd2',
          'source_image' => $img_source,
          'new_image' => $img_target,
          'maintain_ratio' => TRUE,
          'width' => 100,
          'height' => 100
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