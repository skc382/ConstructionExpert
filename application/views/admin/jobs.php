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
							<div class="col-sm-5 col">
								<a href="<?=$base_url?>add-job" class="btn btn-primary float-right mt-2">Add</a>
							</div>
						</div>
					</div>
					<!-- /Page Header -->
					
          <div class="row">
						<div class="col-sm-12">
							<div class="card">
								<div class="card-body">
									<div class="table-responsive">
										<table class="table table-hover table-center mb-0" id="industry_table" width="100%">
											<thead>
												<tr>
													<th>#</th>
													<th>Country</th>
                          <th>Industry</th>
                          <th>Position Title</th>
                          <th>Location</th>
                          <th>Positions <br> Available</th>
													<th>Status</th>
													<th class="text-right">Actions</th>
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

      		
			
			<!-- Edit Details Modal -->
			<div class="modal fade" id="edit_country" aria-hidden="true" role="dialog">
				<div class="modal-dialog modal-dialog-centered" role="document" >
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title">Edit Country</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body">
							<form id="editcountry">
							<input type="hidden" name="ecid" id="ecid">
							<input type="hidden" name="<?php echo $csrf['name']; ?>" id="<?php echo $csrf['name']; ?>" value="<?php echo $csrf['hash']; ?>">
								<div class="row form-row">
									<div class="col-12 col-sm-12">
										<div class="form-group">
											<label>Country</label>											
											<input type="text" class="form-control" name="ecountry" id="ecountry">
										</div>
									</div>									
								</div>
								<button type="submit" class="btn btn-primary btn-block">Save Changes</button>
							</form>
						</div>
					</div>
				</div>
			</div>
			<!-- /Edit Details Modal -->
			
			<!-- Delete Modal -->
			<div class="modal fade" id="delete_modal" aria-hidden="true" role="dialog">
				<div class="modal-dialog modal-dialog-centered" role="document" >
					<div class="modal-content">
					<!--	<div class="modal-header">
							<h5 class="modal-title">Delete</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>-->
						<div class="modal-body">
							<div class="form-content p-2">
								<h4 class="modal-title">Delete</h4>
								<p class="mb-4 ">Are you sure want to delete?</p>
								<input type="hidden" id="cid">
								<button type="button" class="btn btn-primary" id="deljob">Yes </button>
								<button type="button" class="btn btn-danger" data-dismiss="modal">No</button>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- /Delete Modal -->

						<!-- reject job Modal -->
			<div class="modal fade" id="reject_modal" aria-hidden="true" role="dialog">
				<div class="modal-dialog modal-dialog-centered" role="document" >
					<div class="modal-content">
						<div class="modal-body text-center">
							<div class="form-content p-2">
								<h4 class="modal-title">Reject</h4>
								<p class="mb-4">Do you want to reject this job?</p>
								<input type="hidden" id="cid">
								<button type="button" class="btn btn-primary" id="banjob">Yes </button>
								<button type="button" class="btn btn-danger" data-dismiss="modal">No</button>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- /reject job Modal -->


									<!-- approve job Modal -->
		 <div class="modal fade" id="approve_modal" aria-hidden="true" role="dialog">
				<div class="modal-dialog modal-dialog-centered" role="document" >
					<div class="modal-content">
						<div class="modal-body text-center">
							<div class="form-content p-2">
								<h4 class="modal-title">Approve</h4>
								<p class="mb-4">Do you want to approve this job?</p>
								<input type="hidden" id="cid">
								<button type="button" class="btn btn-primary" id="approvejob">Yes </button>
								<button type="button" class="btn btn-danger" data-dismiss="modal">No</button>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- /approve job Modal -->