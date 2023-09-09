<div class="page-header" style="background: url(assets/img/banner1.jpg);">
<div class="container">
<div class="row">
<div class="col-md-12">
<div class="breadcrumb-wrapper">
<h2 class="product-title">Post you Ads</h2>
<ol class="breadcrumb">
<li><a href="#">Home /</a></li>
<li class="current">Post you Ads</li>
</ol>
</div>
</div>
</div>
</div>
</div>


<div id="content" class="section-padding">
<div class="container">
<div class="row">
<div class="col-sm-12 col-md-4 col-lg-3 page-sidebar">
<aside>
<div class="sidebar-box">
<div class="user">
<figure>
<a href="#"><img id="picimg" src="./assets/img/author/thumb/<?=$upr['profileimg']?>" alt=""></a>
</figure>
<div class="usercontent">
<h3>Hello <?php echo $this->session->userdata('user_session')['surname'];?></h3>
</div>
</div>
<nav class="navdashboard">
<ul>
<li>
<a  href="<?=$base_url?>user-dashboard">
<i class="lni-dashboard"></i>
<span>Dashboard</span>
</a>
</li>
<li>
<a href="<?=$base_url?>user-profile">
<i class="lni-cog"></i>
<span>Profile Settings</span>
</a>
</li>
<li>
<a href="<?=$base_url?>my-ads" class="active">
<i class="lni-layers"></i>
<span>My Enquiries</span>
</a>
</li>
<li>
<a href="offermessages.html">
<i class="lni-envelope"></i>
<span>Offers/Messages</span>
</a>
</li>

<li>
<a href="privacy-setting.html">
<i class="lni-star"></i>
<span>Privacy Settings</span>
</a>
</li>
<li>
<a href="<?=$base_url?>user-logout">
<i class="lni-enter"></i>
<span>Logout</span>
</a>
</li>
</ul>
</nav>
</div>
</aside>
</div>
<div class="col-sm-12 col-md-8 col-lg-9">
<div class="row page-content">
<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
<div class="inner-box">
<div class="dashboard-box">
<h2 class="dashbord-title">Post Enquiry</h2>
</div>
<div class="dashboard-wrapper">
        <p id="ads_error"></p>
        <form id="jobform">
        <input type="hidden" name="<?php echo $csrf['name']; ?>" id="<?php echo $csrf['name']; ?>" value="<?php echo $csrf['hash']; ?>">	
        <div class="form-group mb-3">
        <label class="control-label">Project Title</label>
        <input class="form-control input-md" name="title" id="title" required placeholder="Title" type="text">
        </div>
        <div class="form-group mb-3 tg-inputwithicon">
        <label class="control-label">Categories</label>
        <div class="tg-select form-control">
        <select name="catid" id="catid" required>
        <option value="">Select Categories</option>
        <?php 
        if(is_array($categories)){
          foreach($categories as $c){
            echo '<option value='.$c['catid'].'>'.$c['category'].'</option>';
          }
        }
        ?>
        </select>
        </div>
        </div>
        <div class="form-group mb-3">
        <label class="control-label">Price </label>
        <input class="form-control input-md" name="price" id="price" placeholder="Your Budget" type="number">
        </div>
        <div class="form-group md-3">
        <label class="control-label">Enquiry Details </label>
        <section id="editor">
        <textarea class="summernote" id="addescription" name="addescription"></textarea>
        </section>
        </div>
        <button class="btn btn-common" type="submit">Submit</button>
        </form>

</div>
</div>
</div>

</div>
</div>
</div>
</div>
</div>
