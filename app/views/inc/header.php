<!DOCTYPE html>
<html>
<head>
	<!-- Basic Page Info -->
	<meta charset="utf-8">
	<title><?php echo SITENAME; ?></title>

	<!-- Site favicon -->
	<link rel="apple-touch-icon" sizes="180x180" href="<?php echo URLROOT; ?>/vendors/images/logo.png">
	<link rel="icon" type="image/png" sizes="32x32" href="<?php echo URLROOT; ?>/vendors/images/logo.png">
	<link rel="icon" type="image/png" sizes="16x16" href="<?php echo URLROOT; ?>/vendors/images/logo.png">

	<!-- Mobile Specific Metas -->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

	<!-- Google Font -->
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
	<!-- CSS -->
	<link rel="stylesheet" type="text/css" href="<?php echo URLROOT; ?>/vendors/styles/core.css">
	<link rel="stylesheet" type="text/css" href="<?php echo URLROOT; ?>/vendors/styles/icon-font.min.css">
	<link rel="stylesheet" type="text/css" href="<?php echo URLROOT; ?>/src/plugins/datatables/css/dataTables.bootstrap4.min.css">
	<link rel="stylesheet" type="text/css" href="<?php echo URLROOT; ?>/src/plugins/datatables/css/responsive.bootstrap4.min.css">
	<link rel="stylesheet" type="text/css" href="<?php echo URLROOT; ?>/vendors/styles/style.css">


	<!-- Global site tag (gtag.js) - Google Analytics -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=UA-119386393-1"></script>
	<script>
		window.dataLayer = window.dataLayer || [];
		function gtag(){dataLayer.push(arguments);}
		gtag('js', new Date());

		gtag('config', 'UA-119386393-1');
	</script>
</head>
<body>
	<!-- <div class="pre-loader">
		<div class="pre-loader-box">
			<div class="loader-logo"><img src="<?php //echo URLROOT; ?>/vendors/images/deskapp-logo.svg" alt=""></div>
			<div class='loader-progress' id="progress_div">
				<div class='bar' id='bar1'></div>
			</div>
			<div class='percent' id='percent1'>0%</div>
			<div class="loading-text">
				Loading...
			</div>
		</div>
	</div> -->

	<div class="header">
		<div class="header-left">
			<div class="menu-icon dw dw-menu"></div>
			<div class="search-toggle-icon dw dw-search2" data-toggle="header_search"></div>
			<div class="header-search">
				<form>
					<div class="form-group mb-0">
						<i class="dw dw-search search-icon"></i>
						<input type="text" class="form-control search-input" placeholder="Enter booking number here...">
					</div>
				</form>
			</div>
		</div>
		<div class="header-right">		
			<div class="user-info-dropdown">
				<div class="dropdown">
					<a class="dropdown-toggle" href="#" role="button" data-toggle="dropdown">
						<span class="user-icon">
							<?php if(isset($_SESSION['user_gender']) && $_SESSION['user_gender'] == 'male') : ?>
							<?php echo '<img src="' . URLROOT . '/vendors/images/male.png">'; ?>
							<?php else : ?>
							<?php echo '<img src="' . URLROOT . '/vendors/images/female.png">'; ?>
							<?php endif; ?>
						</span>
						<span class="user-name"><?php if(isset($_SESSION['user_name'])) echo $_SESSION['user_name']; ?></span>
					</a>
					<div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
						<a class="dropdown-item" href="#"><i class="dw dw-help"></i> Help</a>
						<a class="dropdown-item" href="<?php echo URLROOT; ?>/users/logout"><i class="dw dw-logout"></i> Log Out</a>
					</div>
				</div>
			</div>
		</div>
	</div>