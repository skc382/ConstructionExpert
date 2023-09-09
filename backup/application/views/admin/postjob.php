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
                      <h4 class="card-title"><?=$title?></h4>
                    </div>
                    <div class="card-body">
                        <form id="addJob">
                        <input type="hidden" name="action" id="action" value="add">
                        <input type="hidden" name="<?php echo $csrf['name']; ?>" id="<?php echo $csrf['name']; ?>" value="<?php echo $csrf['hash']; ?>">
                        <div class="row">
                          <div class="col-md-6">
                            <h4 class="card-title">Job details</h4>
                                 <div class="form-group">
                                      <label>Industries *:</label>
                                      <select class="select" name="indid" id="indid" required>
                                          <option value="">select</option>
                                          <?php
                                              if(is_array($industries)){
                                                foreach($industries as $c){
                                                  echo '<option value='.$c['industryid'].'>'.ucfirst($c['industryname']).'</option>';
                                                }
                                              }
                                          ?>
                                      </select>
                                  </div>
                            <div class="row">
                                <div class="col-md-6">                                  
                                  <div class="form-group">
                                    <label>Date *:</label>
                                    <input type="text" class="form-control datepicker"  name="jobdate" id="jobdate" required>
                                  </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Job Type *:</label>
                                        <select class="select" name="jobtype" id="jobtype" required>
                                          <option value="">Select</option>
                                          <option value="A">Attachment</option>
                                          <option value="T">Teaching-Practice</option>
                                          <option value="I">Internships</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                              <label>Name of Organization/Company *:</label>
                              <input type="text" class="form-control" name="cname" id="cname" required>
                            </div>
                            <div class="form-group">
                              <label>Position Title *:</label>
                              <input type="text" class="form-control" name="title" id="title" required>
                            </div>
                            <div class="form-group">
                              <label>No. of Positions Available *:</label>
                              <input type="number" class="form-control" name="nopost" id="nopost" required>
                            </div>											
                          </div>
                          <div class="col-md-6">
                            <h4 class="card-title">Job location details</h4>
                            <div class="row">
                              <div class="col-md-6">
                                <div class="form-group">
                                  <label>County *:</label>
                                  <select class="select" name="county" id="county" required>
                                  <option value="">select</option>
                                  <?php
                                      if(is_array($counties)){
                                        foreach($counties as $c){
                                          echo '<option value='.$c['cid'].'>'.ucfirst($c['country']).'</option>';
                                        }
                                      }
                                  ?>
                                  </select>
                                </div>
                              </div>
                              <div class="col-md-6">
                                <div class="form-group">
                                  <label>Town *:</label>
                                  <input type="text" class="form-control" name="town" id="town" required>
                                </div>
                              </div>
                            </div>
                            <div class="row">
                              <div class="col-md-6">
                                <div class="form-group">
                                  <label>Street Road:</label>
                                  <input type="text" class="form-control" name="street" id="street" >
                                </div>
                              </div>
                              <div class="col-md-6">
                                <div class="form-group">
                                  <label>Building *:</label>
                                  <input type="text" class="form-control" name="building" id="building" required>
                                </div>
                              </div>
                            </div>
                            <div class="row">
                              <div class="col-md-6">
                                <div class="form-group">
                                  <label>Floor:</label>
                                  <input type="text" class="form-control" name="floor" id="floor" >
                                </div>
                              </div>
                              <div class="col-md-6">
                                <div class="form-group">
                                  <label>Door No:</label>
                                  <input type="text" class="form-control" name="doorno" id="doorno" >
                                </div>
                              </div>
                            </div>																			
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-12">
                          <div class="form-group">
                              <label>Job Description:</label>
                              <textarea rows="5" cols="5" class="form-control summernote" placeholder="Enter message" name="jobdesc" id="jobdesc"></textarea>
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