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
if($this->session->userdata('user_session')['rolename'] == 'CR'){   
?>
<li>
<a href="<?=$base_url?>my-ads" class="active">
<i class="lni-layers"></i>
<span>My Ads</span>
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
              <h2 class="dashbord-title"><?=$title?></h2>
              </div>
            <div class="dashboard-wrapper">
           
              
              <table class="table table-responsive dashboardtable tablemyads">
              <thead>
              <tr>
              <th>S.No</th>
              <th>Date</th>
              <th>Service Provider Name</th>
              <th>Admin Approved</th>  
              <th>Online</th>            
              <th>Action</th>
              </tr>
              </thead>
              <tbody>

                        <?php 
                       // print_r($bids);
                        if(is_array($bids)){
                             $i=1;
                            foreach($bids as  $mys){

                        ?>
                        <tr data-category="active">
                          <td><?=$i;$i++;?></td>
                        <td data-title="Title">
                        <h3><?=date('d-m-Y g:i A',strtotime($mys['invitationdate']))?></h3>
                        </td>
                        <td data-title="Title">
                        <h3><?=$mys['surname']?></h3>
                        </td>  
                        <td data-title="Ad Status"><span class="adstatus <?=($mys['isadmin_approved'] == 1) ? "adstatusactive" : "adstatusinactive"?>"><?=($mys['isadmin_approved'] == 1) ? "Approved" : "Waiting for Approval"?></span></td>
                        <td data-title="Ad Status"><span class="adstatus <?=($mys['isonline'] == 1) ? "adstatusactive" : "adstatusinactive"?>"><?=($mys['isonline'] == 1) ? "Online" : "Offline"?></span></td>
                        <td data-title="Action">
                        <div class="btns-actions">
                        <?php if($mys['isadmin_approved'] == 1) {?>
                        <a class="btn-action btn-view" href="<?=$base_url?>chat-room/<?=$mys['chatid']?>" title="chat"><i class="lni-comments"></i></a>
                        <?php } ?>
                        </div>
                        </td>
                        </tr>
                        <?php 
                            }
                        } 
                        ?>
                </tbody>
              </table>

<?php echo $links; ?>
            </div>
            </div>
          </div>
        </div>
      </div>

</div>
</div>
</div>