<div class="page-header" style="background: url(assets/img/banner1.jpg);">
<div class="container">
<div class="row">
<div class="col-md-12">
<div class="breadcrumb-wrapper">
<h2 class="product-title"><?=$title?></h2>
<ol class="breadcrumb">
<li><a href="#">Home /</a></li>
<li class="current"><?=$title?></li>
</ol>
</div>
</div>
</div>
</div>
</div>


<section id="google-map-area">
<div class="container">
<div class="row">
<div class="col-12">
<!-- <object style="border:0; height: 450px; width: 100%;" data="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d34015.943594576835!2d-106.43242624069771!3d31.677719472407432!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x86e75d90e99d597b%3A0x6cd3eb9a9fcd23f1!2sCourtyard+by+Marriott+Ciudad+Juarez!5e0!3m2!1sen!2sbd!4v1533791187584"></object> -->
</div>
</div>
</div>
</section>


<section id="content" class="section-padding">
<div class="container">
<div class="row">
<div class="col-lg-8 col-md-8 col-xs-12">

<div id="msgSubmit" class="text-center"></div>
<form id="contactForm" class="contact-form" >
<input type="hidden" name="<?php echo $csrf['name']; ?>" id="<?php echo $csrf['name']; ?>" value="<?php echo $csrf['hash']; ?>">
<h2 class="contact-title">
Send Message Us
</h2>
<div class="row">
<div class="col-md-12">
  <div class="row">
      <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12">
      <div class="form-group">
      <input type="text" class="form-control" id="name" name="name" placeholder="Name" required >
      <div class="help-block with-errors"></div>
      </div>
      </div>
      <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12">
      <div class="form-group">
      <input type="email" class="form-control" name="email" id="email" placeholder="Email" required >
      <div class="help-block with-errors"></div>
      </div>
      </div>
      <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12">
      <div class="form-group">
      <input type="text" class="form-control" id="phone" name="phone" placeholder="Phone" required >
      <div class="help-block with-errors"></div>
      </div>
      </div>
  </div>
</div>

<div class="col-sm-12 col-md-12 col-lg-12">
<div class="row">

<div class="col-md-12">
<div class="form-group">
<textarea class="form-control"  name="msg"  name="msg" placeholder="Message" rows="7"  required></textarea>
<div class="help-block with-errors"></div>
</div>
</div>
</div>
 </div>
<div class="col-md-12">
<button type="submit"  class="btn btn-common">Submit Now</button>

<div class="clearfix"></div>
</div>
</div>
</form>
</div>

</div>
</div>
</section>
