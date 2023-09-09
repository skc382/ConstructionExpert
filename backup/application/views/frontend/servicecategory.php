<div class="page-header" style="background: url(assets/img/banner1.jpg);">
<div class="container">
<div class="row">
<div class="col-md-12">
<div class="breadcrumb-wrapper">
<h2 class="product-title"><?=$title?></h2>
<ol class="breadcrumb">
<li><a href="<?=$base_url?>">Home /</a></li>
<li class="current"><?=$title?></li>
</ol>
</div>
</div>
</div>
</div>
</div>
</header>


<div class="main-container section-padding">
<div class="container">
<div class="row">
<div class="col-lg-3 col-md-12 col-xs-12 page-sidebar">
<aside>

<div class="widget_search">
<form role="search" action="<?=$base_url?>search" method="post">
<input type="hidden" name="<?php echo $csrf['name']; ?>" id="<?php echo $csrf['name']; ?>" value="<?php echo $csrf['hash']; ?>">

<div class="form-group">
<select  name="sloc" id="sloc" required class="form-control" required>
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

<div class="form-group">
<select name="scat" id="scat" required class="form-control">
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
<div class="form-group">
<select  name="price" id="price" required class="form-control" >
<option value="">Price</option>
<option value="asc">Low - High</option>
<option value="desc">High - Low</option>
</select>
</div>
<div class="form-group">
<select  name="exp" id="exp" required class="form-control" >
<option value="">Experience</option>
<option value="beginner">Beginner</option>
<option value="intermediate">Intermediate</option>
<option value="expert">Expert</option>
</select>
</div>
<div class="form-group">
<button type="submit" id="search-submit" class="btn btn-action btn-block">Search</button>
</div>
</form>
</div>

<div class="widget categories">
<h4 class="widget-title">All Categories</h4>
<ul class="categories-list">
<ul class="categories-list">
<?php
   if(is_array($categories)){
     foreach($categories as $cat){
?>
<li>
<a href="<?=$base_url?>service-category/<?=$cat['catid']?>">

<?=ucfirst($cat['category'])?> <span class="category-counter">(<?=$cat['listings']?>)</span>
</a>
</li>
<?php
     }
   }
?>


</ul>
</ul>
</div>
</aside>
</div>
<div class="col-lg-9 col-md-12 col-xs-12 page-content">

<div class="adds-wrapper">
<div class="tab-content">
  <div id="grid-view" class="tab-pane fade active show">
       <div class="row">
       <?php 
       // echo $total_rows;
          if(is_array($myservice)){
              foreach($myservice as  $mys){
        ?>
              <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="featured-box">       
                        <div class="feature-content">
                            <div class="product">
                            <a href="<?=$base_url?>service-category/<?=$mys['catid']?>"><?=$mys['category']?></a>
                            </div>
                            <h4><a href="<?=$base_url?>serviceprovider-details/<?=$mys['user_serviceid']?>"><?=$mys['servicetitle']?> - Rs.<?=$mys['price']?></a></h4>
                            <div class="meta-tag">
                            <span>
                            <a href="#"><i class="lni-user"></i> <?=$mys['surname']?></a>
                            </span>
                            <span>
                            <a href="#"><i class="lni-map-marker"></i> <?=$mys['servicelocation']?></a>
                            </span>
                            <span>
                            <a href="#"><i class="lni-tag"></i> <?=$mys['category']?></a>
                            </span>
                            </div>
                            <p class="dsc"><?=substr(html_entity_decode($mys['servicedesc']),0,300)?>.....</p>
                       
                         </div><!--  feature-content -->
                    </div><!--  feature-box -->
               </div><!--  end-col -->
               <?php 
              }
          } 
          ?>
      </div><!--  end-row -->
</div><!--  end-grid -->
</div><!--  end-tabbcontent -->


</div><!--  adds-wrapper -->
<?php echo $links; ?>
</div><!--  end col page content -->




</div>
</div>
</div>
</div>
