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
<a href="<?=$base_url?>user-profile" class="active">
<i class="lni-cog"></i>
<span>Profile Settings</span>
</a>
</li>
<?php 
if($this->session->userdata('user_session')['rolename'] == 'SR'){   
?>
<li>
<a href="<?=$base_url?>my-services">
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
<?php 
if($this->session->userdata('user_session')['rolename'] == 'CR'){   
?>
<li>
<a href="<?=$base_url?>my-ads">
<i class="lni-layers"></i>
<span>My Enquiries</span>
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
<h2 class="dashbord-title">Profile Information</h2>
</div>
<div class="dashboard-wrapper">
<form id="profileform">
<p  id="reg_error"></p>
<input type="hidden" name="<?php echo $csrf['name']; ?>" id="<?php echo $csrf['name']; ?>" value="<?php echo $csrf['hash']; ?>">	
<input class="form-control input-md" id="userid" name="userid" type="hidden" value="<?=$upr['userid']?>">
<div class="form-group mb-3">
<label class="control-label">First Name*</label>
<input class="form-control input-md" id="surname" name="surname" type="text" value="<?=$upr['surname']?>">
</div>
<div class="form-group mb-3">
<label class="control-label">Phone*</label>
<input readonly class="form-control input-md" id="phone" name="phone" type="number" value="<?=$upr['phone']?>">
</div>
<div class="form-group mb-3">
<label class="control-label">Email</label>
<input readonly class="form-control input-md" id="email" name="email" type="text" value="<?=$upr['email']?>">
</div>
<div class="form-group mb-3">
<label class="control-label">Password</label>
<input class="form-control input-md" id="password" name="password" type="password" autocomplete="off">
</div>
<div class="form-group mb-3">
<label class="control-label">Profile Picture</label>
<input class="form-control input-md" id="file" name="file" type="file">
</div>
<button class="btn btn-common" type="submit">Update</button>
</form>
</div>
</div>
</div>



</div>
</div>
</div>
</div>
</div>