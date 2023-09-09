<div class="page-header" style="background: url(assets/img/banner1.jpg);">
<div class="container">
<div class="row">
<div class="col-md-12">
<div class="breadcrumb-wrapper">
<h2 class="product-title">Join Us</h2>
<ol class="breadcrumb">
<li><a href="#">Home /</a></li>
<li class="current">Register</li>
</ol>
</div>
</div>
</div>
</div>
</div>


<section class="register section-padding">
<div class="container">
<div class="row justify-content-center">
<div class="col-lg-5 col-md-12 col-xs-12">
<div class="register-form login-area">
<h3>
Register
</h3>
<form class="login-form" id="registerform">
<input type="hidden" name="<?php echo $csrf['name']; ?>" id="<?php echo $csrf['name']; ?>" value="<?php echo $csrf['hash']; ?>">	
<div class="form-group">
<div class="input-icon">
<i class="lni-user"></i>
<input type="text" id="surname" class="form-control" name="surname" placeholder="Full Name">
</div>
</div>
<div class="form-group">
<div class="input-icon">
<i class="lni-mobile"></i>
<input type="text" pattern="^\d{10}$"  title="Phone number 10 digit"  id="mobile" class="form-control" name="mobile" placeholder="Mobile">
</div>
</div>
<div class="form-group">
<div class="input-icon">
<i class="lni-envelope"></i>
<input type="email" id="email" class="form-control" name="email" placeholder="Email Address">
</div>
</div>

<div class="form-group">
<div class="input-icon">
<i class="lni-lock"  id="tog-pwd"></i>
<input type="password" id="pass" class="form-control" name="pass" placeholder="Password">
</div>
</div>
<div class="form-group">
<div class="input-icon">
<i class="lni-lock"  id="tog-pwd1"></i>
<input type="password" id="rpass" class="form-control" name="rpass" placeholder="Retype Password">
</div>
</div>
<div class="form-group">
<div class="input-icon">
<select id="role" class="form-control" name="role">
  <option value="">Role</option>
  <?php
  if(is_array($roles)){
    foreach ($roles as $role) {
     echo '<option value='.$role['roleid'].'>'.$role['rolename'].'</option>';
    }
  }
  ?>
</select>
</div>
</div>
<div class="add_service">
    <div class="form-group">
    <select id="scat" class="form-control" name="scat" required>
      <option value="">Service Category</option>
      <?php
        if(is_array($category)){
          foreach($category as $cat){
            echo '<option value='.$cat['catid'].'>'.ucfirst($cat['category']).'</option>';
          }
        }
      ?>
    </select>
    </div>
    <div class="form-group">
    <label class="control-label">Service Title *</label>
    <input class="form-control input-md" name="stitle" id="stitle" type="text" required>
    </div>
    <div class="form-group">
    <label class="control-label">Service Experience *</label>
    <select name="exp" id="exp" class="form-control" required>
    <option value="">Select </option>
    <option value="beginner">Beginner</option>
    <option value="intermediate">Intermediate</option>
    <option value="expert">Expert</option>
    </select>
    </div>
    <div class="form-group mb-3">
    <label class="control-label">Service Location *</label> 
    <select name="sloc" id="sloc" required class="tg-select form-control">
    <option value="">Select </option>
    <?php
      if(is_array($servicelocation)){
        foreach($servicelocation as $sloc){
          echo '<option value='.$sloc['location'].'>'.$sloc['location'].'</option>';
        }
      }
    ?>
    </select>
    </div>

</div>
<div class="form-group mb-3">
<div class="custom-control custom-checkbox">
<input type="checkbox" class="custom-control-input" id="agree" name="agree" title="Please agree to our terms and conditions">
<label class="custom-control-label" for="agree">By registering, you accept our Terms &amp; Conditions</label>
</div>
</div>
<div class="text-center form-group">
<button class="btn btn-common log-btn" type="submit" id="regbtn">Register</button>
</div>
<div class="form-group" id="reg_error"></div>
<div class="form-group">
<a  class="forgetpassword" href="<?=$base_url?>login">Existing User? Login</a>
</div>
</form>
</div>
</div>
</div>
</div>
</section>