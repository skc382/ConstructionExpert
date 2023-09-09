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
                      <div class="alert alert-info">
                      Add this variable to the below content <br>
                      Name of employer : <span class="badge badge-info">%employername%</span><br>
                      Name of applicant : <span class="badge badge-info">%applicant%</span><br>
                      Employer location : <span class="badge badge-info">%employerlocation%</span><br>
                      Reference no : <span class="badge badge-info">%refno%</span>
                      </div>
                    </div>
                    <div class="card-body">
                        <form id="updateletter">                        
                        <input type="hidden" name="<?php echo $csrf['name']; ?>" id="<?php echo $csrf['name']; ?>" value="<?php echo $csrf['hash']; ?>">                      
                        <div class="row">
                          <div class="col-md-12">
                            <div class="form-group">
                              <label>Attachment Letter:</label>
                              <textarea rows="5" cols="5" class="form-control summernote" placeholder="Enter message" name="attachletter" id="attachletter"><?=html_entity_decode($letter->attachment_letter)?></textarea>
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-12">
                            <div class="form-group">
                              <label>Internships Letter:</label>
                              <textarea rows="5" cols="5" class="form-control summernote" placeholder="Enter message" name="intrnletter" id="intrnletter"><?=html_entity_decode($letter->internships_letter)?></textarea>
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-12">
                            <div class="form-group">
                              <label>Teaching Practice Letter:</label>
                              <textarea rows="5" cols="5" class="form-control summernote" placeholder="Enter message" name="teachingletter" id="teachingletter"><?=html_entity_decode($letter->teaching_letter)?></textarea>
                            </div>
                          </div>
                        </div>
                        <div class="text-right">
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