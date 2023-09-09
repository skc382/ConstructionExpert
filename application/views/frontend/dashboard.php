<div class="page-header" style="background: url(assets/img/banner1.jpg);">
<div class="container">
<div class="row">
<div class="col-md-12">
<div class="breadcrumb-wrapper">
<h2 class="product-title">Dashboard</h2>
<ol class="breadcrumb">
<li><a href="#">Home /</a></li>
<li class="current">Dashboard</li>
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
<a href="#"><img src="./assets/img/author/thumb/<?=$upr['profileimg']?>" alt=""></a>
</figure>
<div class="usercontent">
<h3>Hello <?php echo $this->session->userdata('user_session')['surname'];?></h3>
</div>
</div>
<nav class="navdashboard">
<ul>
<li>
<a class="active" href="<?=$base_url?>user-dashboard">
<i class="lni-dashboard"></i>
<span>Dashboard</span>
</a>
</li>
<li>
<a href="<?=$base_url?>user-profile">
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
<div class="page-content">
<div class="inner-box">
<div class="dashboard-box">
<h2 class="dashbord-title">Dashboard</h2>
</div>
<div class="dashboard-wrapper">
<div class="dashboard-sections">
<div class="row">
<?php 
if($this->session->userdata('user_session')['rolename'] == 'CR'){   
?>
<div class="col-xs-6 col-sm-6 col-md-6 col-lg-4">
<div class="dashboardbox">
<div class="icon"><i class="lni-write"></i></div>
<div class="contentbox">
<h2><a href="#">Total enquiries</a></h2>
<h3><?=$totalads?> enquiries</h3>
</div>
</div>
</div>
<?php } ?>
<!-- <div class="col-xs-6 col-sm-6 col-md-6 col-lg-4">
<div class="dashboardbox">
<div class="icon"><i class="lni-support"></i></div>
<div class="contentbox">
<h2><a href="#">Offers / Messages</a></h2>
<h3>2040 Messages</h3>
</div>
</div>
</div> -->
</div>
</div>

</div>
</div>
</div>
</div>
</div>
</div>
</div>