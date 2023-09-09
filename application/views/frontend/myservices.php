<div class="page-header" style="background: url(assets/img/banner1.jpg);">
<div class="container">
<div class="row">
<div class="col-md-12">
<div class="breadcrumb-wrapper">
<h2 class="product-title">Profile Settings</h2>
<ol class="breadcrumb">
<li><a href="#">Home /</a></li>
<li class="current">Profile Settings</li>
</ol>
</div>
</div>
</div>
</div>
</div>


<div id="content" class="section-padding">
<div class="container">
<div class="row">
<div class="col-sm-12 col-md-4 col-lg-3 page-sidebar">
<aside>
<div class="sidebar-box">
<div class="user">
<figure>
<a href="#"><img id="picimg" src="./assets/img/author/thumb/<?=$upr['profileimg']?>" alt=""></a>
</figure>
<div class="usercontent">
<h3>Hello <?php echo $this->session->userdata('user_session')['surname'];?></h3>
</div>
</div>
<nav class="navdashboard">
<ul>
<li>
<a  href="<?=$base_url?>user-dashboard">
<i class="lni-dashboard"></i>
<span>Dashboard</span>
</a>
</li>
<li>
<a href="<?=$base_url?>user-profile" >
<i class="lni-cog"></i>
<span>Profile Settings</span>
</a>
</li>
<?php 
if($this->session->userdata('user_session')['rolename'] == 'SR'){   
?>
<li>
<a href="<?=$base_url?>my-services" class="active">
<i class="lni-layers"></i>
<span>My Services</span>
</a>
</li>
<li>
<a href="<?=$base_url?>my-job-invitation">
<i class="lni-layers"></i>
<span>Job Notification</span>
</a>
</li>
<?php 
}
?>


<li>
<a href="<?=$base_url?>user-logout">
<i class="lni-enter"></i>
<span>Logout</span>
</a>
</li>
</ul>
</nav>
</div>
</aside>
</div>

      <div class="col-sm-12 col-md-8 col-lg-9">
        <div class="row page-content">
          <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <div class="inner-box">
              <div class="dashboard-box">
              <h2 class="dashbord-title"><?=$title?></h2>
              </div>
            <div class="dashboard-wrapper">
              <nav class="nav-table">
              <ul>
              <li class="active"><a href="<?=$base_url?>add-service">Add Service</a></li>
              </ul>
              </nav>
              
              <table class="table table-responsive dashboardtable tablemyads">
<thead>
<th>
  S.No
<!-- <div class="custom-control custom-checkbox">
<input type="checkbox" class="custom-control-input" id="checkedall">
<label class="custom-control-label" for="checkedall"></label>
</div> -->
</th>
<th>Photo</th>
<th>Service Title</th>
<th>Service Category</th>
<th>Service Status</th>
<th>Edit Service Status</th>
<th>Action</th>
</thead>
<tbody>

<?php 
if(is_array($myservice)){
   $sn =1;
    foreach($myservice as  $mys){
      $this->load->model('Home_model','home'); 
         $img = $this->home->get_myserviceimg($mys['user_serviceid']);
         //print_r($img);
?>
<tr data-category="active">
<td>
  <?php echo $sn; $sn++;?>
<!-- <div class="custom-control custom-checkbox">
<input type="checkbox" class="custom-control-input" id="adone">
<label class="custom-control-label" for="adone"></label>
</div> -->
</td>
<td class="photo">
  <?php if(isset($img[0]['serviceimage'])) {?>
  <img class="img-fluid" src="<?=$base_url?>/assets/img/featured/thumb/<?=$img[0]['serviceimage']?>" alt="">
  <?php }else{?>
    
  <?php } ?>
</td>
<td data-title="Title">
<h3><?=$mys['servicetitle']?></h3>
</td>
<td data-title="Category"><span class="adcategories"><?=$mys['category']?></span></td>
<td data-title="Ad Status"><span class="adstatus <?=($mys['status'] == 1) ? "adstatusactive" : "adstatusinactive"?>"><?=($mys['status'] == 1) ? "Active" : "Inactive"?></span></td>
<td>
<?php
if($mys['edit_approved'] == 1){
  $stext = 'Edit Approved';
  $stclass = 'adstatusactive';
}
else if($mys['edit_approved'] == 2){  
  $stext = 'Waiting for approval to edit service';
  $stclass = 'adstatusinactive';
}else{
  $stext = 'Send Request To Edit';
  $stclass = 'adstatusinactive';
}
?>
<span class="adstatus <?=$stclass?>"><?=$stext?></span>
</td>

<td data-title="Action">
<div class="btns-actions">
<?php if($mys['status'] == 1) {?>
<a class="btn-action btn-view" href="<?=$base_url?>serviceprovider-details/<?=$mys['user_serviceid']?>"><i class="lni-eye"></i></a>
<?php } ?>
<?php if($mys['edit_approved'] == 1) {?>
<a class="btn-action btn-view" href="<?=$base_url?>edit-my-service/<?=$mys['user_serviceid']?>"><i class="lni-pencil"></i></a>
<?php }else if($mys['edit_approved'] == 2){ ?>
  <a class="btn-action btn-edit  href="#" title="edit request sent"><i class="lni-bubble"></i></a>
<?php }else{ ?>
  <a class="btn-action btn-edit editrequest" id="<?=$mys['user_serviceid']?>" href="#" title="send request to edit"><i class="lni-bubble"></i></a>
<?php } ?>

<a class="btn-action btn-delete deleteservice" id="<?=$mys['user_serviceid']?>" href="#" ><i class="lni-trash"></i></a>
</div>
</td>
</tr>
<?php 
    }
} 
?>
</tbody>
</table>

<?php echo $links; ?>
            </div>
            </div>
          </div>
        </div>
      </div>

</div>
</div>
</div>