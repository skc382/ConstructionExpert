	<!-- Page Wrapper -->
  <div class="page-wrapper">
                <div class="content container-fluid">
				
					<!-- Page Header -->
					<div class="page-header">
						<div class="row">
							<div class="col-sm-12">
								<h3 class="page-title"></h3>
								<ul class="breadcrumb">
									<li class="breadcrumb-item"><a href="<?=$base_url?>jobs">Jobs</a></li>
									<li class="breadcrumb-item active"><?=$title?></li>
								</ul>
							</div>
						</div>
					</div>
					<!-- /Page Header -->
					
					<div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                      <h4 class="card-title"><?=$title?></h4><br>
                    </div>
                    <div class="card-body">
                        <form id="updatebanner">                        
                        <input type="hidden" name="<?php echo $csrf['name']; ?>" id="<?php echo $csrf['name']; ?>" value="<?php echo $csrf['hash']; ?>"> 
                       
                        <div class="row">
                          <div class="col-md-6">
                            <div class="form-group">
                              <label>Upload Banner Image:</label>
                              <input type="file"  class="form-control" name="file" id="file" required>
                              <span class="text-muted">Image dimension should be 1600*1067</span>
                            </div>
                          </div>
                        </div>                 
                     
                      

                        <div class="text-left">
                          <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                      </form>
                    </div>
                </div>
						</div>			
					</div>
					
				</div>			
			</div>
			<!-- /Page Wrapper -->