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
						<div class="col-sm-12">
							<div class="card">
								<div class="card-body">
                <p id="invmsg" class="text-center"></p>
									<div class="table-responsive">                    
                    <input type="hidden" value="<?=$this->uri->segment(2)?>" id="blogid">                 
										<table class="table table-hover table-center mb-0" id="industry_table" width="100%">
											<thead>
												<tr>
													<th>#</th>                           
                          <th>Name & Email</th>
                          <th>Message</th>
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
								<p class="mb-4">Are you sure you want to block this comment?</p>
								<input type="hidden" id="cid">
								<button type="button" class="btn btn-primary" id="blkcmt">Yes </button>
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
								<p class="mb-4">Are you sure want to approve this comment?</p>
								<input type="hidden" id="cid">
								<button type="button" class="btn btn-primary" id="apcmt">Yes </button>
								<button type="button" class="btn btn-danger" data-dismiss="modal">No</button>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- /Delete Modal -->


      			<!-- Delete Modal -->
			<div class="modal fade" id="delete_modal" aria-hidden="true" role="dialog">
				<div class="modal-dialog modal-dialog-centered" role="document" >
					<div class="modal-content">				
						<div class="modal-body text-center">
							<div class="form-content p-2">
								<!-- <h4 class="modal-title">Delete</h4> -->
								<p class="mb-4">Are you sure want to delete this comment?</p>
								<input type="hidden" id="cid">
								<button type="button" class="btn btn-primary" id="delcmt">Yes </button>
								<button type="button" class="btn btn-danger" data-dismiss="modal">No</button>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- /Delete Modal -->


