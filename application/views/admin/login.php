<!DOCTYPE html>
<html lang="en">
    
<head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
        <title><?=$web[0]['sitename']?> | <?=$title?></title>
		
		<!-- Favicon -->
        <link rel="shortcut icon" type="image/x-icon" href="<?=BASE_URL()?>backend/img/favicon.png">

		<!-- Bootstrap CSS -->
        <link rel="stylesheet" href="<?=BASE_URL()?>backend/css/bootstrap.min.css">
		
		<!-- Fontawesome CSS -->
        <link rel="stylesheet" href="<?=BASE_URL()?>backend/css/font-awesome.min.css">
		
		<!-- Main CSS -->
        <link rel="stylesheet" href="<?=BASE_URL()?>backend/css/style.css">
		
		<!--[if lt IE 9]>
			<script src="<?=BASE_URL()?>backend/js/html5shiv.min.js"></script>
			<script src="<?=BASE_URL()?>backend/js/respond.min.js"></script>
		<![endif]-->
    </head>
    <body>
	
		<!-- Main Wrapper -->
        <div class="main-wrapper login-body">
            <div class="login-wrapper">
            	<div class="container">
                	<div class="loginbox">
                    	<div class="login-left" >
											<img class="bg-white" src="<?=$base_url?>backend/img/web/<?=$web[0]['headerlogo']?>" alt="Logo">  
													
                        </div>
                        <div class="login-right">
							<div class="login-right-wrap">
								<h1><?=$title?>	</h1>
								<p class="account-subtitle" id="msg"></p>								
								<!-- Form -->
								<form id="loginform">
							   	<input type="hidden" name="<?php echo $csrf['name']; ?>" id="<?php echo $csrf['name']; ?>" value="<?php echo $csrf['hash']; ?>">
									<div class="form-group">
										<input class="form-control" type="text" name="username"  id="username" placeholder="Username" required>
									</div>
									<div class="form-group">
										<input class="form-control" type="password"  name="password"   name="password" placeholder="Password" required>
									</div>
									<div class="form-group">
										<button class="btn btn-primary btn-block" type="submit">Login</button>
									</div>
								</form>
								<!-- /Form -->
								
							</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
				<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" id="admin_csrf" />
        <input type="hidden" id="base_url" value="<?php echo $base_url; ?>">
		<!-- /Main Wrapper -->
		
		<!-- jQuery -->
        <script src="<?=BASE_URL()?>backend/js/jquery-3.2.1.min.js"></script>
		
		<!-- Bootstrap Core JS -->
        <script src="<?=BASE_URL()?>backend/js/popper.min.js"></script>
        <script src="<?=BASE_URL()?>backend/js/bootstrap.min.js"></script>
		<script>var baseurl = "<?=BASE_URL()?>";</script>
		<!-- Custom JS -->
		<script src="<?=BASE_URL()?>backend/js/script.js"></script>
		<script src="<?=BASE_URL()?>backend/js/admin.js"></script>
		
    </body>
</html>