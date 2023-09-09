<?php
class Template{
  public function myview($filename='',$data=array(),$status=FALSE){
    
    $this->CI =& get_instance();    
    $this->CI->load->view("frontend/header",$data,$status); 
    $this->CI->load->view("frontend/".$filename,$data,$status);
    $this->CI->load->view("frontend/footer",$data,$status);
  }
  public function adminview($filename='',$data=array(),$status=FALSE){
    
    $this->CI =& get_instance();    
    $this->CI->load->view("admin/header",$data,$status);    
    $this->CI->load->view("admin/sidebar",$data,$status);  
    $this->CI->load->view("admin/".$filename,$data,$status);
    $this->CI->load->view("admin/footer",$data,$status);
  }
  public function loginview($filename='',$data=array(),$status=FALSE){    
    $this->CI =& get_instance(); 
    $this->CI->load->view($filename,$data,$status);
  }
}
?>