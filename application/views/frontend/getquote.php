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



<section id="content" class="section-padding">
<div class="container">
<div class="row">
<div class="col-lg-8 col-md-8 col-xs-12">

<div id="msgSubmit" class="text-center"></div>
<form id="quoteForm" class="contact-form" >
<input type="hidden" name="<?php echo $csrf['name']; ?>" id="<?php echo $csrf['name']; ?>" value="<?php echo $csrf['hash']; ?>">
<h2 class="contact-title">
Send Us Message
</h2>
<div class="row">
<div class="col-md-12">
<div class="form-group">
<select name="catid" id="catid" class="form-control" required>
<option value="">Select Catagory</option>
<?php
   if(is_array($categories)){
     foreach($categories as $cat){
       echo '<option value='.$cat['catid'].'>'.$cat['category'].'</option>';
     }
   }
?>
</select>
</div>
</div>
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
      <input type="text" pattern="^\d{10}$"  title="Phone number 10 digit"  class="form-control"  id="phone" name="phone" placeholder="Phone" required >
      <div class="help-block with-errors"></div>
      </div>
      </div>
  </div>
</div>
<div class="col-md-12">
  <div class="row">
      <!--<div class="col-lg-4 col-md-12 col-sm-12 col-xs-12">-->
      <!--<div class="form-group">-->
      <!--<input type="text" class="form-control" id="cmpname" name="cmpname" placeholder="Company name"  >-->
      <!--<div class="help-block with-errors"></div>-->
      <!--</div>-->
      <!--</div>-->
      <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12">
      <div class="form-group">
      <input type="text" class="form-control" name="city" id="city" placeholder="City"  required>
      <div class="help-block with-errors"></div>
      </div>
      </div>
      <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12">
      <div class="form-group">
      <input type="text" pattern="^\d{6}$"  title="pincode 6 digit" class="form-control"  id="pincode" name="pincode" placeholder="Pincode"  required>
      <div class="help-block with-errors"></div>
      </div>
      </div>
  </div>
</div>
<div class="col-sm-12 col-md-12 col-lg-12">
<div class="row">
<div class="col-md-6">
<div class="form-group">
<textarea class="form-control"  name="address"  name="address" placeholder="Address" rows="7"></textarea>
<div class="help-block with-errors"></div>
</div>
</div>

<div class="col-md-6">
<div class="form-group">
<textarea class="form-control"  name="msg"  name="msg" placeholder="Description" rows="7"></textarea>
<div class="help-block with-errors"></div>
</div>
</div>
</div>
 </div>
<div class="col-md-12">
<button type="submit"  class="btn btn-common" id="btnquote">Submit Now</button>

<div class="clearfix"></div>
</div>
</div>
</form>
</div>

</div>
</div>
</section>
