<!DOCTYPE html>
<html lang="en">


<head>

<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<title><?=$web[0]['sitename'];?></title>

<link rel="stylesheet" type="text/css" href="<?=$base_url?>assets/css/bootstrap.min.css">

<link rel="stylesheet" type="text/css" href="<?=$base_url?>assets/fonts/line-icons.css">

<link rel="stylesheet" type="text/css" href="<?=$base_url?>assets/css/slicknav.css">

<link rel="stylesheet" type="text/css" href="<?=$base_url?>assets/css/color-switcher.css">

<link rel="stylesheet" type="text/css" href="<?=$base_url?>assets/css/summernote.css">

<link rel="stylesheet" type="text/css" href="<?=$base_url?>assets/css/select2.min.css">

<link rel="stylesheet" type="text/css" href="<?=$base_url?>assets/css/animate.css">

<link rel="stylesheet" type="text/css" href="<?=$base_url?>assets/css/owl.carousel.css">

<link rel="stylesheet" type="text/css" href="<?=$base_url?>assets/css/main.css">

<link rel="stylesheet" type="text/css" href="<?=$base_url?>assets/css/responsive.css">
<style type="text/css">
  .ui-autocomplete {
    background-color:#fff !important;
    color:#000 !important;
    width:20%;
    padding: 2px;
  }
</style>
</head>
<body>

<header id="header-wrap">

<div class="top-bar">
<div class="container">
<div class="row">
<div class="col-lg-7 col-md-5 col-xs-12">

<ul class="list-inline">
<li><i class="lni-phone"></i> <?=$web[0]['sitephone'];?></li>
<li><i class="lni-envelope"></i><?=$web[0]['sitemail'];?></li>
</ul>

</div>
<div class="col-lg-5 col-md-7 col-xs-12">

<div class="header-top-right float-right">
<?php if($this->session->userdata('user_session')){  ?>
  <a href="<?=$base_url?>user-dashboard" class="header-top-button"><i class="lni-dashboard"></i> Dashboard</a>
  <a href="<?=$base_url?>user-logout" class="header-top-button"><i class="lni-lock"></i> Log Out</a>
<?php }else{ ?>

<a href="<?=$base_url?>login" class="header-top-button"><i class="lni-unlock"></i> Log In</a> |
<a href="<?=$base_url?>register" class="header-top-button"><i class="lni-pencil"></i> Register</a>
<?php }?>
</div>
</div>
</div>
</div>
</div>


<nav class="navbar navbar-expand-lg bg-white fixed-top scrolling-navbar">
<div class="container">

<div class="navbar-header">
<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main-navbar" aria-controls="main-navbar" aria-expanded="false" aria-label="Toggle navigation">
<span class="navbar-toggler-icon"></span>
<span class="lni-menu"></span>
<span class="lni-menu"></span>
<span class="lni-menu"></span>
</button>
<a href="<?=$base_url?>" class="navbar-brand"><img src="<?=$base_url?>backend/img/web/thumb/<?=$web[0]['sitelogo']?>" alt=""></a>
</div>
<div class="collapse navbar-collapse" id="main-navbar">
<ul class="navbar-nav mr-auto w-100 justify-content-center">
<li class="nav-item <?php if($page == 'home'){echo "active";}?>">
<a class="nav-link" href="<?=$base_url?>">
Home
</a>
</li>
<li class="nav-item <?php if($page == 'services'){echo "active";}?>"">
<a class="nav-link" href="<?=$base_url?>services">
Services
</a>
</li>
<li class="nav-item <?php if($page == 'about'){echo "active";}?>"">
<a class="nav-link" href="<?=$base_url?>about">
About Us
</a>
</li>
<li class="nav-item <?php if($page == 'blog'){echo "active";}?>"">
<a class="nav-link" href="<?=$base_url?>blog">
Blog
</a>
</li>
<li class="nav-item <?php if($page == 'contact'){echo "active";}?>"">
<a class="nav-link" href="<?=$base_url?>contact">
Contact
</a>
</li>
<li class="nav-item <?php if($page == 'contact'){echo "active";}?>"">
<a class="nav-link" href="<?=$base_url?>contact"><i class="lni-pencil-alt"></i> Get Quote</a>
</li>
</ul>
<?php 

if(isset($this->session->userdata('user_session')['rolename'])) { 
if($this->session->userdata('user_session')['rolename'] == 'SR'){   
?>
<div class="post-btn">
<a class="btn btn-common" href="<?=$base_url?>contact"><i class="lni-pencil-alt"></i> Get Quote</a>
</div>
<?php } 
else if($this->session->userdata('user_session')['rolename'] == 'CR'){   
?>
<div class="post-btn">
<a class="btn btn-common" href="<?=$base_url?>post-ads"><i class="lni-pencil-alt"></i> Post an Ad</a>
</div>
<?php } 
}?>


</div>
</div>

<ul class="mobile-menu">
<li class="nav-item <?php if($page == 'home'){echo "active";}?>">
<a class="nav-link" href="<?=$base_url?>">
Home
</a>
</li>
<li class="nav-item <?php if($page == 'services'){echo "active";}?>">
<a class="nav-link" href="<?=$base_url?>services">
Services
</a>
</li>
<li class="nav-item <?php if($page == 'about'){echo "active";}?>">
<a class="nav-link" href="<?=$base_url?>about">
About Us
</a>
</li>
<li class="nav-item <?php if($page == 'blog'){echo "active";}?>">
<a class="nav-link" href="<?=$base_url?>blog">
Blog
</a>
</li>

<li class="nav-item <?php if($page == 'contact'){echo "active";}?>">
<a class="nav-link" href="<?=$base_url?>contact">
Contact
</a>
</li>
<?php if(!$this->session->userdata('user_session')) { ?>
<li class="nav-item <?php if($page == 'login'){echo "active";}?>">
<a class="nav-link" href="<?=$base_url?>login">
Login
</a>
</li>

<li class="nav-item <?php if($page == 'register'){echo "active";}?>">
<a class="nav-link" href="<?=$base_url?>register">
Register
</a>
</li>
<?php }else{ ?>
<li class="nav-item <?php if($page == 'dashboard'){echo "active";}?>">
<a class="nav-link" href="<?=$base_url?>user-dashboard">
Dashboard 
</a>
</li>

<li class="nav-item">
<a class="nav-link" href="<?=$base_url?>user-logout">
Log Out 
</a>
</li>
<?php } ?>

<!-- <?php if($this->session->userdata('user_session')){  ?>
  <li class="nav-item"><a href="<?=$base_url?>user-dashboard" class="nav-link"><i class="lni-dashboard"></i> Dashboard</a></li>
  <li class="nav-item"><a href="<?=$base_url?>user-logout" class="nav-link"><i class="lni-lock"></i> Log Out</a></li>
<?php }else{ ?>
  <li class="nav-item"><a href="<?=$base_url?>login" class="nav-link"> Log In</a></li> |
  <li class="nav-item"><a href="<?=$base_url?>register" class="nav-link"> Register</a></li>
<?php } ?> -->
</ul>

</nav>
