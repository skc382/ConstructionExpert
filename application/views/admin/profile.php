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
                        <form id="updateprofile">                        
                        <input type="hidden" name="<?php echo $csrf['name']; ?>" id="<?php echo $csrf['name']; ?>" value="<?php echo $csrf['hash']; ?>"> 
                        <div class="row">
                          <div class="col-md-6">
                            <div class="form-group"> 
                              <label>Surname:</label>
                              <input type="hidden"  name="userid" id="userid" value="<?=$pro->userid?>">
                              <input type="text" class="form-control" placeholder="Enter website name" name="surname" id="surname" value="<?=$pro->surname?>">
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group">
                              <label>Username:</label>
                              <input type="text" class="form-control" placeholder="Enter website email" name="username" id="username" value="<?=$pro->username?>">
                            </div>
                          </div>
                        </div>  
                        <div class="row">
                          <div class="col-md-6">
                            <div class="form-group">
                              <label>Phone:</label>
                              <input type="text" class="form-control" placeholder="Enter contact number" name="phone" id="phone" value="<?=$pro->phone?>">
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group">
                              <label>Email:</label>
                              <input type="email" class="form-control" placeholder="Enter contact number" name="email" id="email" value="<?=$pro->email?>">
                            </div>
                          </div>
                        </div> 
                        <div class="row">
                          <div class="col-md-6">
                            <div class="form-group">
                              <label>Password:</label>
                              <input type="text" class="form-control"  name="pass" id="pass">
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
      