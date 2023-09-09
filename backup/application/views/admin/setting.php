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
                        <form id="updatesite">                        
                        <input type="hidden" name="<?php echo $csrf['name']; ?>" id="<?php echo $csrf['name']; ?>" value="<?php echo $csrf['hash']; ?>"> 
                        <div class="row">
                          <div class="col-md-6">
                            <div class="form-group">
                              <label>Website Name:</label>
                              <input type="text" class="form-control" placeholder="Enter website name" name="sitename" id="sitename" value="<?=$web[0]['sitename']?>">
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group">
                              <label>Contact Mail:</label>
                              <input type="text" class="form-control" placeholder="Enter website email" name="siteamil" id="siteamil" value="<?=$web[0]['sitemail']?>">
                            </div>
                          </div>
                        </div>  
                        <div class="row">
                          <div class="col-md-6">
                            <div class="form-group">
                              <label>Contact Phone:</label>
                              <input type="text" class="form-control" placeholder="Enter contact number" name="sitephone" id="sitephone" value="<?=$web[0]['sitephone']?>">
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group">
                              <label>Contact Address:</label>
                              <textarea class="form-control" placeholder="Enter address" name="siteaddr" id="siteaddr"><?=$web[0]['siteaddress']?></textarea>
                            </div>
                          </div>
                        </div> 
                        <div class="row">
                          <div class="col-md-6">
                            <div class="form-group">
                              <label>Facebook:</label>
                              <input type="text" class="form-control" placeholder="Enter facebook link" name="fb" id="fb" value="<?=$web[0]['fb']?>">
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group">
                              <label>Twitter:</label>
                              <input type="text" class="form-control" placeholder="Enter twitter link" name="tw" id="tw" value="<?=$web[0]['tw']?>">
                            </div>
                          </div>
                        </div>  
                        <div class="row">
                          <div class="col-md-6">
                            <div class="form-group">
                              <label>Logo:</label>
                              <input type="file"  class="form-control" name="file" id="file">
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group">
                              <label>Latest News:</label>
                              <textarea  class="form-control" placeholder="Enter message" name="todaytip" id="todaytip"><?=$web[0]['todaytip']?></textarea>
                            </div>
                          </div>
                        </div>                 
                        <div class="row">
                          <div class="col-md-12">
                            <div class="form-group">
                              <label>About:</label>
                              <textarea rows="5" cols="5" class="form-control summernote" placeholder="Enter message" name="about" id="about"><?=html_entity_decode($web[0]['about'])?></textarea>
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