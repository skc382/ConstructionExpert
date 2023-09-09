<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Home_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}
  public function getWebsiteSettings(){
    return $this->db->select('*')->from('settings')->get()->result_array();
  }
	public function loadRoles(){
    return $this->db->select('*')->from('roles')->where('roleflag!=','AD')->get()->result_array();
  }
  public function loadCategories(){
    return $this->db->select('*')->from('categories')->get()->result_array();
  }
  public function getCategorybyid($catid){
    return $this->db->get_where('categories',array('catid'=>$catid))->row();  
  }
  public function loadTags(){
    return $this->db->select('*')->from('tags')->get()->result_array();
  }
  public function loadReviews(){
    return $this->db->select('*')->from('testimonials')->get()->result_array();
  }
  public function getUserprofile(){
    if(isset($this->session->userdata('user_session')['user_id'])){
    return $this->db->select('*')->from('users')->where('userid',$this->session->userdata('user_session')['user_id'])->get()->row_array();
    }
  }
  public function getCompdetails(){
    return $this->db->select('*')->from('serviceproviders')->where('userid',$this->session->userdata('user_session')['user_id'])->get()->row_array();
  }
  public function getCompdetailsByuserid($userid){
    return $this->db->select('serviceproviders.*,users.*')->from('serviceproviders')
    ->join('users','users.userid=serviceproviders.userid','RIGHT')
    ->where('users.userid',$userid)->get()->row_array();
  }
  public function myadscount(){
    return $this->db->select('*')->from('jobads')->where('userid',$this->session->userdata('user_session')['user_id'])->get()->num_rows();
  }
  public function myadsbidcountbyadid($id){
    return $this->db->select('*')->from('jobinvitation')->where('adid',$id)->get()->num_rows();
  }
  public function myjobinvitecountbyuserid(){
    return $this->db->select('*')->from('jobinvitation')->where('userid',$this->session->userdata('user_session')['user_id'])->get()->num_rows();
  }
  public function serviceproviderlist(){
    return $this->db->select('*')->from('users')
    ->join('roles','roles.roleid=users.roleid')
    ->where('roles.roleflag','SR')
    ->get()->result_array();
  }
  public function getserviceprovidercategorybyuserid($id){
    return $this->db->select('distinct(categories.category)')->from('serviceproviders_services')
    ->join('categories','categories.catid=serviceproviders_services.catid')
    ->where('serviceproviders_services.userid',$id)
    ->get()->result_array();
  }
  public function get_myads($limit,$start){      
    $query = $this->db->select('jobads.*,categories.category')->from('jobads')
    ->join('categories','categories.catid=jobads.catid')
    ->where('jobads.userid',$this->session->userdata('user_session')['user_id'])
    ->order_by('jobads.adid','desc')
    ->limit($limit,$start)->get();
    return $query->result_array();
  }
  public function get_myads_bids_by_adid($limit,$start){
    $query = $this->db->select('jobinvitation.*,users.*')->from('jobinvitation')
    ->join('users','users.userid=jobinvitation.userid')
    ->where('jobinvitation.adid',$this->uri->segment(2))
    ->order_by('jobinvitation.adid','desc')
    ->limit($limit,$start)->get();
    return $query->result_array();
  }
  public function get_myjob_invite_by_userid($limit,$start){
    $query = $this->db->select('jobinvitation.*,users.*,jobads.title')->from('jobinvitation')
    ->join('jobads','jobads.adid=jobinvitation.adid')
    ->join('users','users.userid=jobads.userid')
    ->where('jobinvitation.userid',$this->session->userdata('user_session')['user_id'])
    ->order_by('jobinvitation.adid','desc')
    ->limit($limit,$start)->get();
    return $query->result_array();
  }
  public function get_ad_details(){      
    $query = $this->db->select('jobads.*,categories.category,users.surname,users.isonline,users.profileimg,users.email,users.phone')->from('jobads')
    ->join('categories','categories.catid=jobads.catid')
    ->join('users','users.userid=jobads.userid')
    ->where('jobads.status !=',2)
    ->where('jobads.adid',$this->uri->segment(2))
    ->get();
    return $query->row_array();
  }
  public function myservicecount(){
    return $this->db->query("SELECT * FROM `serviceproviders_services` JOIN categories on categories.catid=serviceproviders_services.catid  WHERE serviceproviders_services.userid=".$this->session->userdata('user_session')['user_id']. " GROUP by serviceproviders_services.user_serviceid")->num_rows();
  }
  public function get_myservices_by_userid($userid){   
    $query = $this->db->select('serviceproviders_services.*,categories.category')->from('serviceproviders_services')
    ->join('categories','categories.catid=serviceproviders_services.catid')
    // ->join('serviceproviders_service_images','serviceproviders_service_images.user_serviceid=serviceproviders_services.user_serviceid')
    ->where('serviceproviders_services.userid',$userid)
    ->group_by('serviceproviders_services.user_serviceid')
    ->get();
    return $query->result_array();
  }
  public function get_myservices($limit,$start){
    // return $this->db->query("SELECT * FROM `serviceproviders_services` JOIN categories on categories.catid=serviceproviders_services.catid JOIN serviceproviders_service_images on serviceproviders_service_images.user_serviceid=serviceproviders_services.user_serviceid WHERE serviceproviders_services.userid=".$this->session->userdata('user_session')['user_id']. " GROUP by serviceproviders_services.user_serviceid  limit  $limit , $start")->result_array();

    
    $query = $this->db->select('serviceproviders_services.*,categories.category')->from('serviceproviders_services')
    ->join('categories','categories.catid=serviceproviders_services.catid')
    // ->join('serviceproviders_service_images','serviceproviders_service_images.user_serviceid=serviceproviders_services.user_serviceid')
    ->where('serviceproviders_services.userid',$this->session->userdata('user_session')['user_id'])
    ->group_by('serviceproviders_services.user_serviceid')
    ->limit($limit,$start)->get();
    return $query->result_array();
  }

  public function get_myserviceimg($id){
    return $this->db->select('*')->from('serviceproviders_service_images')
    ->where('user_serviceid',$id)
    ->limit(1)->get()->result_array();
  }

  public function listingcountbycatid(){
    return $this->db->select('categories.*, COUNT(serviceproviders_services.user_serviceid) as listings')->from('categories') 
    ->join('serviceproviders_services', 'serviceproviders_services.catid=categories.catid','LEFT')
    ->order_by('categories.category')
    ->group_by('categories.catid')
    ->get()
    ->result_array();

  }
  public function servicelocation(){
    return $this->db->select('DISTINCT(servicelocation)')->from('serviceproviders_services')->get()->result_array();
  }
  public function search_get_allservices($limit,$start,$sloc,$scat,$price,$exp,$title){   
    if($title != ''){
      $query = $this->db->select('serviceproviders_services.*,categories.category,users.*')->from('serviceproviders_services')
      ->join('categories','categories.catid=serviceproviders_services.catid')    
       ->join('users','users.userid=serviceproviders_services.userid')
      //  ->join('serviceproviders','serviceproviders.userid=serviceproviders_services.userid ','right')
      ->where('serviceproviders_services.status',1) 
      ->where('serviceproviders_services.catid',$scat) 
      ->where('serviceproviders_services.servicelocation',$sloc)
      ->where('serviceproviders_services.experience',$exp) 
      ->or_like('serviceproviders_services.servicetitle', $title)    
      ->order_by('serviceproviders_services.price',$price)   
      ->group_by('serviceproviders_services.user_serviceid')
      ->limit($limit,$start)->get();
      return $query->result_array();
    }else{
      $query = $this->db->select('serviceproviders_services.*,categories.category,users.*')->from('serviceproviders_services')
      ->join('categories','categories.catid=serviceproviders_services.catid')    
       ->join('users','users.userid=serviceproviders_services.userid')
      //  ->join('serviceproviders','serviceproviders.userid=serviceproviders_services.userid ','right')
      ->where('serviceproviders_services.status',1) 
      ->where('serviceproviders_services.catid',$scat) 
      ->where('serviceproviders_services.servicelocation',$sloc)
      ->where('serviceproviders_services.experience',$exp)  
      ->order_by('serviceproviders_services.price',$price)   
      ->group_by('serviceproviders_services.user_serviceid')
      ->limit($limit,$start)->get();
      return $query->result_array();
    }

  }
  public function get_allservices($limit,$start){   
    $query = $this->db->select('serviceproviders_services.*,categories.category,users.*')->from('serviceproviders_services')
    ->join('categories','categories.catid=serviceproviders_services.catid')
    // ->join('serviceproviders','serviceproviders.userid=serviceproviders_services.userid')
     ->join('users','users.userid=serviceproviders_services.userid')
    //  ->join('serviceproviders_service_images','serviceproviders_service_images.user_serviceid=serviceproviders_services.user_serviceid')
    ->where('serviceproviders_services.status',1) 
    ->group_by('serviceproviders_services.user_serviceid')
    // ->group_by('serviceproviders_service_images.user_serviceid')
    ->limit($limit,$start)->get();
    return $query->result_array();
  }
  public function search_allservicecount($sloc,$scat,$price,$exp,$title){
  if($title != ''){
    return $this->db->select('serviceproviders_services.*,categories.category,users.*')->from('serviceproviders_services')
    ->join('categories','categories.catid=serviceproviders_services.catid')    
     ->join('users','users.userid=serviceproviders_services.userid')
    //  ->join('serviceproviders','serviceproviders.userid=serviceproviders_services.userid ','right')
    ->where('serviceproviders_services.status',1) 
    ->where('serviceproviders_services.catid',$scat) 
    ->where('serviceproviders_services.servicelocation',$sloc)
    ->where('serviceproviders_services.experience',$exp) 
    ->or_like('serviceproviders_services.servicetitle', $title)    
    ->order_by('serviceproviders_services.price',$price)   
    ->group_by('serviceproviders_services.user_serviceid')
    ->get()->num_rows();
  }else{
    return $this->db->select('serviceproviders_services.*,categories.category,users.*')->from('serviceproviders_services')
    ->join('categories','categories.catid=serviceproviders_services.catid')    
     ->join('users','users.userid=serviceproviders_services.userid')
    //  ->join('serviceproviders','serviceproviders.userid=serviceproviders_services.userid ','right')
    ->where('serviceproviders_services.status',1) 
    ->where('serviceproviders_services.catid',$scat) 
    ->where('serviceproviders_services.servicelocation',$sloc)
    ->where('serviceproviders_services.experience',$exp) 
    ->order_by('serviceproviders_services.price',$price)   
    ->group_by('serviceproviders_services.user_serviceid')
    ->get()->num_rows();
  }


    // return $this->db->query("SELECT * FROM `serviceproviders_services` 
    // RIGHT JOIN serviceproviders on serviceproviders.userid=serviceproviders_services.userid  
    // JOIN categories on categories.catid=serviceproviders_services.catid  
    // WHERE (serviceproviders_services.catid = $scat and serviceproviders_services.servicelocation='$sloc' and serviceproviders_services.status =1 and
    // serviceproviders.experience = '$exp' order by 
    // serviceproviders_services.price $price) or serviceproviders_services.servicetitle like '%$title%' ")->num_rows();
  }
  public function allservicecount(){
    return $this->db->query("SELECT * FROM `serviceproviders_services` JOIN categories on categories.catid=serviceproviders_services.catid  WHERE serviceproviders_services.status=1")->num_rows();
  }
  public function getservicedetails(){   
    $query = $this->db->select('serviceproviders_services.*,categories.category,users.*')
    ->from('serviceproviders_services')
    ->join('categories','categories.catid=serviceproviders_services.catid')
    // ->join('serviceproviders','serviceproviders.userid=serviceproviders_services.userid')
    ->join('users','users.userid=serviceproviders_services.userid')
    ->where('serviceproviders_services.status',1)
    ->where('serviceproviders_services.user_serviceid',$this->uri->segment(2))
    ->group_by('categories.catid')
    ->get();
    return $query->row_array();
  }
  public function getserviceimages(){
    $query = $this->db->select('*')->from('serviceproviders_service_images')
    ->where('serviceproviders_service_images.user_serviceid',$this->uri->segment(2))
    ->get();
    return $query->result_array();
  }
  public function getservicedetailsbyuserid($id){   
    $query = $this->db->select('serviceproviders_services.*,users.*,categories.category')
    ->from('serviceproviders_services')
    ->join('categories','categories.catid=serviceproviders_services.catid')     
     ->join('users','users.userid=serviceproviders_services.userid')
    ->where('serviceproviders_services.status',1)
    ->where('serviceproviders_services.userid',$id)    
    ->get();
    return $query->result_array();
  }
  public function allservicecount_bycategory(){
    return $this->db->query("SELECT * FROM `serviceproviders_services` 
    JOIN categories on categories.catid=serviceproviders_services.catid  
    WHERE serviceproviders_services.status=1 and 
    serviceproviders_services.catid=".$this->uri->segment(2)."")->num_rows();
  }
  public function get_allservices_bycategory($limit,$start){  
    $catid=$this->uri->segment(2); 
    $query = $this->db->select('serviceproviders_services.*,categories.category,users.*')->from('serviceproviders_services')
    ->join('categories','categories.catid=serviceproviders_services.catid')
    // ->join('serviceproviders','serviceproviders.userid=serviceproviders_services.userid')
     ->join('users','users.userid=serviceproviders_services.userid')
    // ->join('serviceproviders_service_images','serviceproviders_service_images.user_serviceid=serviceproviders_services.user_serviceid')
    ->where('serviceproviders_services.catid',$catid) 
    ->where('serviceproviders_services.status',1) 
    ->limit($limit,$start)->get();
    return $query->result_array();
    // return $this->db->query("SELECT users.*,categories.category,serviceproviders_services.* FROM `serviceproviders_services` 
    // JOIN categories on categories.catid=serviceproviders_services.catid  
    // JOIN users on users.userid=serviceproviders_services.userid
    // WHERE serviceproviders_services.status=1 and 
    // serviceproviders_services.catid=$catid limit $limit, $start")->result_array();
  }


  public function get_serviceprovider_chatmsg_chatid($chatid){

    return $this->db->query("SELECT * FROM `jobinvitation` JOIN jobads on jobads.adid=jobinvitation.adid JOIN users on users.userid=jobinvitation.userid WHERE chatid='$chatid'")->row_array();

  }

  public function get_customer_chatmsg_chatid($chatid){

    return $this->db->query("SELECT jobinvitation.*,jobads.*,users.profileimg,users.surname,users.isonline FROM `jobinvitation` JOIN jobads on jobads.adid=jobinvitation.adid JOIN users on users.userid=jobads.userid WHERE chatid='$chatid'")->row_array();

  }
  public function getLatestposts(){
    return $this->db->select('*')->from('blogpost')->order_by('blogid','desc')->limit(3)->get()->result_array();
  }
  public function getCmtcountbyid(){
    return $this->db->select('*')->from('blogcomments')->where('blogid',$this->uri->segment(2))->get()->num_rows();
  }
  public function getpostdetailsbyid(){
    return $this->db->select('*')->from('blogpost')->where('blogid',$this->uri->segment(2))->get()->row_array();
  }
  public function getcommentsbypostid(){
    return $this->db->select('*')->from('blogcomments')->where('isapproved',1)->where('blogid',$this->uri->segment(2))->get()->result_array();
  }
  public function countallblogpost(){
    return $this->db->select('*')->from('blogpost')->where('poststatus',1)->get()->num_rows();
  }
  public function getallblogpost($limit,$start){
    return $this->db->select('*')->from('blogpost')
    ->where('poststatus',1)
    ->order_by('blogid','desc')
    ->limit($limit,$start)->get()
    ->result_array();
  }
  public function getallcommentsbypostid(){
    return $this->db->select('*')->from('blogcomments')->where('blogid',$this->uri->segment(2))->get()->result_array();
  }
  public function countcommentsbypostid($id){
    return $this->db->select('*')->from('blogcomments')->where('isapproved',1)->where('blogid',$id)->get()->num_rows();
  }
  public function loadservicetitle($title){
    $response=array();
    $records = $this->db->select('*')->from('serviceproviders_services')
    ->where("servicetitle like '%".$title."%' ")
    ->get()->result();  
     
    foreach($records as $row ){
        $response[] = array("value"=>$row->servicetitle,"label"=>ucfirst($row->servicetitle));
      }
    
    return $response;
  }

  public function getservicedetailsbyuserserviceid(){   
    $query = $this->db->select('serviceproviders_services.*,users.*,categories.category')
    ->from('serviceproviders_services')
    ->join('categories','categories.catid=serviceproviders_services.catid')     
     ->join('users','users.userid=serviceproviders_services.userid')
    ->where('serviceproviders_services.status',1)
    ->where('serviceproviders_services.user_serviceid',$this->uri->segment(2))    
    ->get();
    return $query->row_array();
  }

  public function getserviceimagesbyuserserviceid($id){  
    if($id == null){
      $query = $this->db->select('*')
      ->from('serviceproviders_service_images')
      ->where('user_serviceid',$this->uri->segment(2))    
      ->get();
      return $query->result_array();
    }else{
      $query = $this->db->select('*')
      ->from('serviceproviders_service_images')
      ->where('user_serviceid',$id)    
      ->get();
      return $query->result_array();
    }

  }

  public function getservicetags(){
    return $this->db->select('*')->from('tags')
    ->join('serviceproviders_services_tags','serviceproviders_services_tags.tagid=tags.tagid')
    ->where('serviceproviders_services_tags.user_serviceid',$this->uri->segment(2))
    ->get()->result_array();
  }

  public function getservicepdf($id){
    if($id == null){
    return $this->db->select('*')->from('serviceproviders_service_pdf')
    ->where('user_serviceid',$this->uri->segment(2))
    ->get()->result_array();
    }else{
      return $this->db->select('*')->from('serviceproviders_service_pdf')
      ->where('user_serviceid',$id)
      ->get()->result_array();
    }
  }
  public function gettagidbyserviceid(){
    return $this->db->select('tagid')->from('serviceproviders_services_tags')
    ->where('serviceproviders_services_tags.user_serviceid',$this->uri->segment(2))
    ->get()->result_array();
  }

  public function search_get_allservices_home($limit,$start,$sloc,$scat,$title){   
    if($title != '' && $scat !='' && $sloc !=''){
      $query = $this->db->select('serviceproviders_services.*,categories.category,users.*')->from('serviceproviders_services')
      ->join('categories','categories.catid=serviceproviders_services.catid')    
       ->join('users','users.userid=serviceproviders_services.userid')
      //  ->join('serviceproviders','serviceproviders.userid=serviceproviders_services.userid ','right')
      ->where('serviceproviders_services.status',1) 
      ->where('serviceproviders_services.catid',$scat) 
      ->where('serviceproviders_services.servicelocation',$sloc)
      ->where('serviceproviders_services.servicetitle', $title) 
      ->group_by('serviceproviders_services.user_serviceid')
      ->limit($limit,$start)->get();
      return $query->result_array();
    }else if($title == '' && $scat == ''){
      $query = $this->db->select('serviceproviders_services.*,categories.category,users.*')->from('serviceproviders_services')
      ->join('categories','categories.catid=serviceproviders_services.catid')    
       ->join('users','users.userid=serviceproviders_services.userid')
      //  ->join('serviceproviders','serviceproviders.userid=serviceproviders_services.userid ','right')
      ->where('serviceproviders_services.status',1) 
      ->where('serviceproviders_services.servicelocation',$sloc) 
      ->group_by('serviceproviders_services.user_serviceid')
      ->limit($limit,$start)->get();
      return $query->result_array();
    }
    else if($scat == '' && $sloc == ''){
      $query = $this->db->select('serviceproviders_services.*,categories.category,users.*')->from('serviceproviders_services')
      ->join('categories','categories.catid=serviceproviders_services.catid')    
       ->join('users','users.userid=serviceproviders_services.userid')
      //  ->join('serviceproviders','serviceproviders.userid=serviceproviders_services.userid ','right')
      ->where('serviceproviders_services.status',1) 
      ->where('serviceproviders_services.servicetitle', $title) 
      ->group_by('serviceproviders_services.user_serviceid')
      ->limit($limit,$start)->get();
      return $query->result_array();
    }
    else if($sloc == '' && $title == ''){
      $query = $this->db->select('serviceproviders_services.*,categories.category,users.*')->from('serviceproviders_services')
      ->join('categories','categories.catid=serviceproviders_services.catid')    
       ->join('users','users.userid=serviceproviders_services.userid')
      //  ->join('serviceproviders','serviceproviders.userid=serviceproviders_services.userid ','right')
      ->where('serviceproviders_services.status',1) 
      ->where('serviceproviders_services.catid',$scat)   
      ->group_by('serviceproviders_services.user_serviceid')
      ->limit($limit,$start)->get();
      return $query->result_array();
    }

  }

  public function search_allservicecount_home($sloc,$scat,$title){
    if($title != '' && $scat !='' && $sloc !=''){
     return $this->db->select('serviceproviders_services.*,categories.category,users.*')->from('serviceproviders_services')
      ->join('categories','categories.catid=serviceproviders_services.catid')    
       ->join('users','users.userid=serviceproviders_services.userid')      
      ->where('serviceproviders_services.status',1) 
      ->where('serviceproviders_services.catid',$scat) 
      ->where('serviceproviders_services.servicelocation',$sloc)
      ->where('serviceproviders_services.servicetitle', $title) 
      ->group_by('serviceproviders_services.user_serviceid')
      ->get()->num_rows();
      
    }else if($title == '' && $scat == ''){
      return $this->db->select('serviceproviders_services.*,categories.category,users.*')->from('serviceproviders_services')
      ->join('categories','categories.catid=serviceproviders_services.catid')    
       ->join('users','users.userid=serviceproviders_services.userid')      
      ->where('serviceproviders_services.status',1) 
      ->where('serviceproviders_services.servicelocation',$sloc)
      ->group_by('serviceproviders_services.user_serviceid')
      ->get()->num_rows();
    }
    else if($scat == '' && $sloc == ''){
       return $this->db->select('serviceproviders_services.*,categories.category,users.*')->from('serviceproviders_services')
      ->join('categories','categories.catid=serviceproviders_services.catid')    
       ->join('users','users.userid=serviceproviders_services.userid')      
      ->where('serviceproviders_services.status',1) 
      ->where('serviceproviders_services.servicetitle', $title) 
      ->group_by('serviceproviders_services.user_serviceid')
      ->get()->num_rows();
    }
    else if($sloc == '' && $title == ''){
     return $this->db->select('serviceproviders_services.*,categories.category,users.*')->from('serviceproviders_services')
      ->join('categories','categories.catid=serviceproviders_services.catid')    
       ->join('users','users.userid=serviceproviders_services.userid')
      //  ->join('serviceproviders','serviceproviders.userid=serviceproviders_services.userid ','right')
      ->where('serviceproviders_services.status',1) 
      ->where('serviceproviders_services.catid',$scat)   
      ->group_by('serviceproviders_services.user_serviceid')
      ->get()->num_rows();
      
    }

    }
  

  

}
?>