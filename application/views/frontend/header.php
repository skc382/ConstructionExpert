<!DOCTYPE html>
<html lang="en">


<head>

<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<title><?=$web[0]['sitename'];?></title>
<?php if($page == 'adinfo'){ 
  
?>
  <meta property="og:title" content="<?=$adsdet['title']?>">
  <meta property="og:description" content="<?=strip_tags(html_entity_decode($adsdet['jobdesc']))?>">  
  <meta property="og:url" content="<?=$base_url?>ad-details/<?=$adsdet['adid']?>">
  
<?php } ?>

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
<div class="col-lg-6 col-md-6 col-xs-12">
    <div class="header-top-right ">
<a href="#" class="header-top-button"><marquee behavior="scroll" direction="left" class="text-warning"><b><?=isset($web[0]['todaytip']) ? $web[0]['todaytip'] : "";?></b></marquee></a>
</div>

</div>
<div class="col-lg-6 col-md-6 col-xs-12">

<div class="header-top-right float-right">
<a href="#" class="header-top-button"><i class="lni-phone"></i> <?=$web[0]['sitephone'];?></a> 
<a href="#" class="header-top-button"><i class="lni-envelope"></i> <?=$web[0]['sitemail'];?></a> 
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
<a href="<?=$base_url?>" class="navbar-brand"><img src="<?=$base_url?>backend/img/web/<?=$web[0]['headerlogo']?>" alt=""></a>
</div>
<div class="collapse navbar-collapse" id="main-navbar">
<ul class="navbar-nav mr-auto w-100 justify-content-center">
<li class="nav-item <?php if($page == 'home'){echo "active";}?>">
<a class="nav-link" href="<?=$base_url?>">
Home
</a>
</li>
<!-- <li class="nav-item <?php if($page == 'services'){echo "active";}?>">
<a class="nav-link" href="<?=$base_url?>services">
Services
</a>
</li> -->
<li class="nav-item dropdown">
<a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
Services
</a>
<div class="dropdown-menu">
<?php
   if(is_array($categories)){
     foreach($categories as $cat){
       echo '<a class="dropdown-item" href='.$base_url.'service-category/'.$cat['catid'].'> '.ucfirst($cat['category']).'</a>';
     }
   }
?>

</div>
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
<li class="nav-item <?php if($page == 'getquote'){echo "active";}?>"">
<a class="nav-link" href="<?=$base_url?>getquote"><i class="lni-pencil-alt"></i> Get Quote</a>
</li>
<li class="nav-item <?php if($page == 'search'){echo "active";}?>"">
<a class="nav-link" href="<?=$base_url?>search"><i class="lni-search"></i> Search</a>
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
<a class="btn btn-common" href="<?=$base_url?>post-ads"><i class="lni-pencil-alt"></i> Post your requirement</a>
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


</ul>

</nav>
