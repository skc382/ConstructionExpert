<div class="page-header" style="background: url(assets/img/banner1.jpg);">
<div class="container">
<div class="row">
<div class="col-md-12">
<div class="breadcrumb-wrapper">
<h2 class="product-title">Profile Settings</h2>
<ol class="breadcrumb">
<li><a href="#">Home /</a></li>
<li class="current">Profile Settings</li>
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
<a href="<?=$base_url?>user-profile" >
<i class="lni-cog"></i>
<span>Profile Settings</span>
</a>
</li>

<?php 
if($this->session->userdata('user_session')['rolename'] == 'SR'){   
?>
<li>
<a href="<?=$base_url?>my-services" >
<i class="lni-layers"></i>
<span>My Services</span>
</a>
</li>
<li>
<a href="<?=$base_url?>my-job-invitation" class="active">
<i class="lni-layers"></i>
<span>Job Notification</span>
</a>
</li>
<?php 
}
?>



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
              <h2 class="dashbord-title"><?=$title?> - <a href="<?=$base_url?>ad-details/<?=$wrkdet['adid']?>"><?=$wrkdet['title']?></a></h2>
              <p id="awardmsg"></p>
              <ul class="offers-user-online">
            
              <li class="offerer">
              <figure>
              <?php $img = isset($wrkdet['profileimg']) ? 'thumb/'.$wrkdet['profileimg'] : 'img1.jpg';?>
              <img src="<?=$base_url?>assets/img/author/<?=$img?>" alt="">
              </figure>
              
              <?php if($wrkdet['isonline'] == 1) { ?>
              <span class="bolticon"></span>
              <div class="user-name">
              <h3><?=ucfirst($wrkdet['surname'])?></h3>
              <h4>Online</h4>
              </div>
              <?php } else {?>
              <div class="user-name">
              <h3><?=ucfirst($wrkdet['surname'])?></h3>
              </div>
              <?php } ?>
              </li>
              <?php 
              if($this->session->userdata('user_session')['rolename'] == 'CR' && $wrkdet['awarded_userid'] == NULL){   
              ?>
              <li class="offerer"><button class="btn-action btn-common" id="award">Award</button></li>
              <?php }  ?>
              <?php 
               if($this->session->userdata('user_session')['rolename'] == 'CR' && $wrkdet['awarded_userid'] != NULL){   
              ?>
              <li class="offerer"><button class="btn btn-action btn-common" >Awarded</button></li>
              <?php }   ?>
              <?php 
              if($this->session->userdata('user_session')['rolename'] == 'SR' && $wrkdet['awarded_userid'] == $this->session->userdata('user_session')['user_id']){ 
              ?>
              <li class="offerer"><button class="btn btn-action btn-info">Awarded <i class="lni lni-thumbs-up"></i></button>
              <?php 
              if($wrkdet['status'] == 3){
                echo ' <button class="btn  btn-danger" id="markcomplete">Mark as completed <i class="lni lni-check"></i></button>';
              }
              if($wrkdet['status'] == 4){
                echo ' <button class="btn  btn-success">completed <i class="lni lni-check"></i></button>';
              }
              ?>
               
             </li>
              <?php }  ?>
            
            
              
              </ul>
              </div>
            <div class="dashboard-wrapper">
                   <!-- chat -->
                   <form class="row offers-messages">
<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" >
<div class="chat-message-box">
 <div class="dashboardboxtitle">
   <h2> Messages</h2>
</div>

  <div id="msgcont" style="overflow-y:auto;min-height: 250px;
    max-height: calc(100vh - 224px);">
    <!-- <div class="offerermessage">
        <div class="description">
            <div class="info">
            <h3>Meagan Miller</h3>
            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry</p>
            </div>
            <div class="date">June 21, 2018</div>
        </div>
    </div> -->
  </div>


</div>
<div class="replay-box">
<textarea class="form-control" id="reply" placeholder="Type Here & Press Enter"></textarea>
<input type="hidden" id="senderid" value="<?=$this->session->userdata('user_session')['surname']?>">
<input type="hidden" id="receiverid" value="<?=$wrkdet['surname']?>">
<input type="hidden" id="receiveruserid" value="<?=$wrkdet['userid']?>">
<input type="hidden" id="wrkid" value="<?=$this->uri->segment(2)?>">
<input type="hidden" id="adid" value="<?=$wrkdet['adid']?>">
<!-- <div class="icon-box">
<button class="btn-action btn-common" id="sendmsg">Send<i class="lni lni-angle-double-right"></i></button>
</div> -->
</div>
</div>
</form>
                   <!-- chat -->
            </div>
            </div>
          </div>
        </div>
      </div>

</div>
</div>
</div>