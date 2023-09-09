<div class="page-header" style="background: url(assets/img/banner1.jpg);">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="breadcrumb-wrapper">
        <h2 class="product-title"><?=$title?></h2>           
        </div>
      </div>
    </div>
  </div>
</div>


<div id="content" class="section-padding">
<div class="container">
<div class="row">
<div class="col-lg-8 col-md-12 col-xs-12">

<div class="blog-post single-post">
<div class="post-content">
<h2 class="post-title"><a href="single-post.html"><?=ucwords($supr['companyname'])?></a></h2>
<!-- <div class="meta">
<span class="meta-part"><i class="lni-tag"></i> </span>
</div> -->
<div class="entry-summary">
<p><?=html_entity_decode($supr['about'])?></p>
</div>
</div>

</div>


<section class="featured-lis section-padding">
<div class="container">
<div class="row">
<div class="col-md-12 wow fadeIn" data-wow-delay="0.5s">
<h3 class="section-title">Services</h3>
<div id="new-products" class="owl-carousel owl-theme">
<?php

   if(is_array($oserv)){
     foreach($oserv as $mys){
 

?>

<div class="item">
<div class="product-item">
<div class="product-content">
<h3 class="product-title"><a href="<?=$base_url?>serviceprovider-details/<?=$mys['user_serviceid']?>"><?=ucfirst($mys['servicetitle'])?></a></h3>
<span><?=$mys['category']?></span>

<div class="card-text">
<div class="float-left">
<span class="icon-wrap">
<i class="lni-star-filled"></i>
<i class="lni-star-filled"></i>
<i class="lni-star-filled"></i>
<i class="lni-star-filled"></i>
<i class="lni-star-filled"></i>
<i class="lni-star"></i>
</span>
<span class="count-review">
(12 Review)
</span>
</div>
<div class="float-right">
<a class="address" href="#"><i class="lni-map-marker"></i> <?=$mys['servicelocation']?></a>
</div>
</div>
</div>
</div>
</div>
<?php
        }
          }
?>



</div>
</div>
</div>
</div>
</section>



</div>

<aside id="sidebar" class="col-lg-4 col-md-12 col-xs-12 right-sidebar">


<div class="widget categories">
<ul class="offers-user-online">
<?php if($supr['isonline'] == 1){?>
<li class="offerer">
<figure>
<?php 
  if(isset($supr['profileimg'])){
?>
<img src="<?=$base_url?>assets/img/author/thumb/<?=$supr['profileimg']?>" alt="">
<?php }else{ ?>
  <img src="<?=$base_url?>assets/img/author/img1.jpg" alt="">
<?php }?>
</figure>
<span class="bolticon"></span>
<div class="user-name">
<h3><?=$supr['surname']?></h3>
<h4 class="text-success">Online</h4>
</div>
</li>
<?php } else if($supr['isonline'] == 0){?>
<li class="offerer">
<figure>
<img src="<?=$base_url?>assets/img/author/thumb/<?=$supr['profileimg']?>" alt="">
</figure>
<div class="user-name">
<h3><?=$supr['surname']?></h3>
<h4 class="text-muted">online</h4>
</div>
</li>
<?php } ?>



</ul>
</div>


</aside>

</div>
</div>
</div>