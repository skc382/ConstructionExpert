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


<div id="content" class="section-padding">
<div class="container">
<div class="row">
<div class="col-lg-12 col-md-12 col-xs-12">
<?php
  if(is_array($posts)){
    foreach($posts as $post){
      $count = $this->home->countcommentsbypostid($post['blogid']);
      ?>
<div class="blog-post">

<div class="post-content">
<div class="meta">
<span class="meta-part"><a href="#"><i class="lni-user"></i> <?=$post['postedby']?></a></span>
<span class="meta-part"><a href="#"><i class="lni-alarm-clock"></i> <?=date('M d, Y',strtotime($post['postdate']))?></a></span>
<span class="meta-part"><a href="#"><i class="lni-comments-alt"></i> <?=$count?> Comments</a></span>
</div>
<h2 class="post-title"><a href="<?=$base_url?>post-details/<?=$post['blogid']?>"><?=$post['blogtitle']?></a></h2>
<div class="entry-summary">
<p><?=substr($post['blogcontent'],0,500)?></p>
</div>
<a href="<?=$base_url?>post-details/<?=$post['blogid']?>" class="btn btn-common">Read More</a>
</div>

</div>


  <?php
    }
  }
?>



<?php echo $links; ?>

</div>
</div>
</div>
</div>
