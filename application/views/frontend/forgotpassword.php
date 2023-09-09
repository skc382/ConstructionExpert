
<div class="page-header" style="background: url(assets/img/banner1.jpg);">
<div class="container">
<div class="row">
<div class="col-md-12">
<div class="breadcrumb-wrapper">
<h2 class="product-title"><?=$title?> </h2>
<ol class="breadcrumb">
<li><a href="index-2.html">Home /</a></li>
<li class="current"><?=$title?> </li>
</ol>
</div>
</div>
</div>
</div>
</div>


<section class="login section-padding">
<div class="container">
<div class="row justify-content-center">
<div class="col-lg-5 col-md-12 col-xs-12">
<div class="login-form login-area">
<h3>
<?=$title?> 
</h3>
<?php
if(isset($_GET['i'])){
  if($_GET['i'] == 1){
    echo '<p class="alert alert-success">Email verified successfully.</p>';
  }
}
?>
<form id="forgotform" class="login-form">
<p id="reg_error"></p>
<input type="hidden" name="<?php echo $csrf['name']; ?>" id="<?php echo $csrf['name']; ?>" value="<?php echo $csrf['hash']; ?>">
<div class="form-group">
<div class="input-icon">
<i class="lni-user"></i>
<input type="text" id="email" class="form-control" name="email" placeholder="Email">
</div>
</div>

<div class="text-center">
<button class="btn btn-common log-btn">Submit</button>
</div>
<div class="form-group">
<a  class="forgetpassword" href="<?=$base_url?>register">New User? Register</a>
</div>
</form>
 
</div>
</div>
</div>
</div>
</section>
