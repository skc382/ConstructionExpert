<footer>
<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" id="user_csrf" />
<section class="footer-Content">
<div class="container">
<div class="row">
<div class="col-lg-4 col-md-4 col-xs-6 col-mb-12">
<div class="widget">
<div class="footer-logo"><img src="<?=$base_url?>backend/img/web/<?=$web[0]['sitelogo']?>" alt=""></div>
<p><?=substr(html_entity_decode($web[0]['about']),0,100)?></p>
<ul class="mt-3 footer-social">
<li><a class="facebook" href="<?=$web[0]['fb']?>"><i class="lni-facebook-filled"></i></a></li>
<li><a class="twitter" href="<?=$web[0]['tw']?>"><i class="lni-twitter-filled"></i></a></li>
</ul>
</div>
</div>
<div class="col-lg-4 col-md-4 col-xs-6 col-mb-12">
<div class="widget">
<h3 class="block-title">Useful Links</h3>
<ul  class="menu">
<li><span><a href="<?=$base_url?>about">- About Us</a></span></li>
<li><span><a href="<?=$base_url?>blog"">- Blog</a></span></li>
<li><span><a href="<?=$base_url?>services">- Services</a></span></li>
<li><span><a href="<?=$base_url?>contact">- Contact</a></span></li>
<li><span><a href="<?=$base_url?>register">- Become Service Provider</a></span></li>
</ul>
</div>
</div>
<div class="col-lg-4 col-md-4 col-xs-6 col-mb-12">
<div class="widget">
<h3 class="block-title">Contact Info</h3>
<ul class="contact-footer">
<li>
<strong><i class="lni-phone"></i></strong><span><?=$web[0]['sitephone'];?> <br> </span>
</li>
<li>
<strong><i class="lni-envelope"></i></strong><span><?=$web[0]['sitemail'];?> </span>
</li>
<li>
<strong><i class="lni-map-marker"></i></strong><span><a href="#"><?=$web[0]['siteaddress'];?></a></span>
</li>
</ul>
</div>
</div>
</div>
</div>
</section>


<div id="copyright">
<div class="container">
<div class="row">
<div class="col-md-12">
<div class="site-info text-center">
<p><a target="_blank" href="https://templateshub.net"><?=$web[0]['sitename'];?> &copy; <?=date('Y');?></a></p>
</div>
</div>
</div>
</div>
</div>

</footer>

<input type="hidden" id="page" value="<?=$page?>">

<a href="#" class="back-to-top">
<i class="lni-chevron-up"></i>
</a>

<div id="preloader">
<div class="loader" id="loader-1"></div>
</div>


<script src="<?=$base_url?>assets/js/jquery-min.js"></script>
<script src="<?=$base_url?>assets/js/jquery-ui.min.js"></script>
<script src="<?=$base_url?>assets/js/popper.min.js"></script>
<script src="<?=$base_url?>assets/js/bootstrap.min.js"></script>
<script src="<?=$base_url?>assets/js/jquery.counterup.min.js"></script>
<script src="<?=$base_url?>assets/js/waypoints.min.js"></script>
<script src="<?=$base_url?>assets/js/wow.js"></script>
<script src="<?=$base_url?>assets/js/owl.carousel.min.js"></script>
<script src="<?=$base_url?>assets/js/jquery.slicknav.js"></script>
<script src="<?=$base_url?>assets/js/main.js"></script>
<script src="<?=$base_url?>assets/js/jquery.validate.js"></script>
<script src="<?=$base_url?>assets/js/summernote.js"></script>
<script src="<?=$base_url?>assets/js/select2.min.js"></script>
<script>var baseurl = "<?=$base_url?>";</script>
<script src="<?=$base_url?>assets/js/home.js"></script>
<script>
      $('.summernote').summernote({
          height: 250, // set editor height
          minHeight: null, // set minimum height of editor
          maxHeight: null, // set maximum height of editor
          focus: false // set focus to editable area after initializing summernote
      });

      $('.selectpicker').select2();

      $('#tog-pwd').hover(function show() {  
                //Change the attribute to text  
                $('#password').attr('type', 'text');  
                $('.icon').removeClass('lni-lock').addClass('lni-eye');  
            },  
            function () {  
                //Change the attribute back to password  
                $('#password').attr('type', 'password');  
                $('.icon').removeClass('lni-eye').addClass('lni-lock');  
            });
    </script>
</body>


</html>