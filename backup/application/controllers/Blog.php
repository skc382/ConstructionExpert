<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Blog extends CI_Controller {

  public function __construct(){
      parent::__construct(); 
      $this->load->model('Home_model','home'); 
      $this->data['base_url'] = base_url();
      $this->data['csrf'] = array(
        'name' => $this->security->get_csrf_token_name(),
        'hash' => $this->security->get_csrf_hash()
        );
        
  }

  public function postdetails(){
    $post=$this->home->getpostdetailsbyid();
    $data=array(
      'title'=>strtoupper($post['blogtitle']),
      'page'=>'blogpost',
      'web'=>$this->home->getWebsiteSettings(),
      'post'=>$post,
      'cmts'=>$this->home->getcommentsbypostid(),
      'cmtcount'=>$this->home->getCmtcountbyid()
    );     
    $this->load->vars($this->data);   
    $this->template->myview('post',$data,FALSE);
  }

  public function postcomment(){
    
    if($this->input->is_ajax_request()){
       if($this->db->insert('blogcomments',array(
          'blogid'=>$this->input->post('blogid'),
          'fname'=>$this->input->post('author'),
          'fmail'=>$this->input->post('authoremail'),
          'message'=>$this->input->post('comment')
        ))){
          echo json_encode(["status"=>1,"msg"=>'<span class="alert alert-success">Thank you. Your comment is waiting for approval.</span>']);
        }else{
          echo json_encode(["status"=>0,"msg"=>'<span class="alert alert-danger">Error!</span>']);
        }
    }
    
  }


  public function blog_post_list(){
  
      $config = array();
      $config["base_url"] =BASE_URL() . "blog/";
      $config["total_rows"] = $this->home->countallblogpost();
      $config["per_page"] = 10;
      $config["uri_segment"] = 2;
        //config for bootstrap pagination class integration
        $config['full_tag_open'] = '<div class="pagination-bar">
        <nav><ul class="pagination justify-content-center">';                  
        $config['full_tag_close'] = '</ul></nav>
        </div>';
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
        'title'=>'Blog',
        'page'=>'blog',        
        'pageno' => ($this->uri->segment(2)) ? $this->uri->segment(2) : 0,        
        'web'=>$this->home->getWebsiteSettings(),
        'upr'=>$this->home->getUserprofile(),
        'categories'=>$this->home->listingcountbycatid(),
        'posts'=> $this->home->getallblogpost($config["per_page"],$page)
      ); 
      $this->load->vars($this->data);
      $this->template->myview('blog',$data,FALSE); 
    
  }
}
?>