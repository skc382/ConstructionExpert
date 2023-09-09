<div id="hero-area" style="background: url('./assets/img/background/thumb/<?=$web[0]['bannerlogo']?>') no-repeat;">
<div class="overlay"></div>
<div class="container">
<div class="row justify-content-center">
<div class="col-md-12 col-lg-9 col-xs-12 text-center">
<div class="contents">
<h1 class="head-title">We Build Your  <span class="year">Dream</span></h1>
<p>All your construction needs under one roof.</p>

<div class="search-bar">
<div class="search-inner">
<form action="<?=$base_url?>search" method="post">
<input type="hidden" name="<?php echo $csrf['name']; ?>" id="<?php echo $csrf['name']; ?>" value="<?php echo $csrf['hash']; ?>">
<div class="form-group">
<input type="text"  name="customword" id="customword"  class="form-control"  data-toggle="dropdown" placeholder="What are you looking for?">
</div>
<div class="form-group inputwithicon">
<div class="select">
<select  name="sloc" id="sloc" >
<option value="">Locations</option>
<?php
   if(is_array($locations)){
     foreach($locations as $loc){
       echo '<option value='.$loc['servicelocation'].'> '.ucfirst($loc['servicelocation']).'</option>';
     }
   }
?>
</select>
</div>
<i class="lni-target"></i>
</div>
<div class="form-group inputwithicon">
<div class="select">
<select name="scat" id="scat" >
<option value="">Select Catagory</option>
<?php
   if(is_array($categories)){
     foreach($categories as $cat){
       echo '<option value='.$cat['catid'].'> '.ucfirst($cat['category']).'</option>';
     }
   }
?>
</select>
</div>
<i class="lni-menu"></i>
</div>
<button class="btn btn-common" type="submit"><i class="lni-search"></i> Search Now</button>
</form>
</div> 
</div>
<br>
<p>Popular Services :
<?php
$is =0;
   if(is_array($myservice)){
     foreach($myservice as $mys){
       if($is < 10){
    ?>
     <span><a class="text-white" href="<?=$base_url?>serviceprovider-details/<?=ucwords($mys['user_serviceid'])?>" ><?=$mys['servicetitle']?></a>.</span>
    <?php
       }
       $is++;
     }
   }
?>
</p>

<p>Tags :
<?php
$is =0;
   if(is_array($tags)){
     foreach($tags as $tag){
       if($is < 10){
    ?>
     <span><a class="text-white" ><?=$tag['tagname']?></a>.</span>
    <?php
       }
       $is++;
     }
   }
?>
</p>
</div>

</div>
</div>
</div>
</div>

</header>


<!-- <section id="categories">
<div class="container">
<div class="row justify-content-center">
<div class="col-lg-10 col-md-12 col-xs-12">
<div id="categories-icon-slider" class="categories-wrapper owl-carousel owl-theme">

<?php
  //  if(is_array($categories)){
  //    foreach($categories as $cat){
  //      echo '<div class="item">
  //      <a href="'.$base_url.'service-category/'.$cat['catid'].'">
  //      <div class="category-icon-item">
  //      <div class="icon-box">
  //      <div class="icon">
  //     <img src="'.$base_url.'assets/img/category/img-7.png" alt="">
  //     </div>
  //      <h4>'.ucwords($cat['category']).'</h4>
  //      <span>'.$cat['listings'].' Listings</span>
  //      </div>
  //      </div>
  //      </a>
  //      </div>';
  //    }
  //  }
?>



</div>
</div>
</div>
</div>
</section> -->


<section class="categories-icon bg-light section-padding">
<div class="container">
<h1 class="section-title">Category</h1>
<div class="row">
<?php
   if(is_array($categories)){
     foreach($categories as $cat){
    if($cat['orgimage'] != NULL){
        $img = $base_url.'assets/img/category/'.$cat['orgimage'];
    }
    else{ 
        $img = $base_url.'assets/img/category/img-1.png';
    }
       echo '<div class="col-lg-3 col-md-4 col-sm-6 col-xs-12" >
       <a href="'.$base_url.'service-category/'.$cat['catid'].'">
        <div class="icon-box">
          <div class="icon">
          <img src="'.$img.'" alt="">
          </div>
        <h4>'.ucwords($cat['category']).'</h4>
        <span>'.$cat['listings'].' Listings</span>
        </div>
        </a>
      </div>';
     }
   }
?>

</div>
</div>
</section>





<!-- <section class="featured-lis section-padding">
<div class="container">
<div class="row">
<div class="col-md-12 wow fadeIn" data-wow-delay="0.5s">
<h3 class="section-title">Explore Popular Services</h3>
<div id="new-products" class="owl-carousel owl-theme">
<?php

  //  if(is_array($myservice)){
  //    foreach($myservice as $mys){
 

?>
<div class="item">
<div class="product-item">
<div class="carousel-thumb">
<img class="img-fluid" src="<?=$base_url?>assets/img/featured/thumb/<?=$mys['serviceimage']?>" alt="">
<div class="overlay">
<div>
<a class="btn btn-common" href="<?=$base_url?>serviceprovider-details/<?=$mys['user_serviceid']?>">View Details</a>
</div>
</div>
</div>

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
        // }
        //   }
?>



</div>
</div>
</div>
</div>
</section> -->


<section class="works section-padding">
<div class="container">
<div class="row">
<div class="col-12">
<h3 class="section-title">How It Works?</h3>
</div>
<div class="col-lg-4 col-md-4 col-xs-12">
<div class="works-item">
<div class="icon-box">
<img src="<?=$base_url?>assets/img/about/step1.png">
</div>
<p>Post us your Requirement
</p>
</div>
</div>
<div class="col-lg-4 col-md-4 col-xs-12">
<div class="works-item">
<div class="icon-box">
<img src="<?=$base_url?>assets/img/about/step2.png">
</div>
<p>
Get Multiple quotations from top service providers
</p>
</div>
</div>
<div class="col-lg-4 col-md-4 col-xs-12">
<div class="works-item">
<div class="icon-box">
<img src="<?=$base_url?>assets/img/about/step3.png">
</div>
<p>
Get it done within your Budget
</p>
</div>
</div>
<hr class="works-line">
</div>
</div>
</section>


<section class="testimonial section-padding">
<div class="container">
<h2 class="section-title">
Reviews
</h2>
<div class="row">
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
<div id="testimonials" class="owl-carousel">
<?php
   if(is_array($reviews)){
     foreach($reviews as $rv){
?>
<div class="item">  
  <div class="testimonial-item">
    <div class="content">
    <p class="description"><?=$rv['feedback']?></p>
      <div class="info-text">
      <h2><a href="#"><?=ucfirst($rv['name'])?></a></h2>
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


<!-- <section id="blog" class="section-padding">

<div class="container">
<h2 class="section-title">
Latest Articles
</h2>
<div class="row">
<?php
   if(is_array($posts)){
     foreach($posts as $p){
?>

<div class="col-lg-4 col-md-6 col-xs-12 blog-item">
  <div class="blog-item-wrapper">     
      <div class="blog-item-text">
        <div class="meta-tags">
        <span class="user float-left"><a href="#"><i class="lni-user"></i> Posted By <?=$p['postedby']?></a></span>
        <span class="date float-right"><i class="lni-calendar"></i> <?=date('d-M-Y',strtotime($p['postdate']))?></span>
        </div>
        <h3>
        <a href="<?=$base_url?>post-details/<?=$p['blogid']?>"><?=$p['blogtitle']?></a>
        </h3>
        <p>
        <?=substr($p['blogcontent'],0,200)?>
        </p>
        <a href="<?=$base_url?>post-details/<?=$p['blogid']?>" class="btn btn-common">Read More</a>
      </div>
  </div>
</div>
<?php
     }
   }
?>
</div>
</div>
</section> -->






