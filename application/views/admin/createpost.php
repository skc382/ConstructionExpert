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
                        <form id="addpost" enctype="multipart/form-data">                        
                        <input type="hidden" name="<?php echo $csrf['name']; ?>" id="<?php echo $csrf['name']; ?>" value="<?php echo $csrf['hash']; ?>"> 
                        <div class="row">
                          <div class="col-md-12">
                            <div class="form-group">
                              <label>Blog Title:</label>
                              <input type="text" class="form-control" placeholder="Enter website name" name="title" id="title" >
                            </div>
                          </div>                         
                        </div> 
                   
                                       
                        <div class="row">
                          <div class="col-md-12">
                            <div class="form-group">
                              <label>About:</label>
                              <textarea rows="5" cols="5" class="form-control summernote" placeholder="Enter message" name="content" id="content"></textarea>
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