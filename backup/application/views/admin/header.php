<!DOCTYPE html>
<html lang="en">
<head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
        <title>Dashboard | <?=$web[0]['sitename']?> </title>		    
		<!-- Favicon -->
        <link rel="shortcut icon" type="image/x-icon" href="<?=$base_url?>backend/img/favicon.png">
		
		<!-- Bootstrap CSS -->
        <link rel="stylesheet" href="<?=$base_url?>backend/css/bootstrap.min.css">
		
		<!-- Fontawesome CSS -->
        <link rel="stylesheet" href="<?=$base_url?>backend/css/font-awesome.min.css">
		
		<!-- Feathericon CSS -->
        <link rel="stylesheet" href="<?=$base_url?>backend/css/feathericon.min.css">
			<!-- Select2 CSS -->
			<link rel="stylesheet" href="<?=$base_url?>backend/css/select2.min.css">
						<!-- bootstrap datetimepicker CSS -->
			<link rel="stylesheet" href="<?=$base_url?>asset/plugins/datepicker/css/bootstrap-datetimepicker.min.css">
        		<!-- Datatables CSS -->
		<link rel="stylesheet" href="<?=$base_url?>backend/plugins/datatables/datatables.min.css">
		
		<link rel="stylesheet" href="<?=$base_url?>backend/plugins/morris/morris.css">
		
		<!-- Main CSS -->
        <link rel="stylesheet" href="<?=$base_url?>backend/css/style.css">
				<link rel="stylesheet" href="<?=$base_url?>backend/css/summernote.min.css">
				<script type="text/javascript" src="<?=$base_url?>backend/js/moment-with-locales.min.js"></script>
		
		<!--[if lt IE 9]>
			<script src="<?=$base_url?>backend/js/html5shiv.min.js"></script>
			<script src="<?=$base_url?>backend/js/respond.min.js"></script>
		<![endif]-->
    </head>
    <body>
	
		<!-- Main Wrapper -->
        <div class="main-wrapper">
		
			<!-- Header -->
            <div class="header">
			
				<!-- Logo -->
                <div class="header-left">
                    <a href="<?=$base_url?>dashboard" class="logo">
						<img src="<?=$base_url?>backend/img/web/<?=$web[0]['sitelogo']?>" alt="Logo">            
					</a>
					<a href="<?=$base_url?>dashboard" class="logo logo-small">
						<img src="<?=$base_url?>backend/img/web/<?=$web[0]['sitelogo']?>" alt="Logo" width="30" height="30">
					</a>
                </div>
				<!-- /Logo -->
				
				<a href="javascript:void(0);" id="toggle_btn">
					<i class="fe fe-text-align-left"></i>
				</a>
				
		
				
				<!-- Mobile Menu Toggle -->
				<a class="mobile_btn" id="mobile_btn">
					<i class="fa fa-bars"></i>
				</a>
				<!-- /Mobile Menu Toggle -->
				
				<!-- Header Right Menu -->
				<ul class="nav user-menu">				
					
					<!-- User Menu -->
					<li class="nav-item dropdown has-arrow">
						<a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
							<!-- <span class="user-img"><img class="rounded-circle" src="<?=$base_url?>backend/img/profiles/avatar-01.jpg" width="31" alt="Ryan Taylor"></span> -->
						</a>
						<div class="dropdown-menu">
							<div class="user-header">
								<div class="avatar avatar-sm">
									<img src="<?=$base_url?>backend/img/web/thumb/<?=$web[0]['sitelogo']?>" alt="User Image" class="avatar-img rounded-circle">
								</div>
								<div class="user-text">
									<h6><?=$this->session->userdata('admin_session')['username']?></h6>
									<p class="text-muted mb-0">Administrator</p>
								</div>
							</div>
							<a class="dropdown-item" href="<?=$base_url?>admin-profile">My Profile</a>							
							<a class="dropdown-item" href="<?=$base_url?>logout-admin">Logout</a>
						</div>
					</li>
					<!-- /User Menu -->
					
				</ul>
				<!-- /Header Right Menu -->
				
            </div>
			<!-- /Header -->