<div class="page-header" style="background: url(assets/img/banner1.jpg);">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="breadcrumb-wrapper">
        <h2 class="product-title"><?=$adsdet['title']?></h2>           
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

<input type="hidden" id="adid"  value="<?=$this->uri->segment(2)?>">
<div class="post-content">
<h2 class="post-title"><a href="single-post.html"><?=$adsdet['title']?></a></h2>
<div class="meta">
<span class="meta-part"><a href="#">
  
  Ad Posted by <?=$adsdet['surname']?>

</a></span>
<span class="meta-part"><a href="<?=$base_url?>service-category/<?=$adsdet['catid']?>"><i class="lni-tag"></i>  <?=$adsdet['category']?></a></span>
<span class="meta-part"><a href="#"><i class="lni-alarm-clock"></i> <?=date('d-m-Y',strtotime($adsdet['postdate']))?></a></span>
</div>
<div class="entry-summary">
<p><?=html_entity_decode($adsdet['jobdesc'])?></p>
</div>
</div>

</div>

<?php if($this->session->userdata('user_session')['rolename'] == 'CR'){ ?>
<section class="featured-lis section-padding">
<div class="container">
<div class="row">
<div class="col-md-12 wow fadeIn" data-wow-delay="0.5s">
<p id="invite_msg" class="text-center"></p>
<h3 class="section-title">Service Providers</h3>

<div id="new-products" class="owl-carousel owl-theme">
  
<?php
//print_r($srs);
   if(is_array($srs)){
     foreach($srs as $mys){
      $this->load->model('Home_model','home'); 
      $cats=$this->home->getserviceprovidercategorybyuserid($mys['userid']);
      
         
?>
<div class="item">
<div class="product-item">
<div class="carousel-thumb"> 
<div class="overlay">
<div>
<a class="btn btn-common" href="<?=$base_url?>serviceprovider-details/<?=$mys['userid']?>">View Details</a>
</div>
</div>
</div>

<div class="product-content">
<figure>
<img src="<?=$base_url?>assets/img/author/thumb/<?=$mys['profileimg']?>" alt="">
</figure>
<span class="bolticon"></span>
<div class="user-name">
<h3 class="product-title"><a href="<?=$base_url?>serviceprovider-profile/<?=$mys['userid']?>"><?=ucfirst($mys['surname'])?></a>
</h3>
</div>
<?php if($mys['isonline'] == 1){ echo "<p class='text-success'>Online</p>"; } else { echo "<p>Offline</p>"; }?> 
<?php 
 if(is_array($cats)){
  foreach($cats as $c){
?>
<span class="text-info"><?=$c['category']?>,</span>
<?php 
  }
  }
?>

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
<input type="hidden" id="s<?=$mys['userid']?>"  value="<?=$mys['userid']?>">
<button class="btn btn-success" id="<?=$mys['userid']?>" onclick="invite(this.id)">Invite</button>
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
<?php } ?>


</div>

<aside id="sidebar" class="col-lg-4 col-md-12 col-xs-12 right-sidebar">


<div class="widget categories">
<ul class="offers-user-online">
<?php if($adsdet['isonline'] == 1){?>
<li class="offerer">
<figure>
<img src="<?=$base_url?>assets/img/author/thumb/<?=$adsdet['profileimg']?>" alt="">
</figure>
<span class="bolticon"></span>
<div class="user-name">
<h3><?=$adsdet['surname']?></h3>
<h4><a href="#">Online</a></h4>
</div>
</li>
<?php } else if($adsdet['isonline'] == 0){?>
<li class="offerer">
<figure>
<img src="<?=$base_url?>assets/img/author/thumb/<?=$adsdet['profileimg']?>" alt="">
</figure>
<div class="user-name">
<h3><?=$adsdet['surname']?></h3>
<h4><a href="#">offline</a></h4>
</div>
</li>
<?php } ?>

<li class="offerer">
Budget <span class="category-counter">Rs.<?=$adsdet['budget']?></span>
</li>
<li class="offerer">
Ad Status <span class="category-counter">
  
  <?php  
     if($adsdet['status'] == 1){
       echo '<h5 class="name"><span class="badge badge-danger">Active</span></h5>';
     }
    else if($adsdet['status'] == 3){
      echo '<h5 class="name"><span class="badge badge-success">Awarded</span></h5>';
    }
    else if($adsdet['status'] == 4){
      echo '<h5 class="name"><span class="badge badge-success">Completed</span></h5>';
    }else{}
  ?>
</span>
</li>

</ul>
</div>


</aside>

</div>
</div>
</div>