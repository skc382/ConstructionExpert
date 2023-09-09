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
											<h5 class="card-title mb-0"><?=$enqdet['title']?></h5>                      
                     
										</div>
										<div class="card-body">
                     <div class="avatar <?= ($enqdet['isonline'] == 1) ? 'avatar-online'  : 'avatar-offline' ?>">
											<img class="avatar-img rounded-circle" src="<?=$base_url?>/assets/img/author/thumb/<?=$enqdet['profileimg']?>">   
											</div>
											<?=ucfirst($enqdet['surname'])?>
											<p class="card-text"><i class="fe fe-mail"></i> <?=$enqdet['email']?></p>
											<p class="card-text"><i class="fe fe-phone"></i> <?=$enqdet['phone']?></p>
											<p class="card-text">Category : <?=$enqdet['category']?>.
                      <p class="card-text pull-right text-info">Budget :  Rs.<?=$enqdet['budget']?>.</p>                                        
                      <p class="card-text">Description : <?=html_entity_decode($enqdet['jobdesc'])?>.</p>
                      
										</div>
									</div>
								</div>			
					</div>
					
          <div class="row">
						<div class="col-sm-12">
							<div class="card">
								<div class="card-body">
                <p id="invmsg" class="text-center"></p>
									<div class="table-responsive">                    
                    <input type="hidden" value="<?=$this->uri->segment(2)?>" id="adid">
                    <!-- <button class="btn btn-primary pull-right" id="sendjobinvite">Invite</button> -->
										<table class="table table-hover table-center mb-0" id="industry_table" width="100%">
											<thead>
												<tr>
													<th>#</th>   
													<th>Date</th>                          
                          <th>Service Provider Details</th>
													<th>Admin Approval Status</th>
                          <th>Action</th>
													
												</tr>
											</thead>                    
										</table>
									</div>
								</div>
							</div>
						</div>			
					</div>
				</div>			
			</div>
			<!-- /Page Wrapper -->


<!-- Delete Modal -->
			<div class="modal fade" id="block_modal" aria-hidden="true" role="dialog">
				<div class="modal-dialog modal-dialog-centered" role="document" >
					<div class="modal-content">				
						<div class="modal-body text-center">
							<div class="form-content p-2">
								<!-- <h4 class="modal-title">Delete</h4> -->
								<p class="mb-4">Are you sure you want to block this approval?</p>
								<input type="hidden" id="cid">
								<button type="button" class="btn btn-primary" id="blkapctrl">Yes </button>
								<button type="button" class="btn btn-danger" data-dismiss="modal">No</button>
							</div>
						</div>
					</div>
				</div>
			</div>
<!-- /Delete Modal -->


			
			<!-- Delete Modal -->
			<div class="modal fade" id="approve_modal" aria-hidden="true" role="dialog">
				<div class="modal-dialog modal-dialog-centered" role="document" >
					<div class="modal-content">				
						<div class="modal-body text-center">
							<div class="form-content p-2">
								<!-- <h4 class="modal-title">Delete</h4> -->
								<p class="mb-4">Are you sure want to approve this user?</p>
								<input type="hidden" id="cid">
								<button type="button" class="btn btn-primary" id="apctrl">Yes </button>
								<button type="button" class="btn btn-danger" data-dismiss="modal">No</button>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- /Delete Modal -->



      			<!-- Delete Modal -->
			<div class="modal fade" id="view_modal" aria-hidden="true" role="dialog">
				<div class="modal-dialog  modal-dialog-centered" role="document" >
					<div class="modal-content">				
						<div class="modal-body">
							<div class="form-content p-2">
								<!-- <h4 class="modal-title">Delete</h4> -->
								<p class="mb-4"><b>Title </b><span id="title"></span></p>
                <p class="mb-4"><b>Category </b><span id="cat"></span></p>
                <p class="mb-4"><b>Description </b><span id="addesc"></span></p>
								<p class="mb-4"><b>Budget </b><span id="budget"></span></p>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- /Delete Modal -->