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

<div class="blog-post single-post">

<div class="post-thumb">
<a href="#"><img class="img-fluid" src="assets/img/blog/blog1.jpg" alt=""></a>
<div class="hover-wrap">
</div>
</div>


<div class="post-content">
<h2 class="post-title"><a href="single-post.html"><?=$post['blogtitle']?></a></h2>
<div class="meta">
<span class="meta-part"><a href="#"><i class="lni-user"></i> <?=$post['postedby']?></a></span>
<span class="meta-part"><a href="#"><i class="lni-alarm-clock"></i> <?=date('M d, Y',strtotime($post['postdate']))?></a></span>
<span class="meta-part"><a href="#"><i class="lni-comments-alt"></i> <?=$cmtcount?> Comments</a></span>
</div>
<div class="entry-summary">
<p><?=$post['blogcontent']?></p>
</div>
</div>

</div>


<div id="comments">
<div class="comment-box">
<h3>Comments</h3>
<ol class="comments-list">
<?php
  if(is_array($cmts)){
    foreach($cmts as $c){
      ?>
<li>
  <div class="media">
    <div class="thumb-left">
    <a href="#">
    <img class="img-fluid" src="assets/img/blog/user3.jpg" alt="">
    </a>
    </div>
    <div class="info-body">
        <div class="media-heading">
        <h4 class="name"><?=$c['fname']?></h4>
        <span class="comment-date"><i class="lni-alarm-clock"></i> <?=date('M d, Y',strtotime($c['cmtdate']))?></span>
        <a href="#" class="reply-link"><i class="lni-reply"></i> Reply</a>
        </div>
        <p><?=$c['message']?></p>
    </div>
  </div>
</li>
<?php 
    }
  }
?>
</ol>

<div id="respond">
<p id="cmt_error" class="text-center"></p><br>
<h2 class="respond-title">Leave A Comment </h2>
<form id="commentform">
<div class="row">
<div class="col-lg-6 col-md-6 col-xs-12">
<div class="form-group">
<input type="hidden" name="<?php echo $csrf['name']; ?>" id="<?php echo $csrf['name']; ?>" value="<?php echo $csrf['hash']; ?>">
<input type="hidden" name="blogid" id="blogid" value="<?=$this->uri->segment(2)?>">
<input id="author" class="form-control" name="author" type="text" size="30" placeholder="Your Name" value="<?=isset($this->session->userdata('user_session')['surname']) ? $this->session->userdata('user_session')['surname'] : ''?>" required>
</div>
 </div>
<div class="col-lg-6 col-md-6 col-xs-12">
<div class="form-group">
<input id="authoremail" class="form-control" name="authoremail" type="text" size="30" placeholder="Your E-Mail" value="<?=isset($this->session->userdata('user_session')['email']) ? $this->session->userdata('user_session')['email'] : ''?>" required>
</div>
</div>
</div>
<div class="row">
<div class="col-lg-12 col-md-12col-xs-12">
<div class="form-group">
<textarea id="comment" class="form-control" name="comment" cols="45" rows="8" placeholder="Massage..." required></textarea>
</div>
<button type="submit"  class="btn btn-common">Post Comment</button>
</div>
</div>
</form>
</div>

</div>
</div>

</div>



</div>
</div>
</div>
