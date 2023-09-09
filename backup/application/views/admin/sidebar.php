	<!-- Sidebar -->
  <div class="sidebar" id="sidebar">
                <div class="sidebar-inner slimscroll">
					<div id="sidebar-menu" class="sidebar-menu">
						<ul>
							<li class="menu-title"> 
								<span>Main</span>
							</li>
							<!-- <li class="<?php if($page == 'dashboard'){ echo 'active';}?>"> 
								<a href="<?=$base_url?>dashboard"><i class="fe fe-home"></i> <span>Dashboard</span></a>
							</li> -->
							<li class="<?php if($page == 'crinquiry'){ echo 'active';}?>"> 
								<a href="<?=$base_url?>customer-inquiries"><i class="fe fe-messanger"></i> <span>Customer Enquiries</span></a>
							</li>
							<li class="<?php if($page == 'srinquiry'){ echo 'active';}?>"> 
								<a href="<?=$base_url?>service-inquiries"><i class="fe fe-messanger"></i> <span>Service Enquiries</span></a>
							</li>
							<li class="<?php if($page == 'tags'){ echo 'active';}?>"> 
								<a href="<?=$base_url?>tags"><i class="fe fe-tag"></i> <span>Tags</span></a>
							</li>
							<li class="<?php if($page == 'category'){ echo 'active';}?>"> 
								<a href="<?=$base_url?>categories"><i class="fe fe-tag"></i> <span>Category</span></a>
							</li>
							<li class="<?php if($page == 'srs'){ echo 'active';}?>"> 
								<a href="<?=$base_url?>service-providers"><i class="fe fe-users"></i> <span>Service Providers</span></a>
							</li>
							<li class="<?php if($page == 'enquiries'){ echo 'active';}?>"> 
								<a href="<?=$base_url?>customer-enquiries"><i class="fe fe-messanger"></i> <span>Customer Job Post</span></a>
							</li>
							<li class="submenu">
								<a href="#" class="subdrop"><i class="fe fe-document"></i> <span> Manage Blog</span> <span class="menu-arrow"></span></a>
								<ul style="display: block;">	
									<li class="<?php if($page == 'createpost'){ echo 'active';}?>"><a href="<?=$base_url?>new-post"><i class="fe fe-plus"></i> <span>Create New Post</span></a></li>
									<li class="<?php if($page == 'viewpost'){ echo 'active';}?>"><a href="<?=$base_url?>view-post"><i class="fe fe-list-order"></i> <span>View Posts</span></a></li>		
					
								</ul>						
              </li>
							<li class="<?php if($page == 'feedback'){ echo 'active';}?>"> 
								<a href="<?=$base_url?>view-testimonial"><i class="fe fe-tag"></i> <span>Testimonials</span></a>
							</li>
							<li class="<?php if($page == 'setting'){ echo 'active';}?>"> 
								<a href="<?=$base_url?>site-setting"><i class="fe fe-globe"></i> <span>Settings</span></a>
							</li>
							<li class="<?php if($page == 'banner'){ echo 'active';}?>"> 
								<a href="<?=$base_url?>banner-image"><i class="fe fe-picture"></i> <span>Banner Image</span></a>
							</li>
						</ul>
					</div>
                </div>
            </div>
			<!-- /Sidebar -->