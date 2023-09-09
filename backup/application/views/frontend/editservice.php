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
<?php
$arr=array();
foreach($tagids as $tid){
  
  array_push($arr,$tid['tagid']);
}


if(in_array(4,$arr)){
  echo 't';
}
?>
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
<a href="<?=$base_url?>my-services/" class="active">
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
<div class="col-xs-12 col-sm-12 col-md-12 col-lg-9">
<div class="inner-box">
<div class="dashboard-box">
<h2 class="dashbord-title"><?=$title?></h2>
</div>
<div class="dashboard-wrapper">
<form id="editserviceform" >
<p  id="reg_error"></p>
<input type="hidden" name="<?php echo $csrf['name']; ?>" id="<?php echo $csrf['name']; ?>" value="<?php echo $csrf['hash']; ?>">	
<input class="form-control input-md" id="suserid" name="suserid" type="hidden" value="<?=$upr['userid']?>">
<input class="form-control input-md" id="userserviceid" name="userserviceid" type="hidden" value="<?=$servicedet['user_serviceid']?>">
<div class="form-group mb-3 tg-inputwithicon">
<label class="control-label">Category *</label>
<div class="tg-select form-control">
<select name="catid" id="catid" >
<option value="">Select Catagory</option>
<?php
   if(is_array($categories)){
     foreach($categories as $cat){
       if($servicedet['catid'] == $cat['catid']){
        echo '<option selected value='.$cat['catid'].'>'.$cat['category'].'</option>';
       }else{
        echo '<option value='.$cat['catid'].'>'.$cat['category'].'</option>';
       }
       
     }
   }
?>
</select>
</div>
</div>
<div class="form-group mb-3 tg-inputwithicon">
<label class="control-label">Tags *</label>
<div class="tg-select form-control">
<select name="tagid[]" id="tagid[]" multiple class="selectpicker" required>
<option value="">Select Tags</option>
<?php

   if(is_array($tags)){
     foreach($tags as $t){
       if(in_array($t['tagid'],$arr)){
        echo '<option selected value='.$t['tagid'].'>'.$t['tagname'].'</option>';
       }else{
        echo '<option value='.$t['tagid'].'>'.$t['tagname'].'</option>';
       }
       
     }
   }
?>
</select>

</div>
</div>
<div class="form-group mb-3">
<label class="control-label">Service Title *</label>
<input class="form-control input-md" name="stitle" id="stitle" type="text" value="<?=$servicedet['servicetitle']?>">
</div>
<div class="form-group mb-3">
<select name="exp" id="exp" class="form-control">
<option value="">Select Experience</option>
<option value="beginner" <?php if($servicedet['experience'] == 'beginner'){echo "selected"; } ?> >Beginner</option>
<option value="intermediate" <?php if($servicedet['experience'] == 'intermediate'){echo "selected"; } ?>>Intermediate</option>
<option value="expert" <?php if($servicedet['experience'] == 'expert'){echo "selected"; } ?>>Expert</option>
</select>
</div>
<div class="form-group mb-3">
<label class="control-label">Service Description *</label>
<textarea class="form-control summernote input-md" name="sdesc" id="sdesc" ><?=$servicedet['servicedesc']?></textarea>
</div>
<div class="form-group mb-3">
<label class="control-label">Service Location *</label>
<input class="form-control input-md" name="sloc" id="sloc" type="text" value="<?=$servicedet['servicelocation']?>">
</div>
<div class="form-group mb-3">
<label class="control-label">Price *</label>
<input class="form-control input-md" name="price" id="price" type="number" value="<?=$servicedet['price']?>">
</div>
<div class="form-group mb-3">
  <div class="row" id="imgbox">
<?php 
    foreach($simages as $sim){
      echo '<div class="col-md-2"><img height="80" width="80" src='.$base_url.'assets/img/featured/thumb/'.$sim['serviceimage'].'><center><a id='.$sim['user_service_imgid'].' class="btn-action btn-delete" onClick="removeimg(this.id)" href="#" title="delete image"><i class="lni-trash"></i></a></center></div>';
    }
?>
</div>
<label class="control-label">Service Images</label>

<input class="form-control input-md" id="file" name="file[]" type="file" multiple="multiple">
</div>

<div class="form-group mb-3">
  <div class="row" id="pdfbox">
<?php 
    $i=1;
    foreach($pdfs as $pdf){         
      echo '<div class="col-md-2"><center><a id='.$pdf['pdfid'].' class="btn-action btn-delete" 
      onClick="removepdf(this.id)" href="#" title="delete pdf"><i class="lni-trash"></i> PDF '.$i.'</a></center></div>';
      $i++;
    }
?>
</div>
<label class="control-label">Upload PDF</label>

<input class="form-control input-md" id="pdf_file" name="pdf_file[]" type="file" multiple="multiple">
</div>

<input class="btn btn-common" type="submit" value="save">
</form>
</div>
</div>
</div>

</div>
</div>
</div>
</div>
</div>