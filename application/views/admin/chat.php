	<!-- Page Wrapper -->
  <div class="page-wrapper">
                <div class="content container-fluid">
				
					<!-- Page Header -->
					<div class="page-header">
						<div class="row">
            <div class="col-sm-7 col-auto">
								<h3 class="page-title"><?=$title?></h3>
								<ul class="breadcrumb">
									<li class="breadcrumb-item"><a href="<?=$base_url?>dashboard">Dashboard</a></li>
									<li class="breadcrumb-item active"><?=$title?></li>
								</ul>
							</div>
						</div>
					</div>
					<!-- /Page Header -->


          <div class="row">
					   <div class="col-12 col-md-6 col-lg-12 d-flex">
									<div class="card flex-fill">
                     
										<div class="card-header">
											<h5 class="card-title mb-0"><?=$custjobdet['title']?></h5> 
										</div>
										<div class="card-body">
                      <div class="row">
                            <div class="col-6 col-md-6 col-lg-6">
                                                                                    
                                    <p class="card-text">Description : <?=html_entity_decode($custjobdet['jobdesc'])?>.</p>
                                    <p class="card-text text-info">Budget :  Rs.<?=$custjobdet['budget']?>.</p>
                            </div>
                            <div class="col-6 col-md-6 col-lg-6">
                                    <div class="avatar <?= ($custjobdet['isonline'] == 1) ? 'avatar-online'  : 'avatar-offline' ?>">
                                    <img class="avatar-img rounded-circle" src="<?=$base_url?>/assets/img/author/thumb/<?=$custjobdet['profileimg']?>">   
                                    </div>
                                    <p class="card-text">Customer Name : <?=$custjobdet['surname']?>.</p>
                                   <div class="avatar <?= ($srsdet['isonline'] == 1) ? 'avatar-online'  : 'avatar-offline' ?>">
                                    <img class="avatar-img rounded-circle" src="<?=$base_url?>/assets/img/author/thumb/<?=$srsdet['profileimg']?>">   
                                    </div>
                                    <p class="card-text">Service Provider Name : <?=$srsdet['surname']?>.</p>
                                    <p class="card-text">Ad Status :
                                    <?php
                                   
                                      if($custjobdet['status'] == 1){
                                        echo '<span class="badge badge-danger">Active</span>';
                                      }
                                      if($custjobdet['status'] == 2){
                                        echo '<span class="badge badge-warning">Inctive</span>';
                                      }
                                      if($custjobdet['status'] == 3){
                                        // echo '<span class="badge badge-primary">Awarded</span>';
                                      
                                          echo '<span class="badge badge-info">Awarded</span>';
                                        
                                      }
                                      if($custjobdet['status'] == 4  && $custjobdet['awarded_userid'] == $srsdet['userid']){
                                      
                                        echo '<span class="badge badge-success">Completed</span>';
                                      }
                                      if($custjobdet['status'] == 4  && $custjobdet['awarded_userid'] != $srsdet['userid']){
                                      
                                        echo '<span class="badge badge-success">Awarded to someone</span>';
                                      }
                                    ?>
                                    </p>
                            </div>
                      </div>

                      
										</div>
									</div>
								</div>			
					</div>
					
          <div class="row">
						<div class="col-sm-12">
							<div class="card">
                <div class="card-header">Chat Messages</div>
								<div class="card-body">
                <div id="msgcont" style="overflow-y:auto;min-height: 2%;
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
                <input type="hidden" id="senderid" value="<?=$this->session->userdata('admin_session')['username']?>">
<input type="hidden" id="receiverid" value="<?=$custjobdet['surname']?>">
<input type="hidden" id="wrkid" value="<?=$this->uri->segment(2)?>">
<textarea class="form-control" id="reply" placeholder="Type Here & Press Enter"></textarea>

								</div>
							</div>
						</div>			
					</div>
				</div>			
			</div>
			<!-- /Page Wrapper -->






