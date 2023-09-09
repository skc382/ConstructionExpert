<div class="page-header" style="background: url(assets/img/banner1.jpg);">
<div class="container">
<div class="row">
<div class="col-md-12">
<div class="breadcrumb-wrapper">
<h2 class="product-title">Details</h2>
<ol class="breadcrumb">
<li><a href="#">Home /</a></li>
<li class="current">Details</li>
</ol>
</div>
</div>
</div>
</div>
</div>


<div class="section-padding">
<div class="container">

<div class="product-info row">
<div class="col-lg-8 col-md-12 col-xs-12">
<div class="ads-details-wrapper">
<div id="owl-demo" class="owl-carousel owl-theme">
<?php  if(is_array($simg)){
   foreach($simg as $smg){ ?>
      <div class="item">
      <div class="product-img">
      <img width="800" height="500" src="<?=$base_url?>assets/img/featured/thumb/<?=$smg['serviceimage']?>" alt="">
      
      </div>
</div>
  <?php 
   }
}
?>

</div>
</div>
<div class="details-box">
<div class="ads-details-info">
<h2><?=ucfirst($sdet['servicetitle'])?></h2>
<div class="details-meta">

<span><a href="#"><i class="lni-map-marker"></i> <?=ucfirst($sdet['servicelocation'])?></a></span>
<?php 

if(is_array($stags)){
  foreach($stags as $stag){ ?>
  <span><a href="#"><i class="lni-tag"></i> <?=ucfirst($stag['tagname'])?></a></span>
  <?php } } ?>
</div>
<p class="mb-4"><?php
echo html_entity_decode($sdet['servicedesc']);
?></p>
<?php 

if(is_array($pdfs)){
  foreach($pdfs as $pdf){ ?>
  <span><a href="<?=$base_url?>download\<?=$pdf['pdf']?>"><i class="lni-download"></i> Download PDF</a></span>
  <?php } } ?>
</div>
<div class="tag-bottom">
<div class="float-left">
<ul class="advertisement">
<li>
<p><strong><i class="lni-folder"></i> Categories:</strong> <a href="#"><?=ucfirst($sdet['category'])?></a></p>

</li>


</ul>
</div>

</div>
</div>
</div>
<div class="col-lg-4 col-md-6 col-xs-12">

<aside class="details-sidebar">
<div class="widget">
<h4 class="widget-title">Get Quote From</h4>
<div class="agent-inner">
<div class="agent-title">
<div class="agent-photo">
<?php 
  if(isset($sdet['profileimg'])){
?>
<a href="#"><img src="<?=$base_url?>assets/img/author/thumb/<?=$sdet['profileimg']?>" alt=""></a>
<?php }else{ ?>
  <img src="<?=$base_url?>assets/img/author/img1.jpg" alt="">
<?php }?>
</div>
<div class="agent-details">
<h3><a href="<?=$base_url?>serviceprovider-profile/<?=$sdet['userid']?>"><?=$sdet['surname']?></a></h3>

</div>
</div>
<div id="msgSubmit" class="text-center"></div>
<form id="serviceinquiryform" class="contact-form" >
<input type="hidden" name="<?php echo $csrf['name']; ?>" id="<?php echo $csrf['name']; ?>" value="<?php echo $csrf['hash']; ?>">
<input type="hidden" class="form-control" id="userserviceid" name="userserviceid" value="<?php echo $this->uri->segment(2); ?>" >
<input type="text" class="form-control" id="name" name="name" placeholder="Name" required >

<input type="email" class="form-control" name="email" id="email" placeholder="Email" required >
<input type="text" pattern="^\d{10}$"  title="Phone number 10 digit"  class="form-control" id="phone" name="phone" placeholder="Phone" required >
<input type="text" class="form-control" name="city" id="city" placeholder="City"  >
<input type="text" class="form-control" id="pincode" name="pincode" placeholder="Pincode"  >
<textarea class="form-control"  name="address"  name="address" placeholder="Address"  ></textarea>
<textarea class="form-control"  name="msg"  name="msg" placeholder="Description" rows="7"  ></textarea>
<!-- <p>I'm interested in this property [ID 123456] and I'd like to know more details.</p> -->
<button type="submit"  class="btn btn-common">Send Message</button>
</form>
</div>
</div>

<div class="widget">
<h4 class="widget-title">More Services From Service Provider</h4>
<ul class="posts-list">
<?php 

if(is_array($oserv)){
  foreach($oserv as $os){ ?>
<li>
<div class="widget-content">
<h4><a href="<?=$os['user_serviceid']?>"><?=$os['servicetitle']?></a></h4>
 <div class="meta-tag">
<span>
<a href="#"><i class="lni-user"></i> <?=$os['surname']?></a>
</span>
<span>
<a href="#"><i class="lni-map-marker"></i> <?=$os['servicelocation']?></a>
</span>
<span>
<a href="#"><i class="lni-tag"></i> <?=$os['category']?></a>
</span>
</div>
</div>
<div class="clearfix"></div>
</li>
 <?php
  }
}
?>

</ul>
</div>
</aside>

</div>
</div>

</div>
</div>


