<?
include("../assets/php/jobs.php");
include('session.php');
global $results_edit;
if(isset($_POST['delete'])){
	if(!empty($_POST['lang'])) {
		$dbObject = new Database();
		$db=$dbObject->getConnection();
		if (!$db){
			alert('Database didnt connect');
		}
		else {
			foreach($_POST['lang'] as $value){
				$results_delete = $db->query("DELETE from jobs where id = $value") or onError($db, "Job not present in Database");
			}
			show();
		}

	}
}
elseif (isset($_POST['add'])){
	add_edit('add');

}
elseif (isset($_POST['edit'])){
	$value = explode(",", $_POST['edit']);
	$dbObject = new Database();
	$db=$dbObject->getConnection();
	if (!$db){
		alert('Database didnt connect');
	}
	else if ($value[1] == 'Active'){
		$results_edit = $db->query("SELECT * from jobs where id = $value[0] and status = '$value[1]' order by status") or onError($db, "Job not present in Database");
		if ($results_edit){
			add_edit('edit',$results_edit, $value);
		}
	}
	else{
		echo '<script>alert("Please Activate the Job!!!")</script>';
		show();
	}
}
elseif(isset($_POST['addtodb'])){
	$user = $_POST['posted_by'];
	$id = $_POST['id'];
	$date_posted = date('Y/m/d H:i:s', time());
	$title = $_POST['title'];
	$title = str_replace("'","''",$title);
	$location = $_POST['location'];
	$location = str_replace("'","''",$location);
	$username = $_POST['username'];
	$jobtype = $_POST['jobtype'];
	$jobtype = str_replace("'","''",$jobtype);
	$status = $_POST['status_radio'];
	$status = str_replace("'","''",$status);
	$jd = $_POST['jd'];
	$jd = str_replace("'","''",$jd);

	$responsibility = $_POST['responsibility'];
	$responsibility = str_replace("'","''",$responsibility);
	$qualification = $_POST['qualification'];
	$qualification = str_replace("'","''",$qualification);
	$dbObject = new Database();
	$db=$dbObject->getConnection();
	if (!$db){
		error_log('Database didnt connect');
	}
	else {
		$results_check = $db -> query("SELECT * from jobs where id = $id order by status");
		if ($results_check->num_rows > 0) {
			$results_update = $db -> query("UPDATE jobs set title ='$title', location = '$location', responsibility = '$responsibility', qualification = '$qualification', job_type = '$jobtype', job_description = '$jd', date_posted = '$date_posted', posted_by = '$user', status = '$status' where id = $id");
		} else {
			$results_insert = $db->query("INSERT INTO jobs (title, location,job_type,job_description, responsibility, qualification, posted_by, status) VALUES ('$title', '$location','$jobtype','$jd', '$responsibility', '$qualification', '$user', '$status')") or onError($db, "Getting records from job Detail is Aborted");
		}
	}
	if(!empty($_POST['distro'])) {
		$to = "";
		foreach($_POST['distro'] as $value){
			$to = $to.', '. $value;
		}
		$subject = 'Job Posting for ' . $_POST['title'] .' on '.$date_posted ;
		$email = "resumes@evolversgroup.com";
		$headers = 'From: ' . $email . "\r\n" . 'Reply-To: ' . $email;

		$title = preg_replace('/\s+/', ' ', $_POST['title']);
		$location = preg_replace('/\s+/', ' ', $_POST['location']);
		$jobtype = preg_replace('/\s+/', ' ', $_POST['jobtype']);
		$jd = preg_replace('/\s+/', ' ', $_POST['jd']);
		$responsibility = preg_replace('/\s+/', ' ', $_POST['responsibility']);
		$qualification = preg_replace('/\s+/', ' ', $_POST['qualification']);



		$title = preg_replace('/[^A-Za-z0-9.,;()[]-\']/', '', $title);
		$location = preg_replace('/[^A-Za-z0-9.,\'\;()[]-\']/', '', $location);
		$jobtype = preg_replace('/[^A-Za-z0-9.,\'\;()[]-\']/', '', $jobtype);
		$jd = preg_replace('/[^A-Za-z0-9.,\'\;()[]-\']/', '', $jd);
		$responsibility = preg_replace('/[^A-Za-z0-9.,\'\;()[]-\']/', '', $responsibility);
		$qualification = preg_replace('/[^A-Za-z0-9.,\'\;()[]-\']/', '', $qualification);




		$message = 'Job Title: ' . $title . "\n\n" .
		'Location: '. $location . "\n\n" .
		'Job Type: '. $jobtype . "\n\n" .
		'Job Description: ' . "\n" . $jd . "\n\n" .
		'Responsibilities: ' . "\n" . $responsibility . "\n\n" .
		'Qualifications: ' . "\n" . $qualification . "\n\n" .
		'Date Posted: '. $date_posted;

		mail($to, $subject, $message, $headers);
	}
	show();
}
elseif(isset($_POST['preview'])){
	$user = $_POST['posted_by'];
	$id = $_POST['id'];
	$date_posted = date('Y/m/d H:i:s', time());
	$title = $_POST['title'];
	$title = str_replace("'","''",$title);
	$location = $_POST['location'];
	$location = str_replace("'","''",$location);
	$username = $_POST['username'];
	$jobtype = $_POST['jobtype'];
	$jobtype = str_replace("'","''",$jobtype);
	$status = $_POST['status_radio'];
	$status = str_replace("'","''",$status);
	$jd = $_POST['jd'];
	$jd = str_replace("'","''",$jd);

	$responsibility = $_POST['responsibility'];
	$responsibility = str_replace("'","''",$responsibility);
	$qualification = $_POST['qualification'];
	$qualification = str_replace("'","''",$qualification);

	$qualification = $_POST['qualification'];
	$qualification = str_replace("'","''",$qualification);

	$array = array($title,$location, $jobtype, $jd, $responsibility, $qualification,$status,$user);
	preview($array);
}
elseif(isset($_POST['activate'])){
	$value = explode(",", $_POST['activate']);
	if ($value[1] == 'Active'){
		$set = 'Inactive';
	}
	else{
		$set = 'Active';
	}
	$dbObject = new Database();
	$db=$dbObject->getConnection();
	if (!$db){
		alert('Database didnt connect');
	}
	else {
		$results_activate = $db->query("UPDATE jobs set status = '$set' where id = $value[0]") or onError($db, "Job not present in Database");
	}
	show();
}
else{
	show();
}
function show()
{
	$dbObject = new Database();
	$db=$dbObject->getConnection();
	if (!$db){
		error_log('db didnt connect');
	}
	else {
		$results_show = $db->query("SELECT * FROM jobs order by status, date_posted DESC ") or onError($db, "Getting records from job Detail is Aborted");
	}
	?>
	<html>
	<head>

		<!-- Title -->
		<title>Evolvers Group</title>
		<!-- Required Meta Tags Always Come First -->
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta http-equiv="x-ua-compatible" content="ie=edge">
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<!-- Favicon -->
		<link rel="shortcut icon" href="../assets/img/favicon.png">

		<!-- Google Fonts -->
		<!-- <link rel="stylesheet" href="//fonts.googleapis.com/css?family=Roboto:300,400,500,700"> -->

		<!-- CSS Global Compulsory -->
		<link rel="stylesheet" href="../assets/vendor/bootstrap/bootstrap.min.css">
		<link rel="stylesheet" href="../assets/vendor/icon-awesome/css/font-awesome.min.css">
		<link rel="stylesheet" href="../assets/vendor/icon-line-pro/style.css">

		<!-- CSS Implementing Plugins -->
		<!-- <link rel="stylesheet" href="../assets/vendor/icon-awesome/css/font-awesome.min.css"> -->
		<link rel="stylesheet" href="../assets/vendor/icon-hs/style.css">
		<link rel="stylesheet" href="../assets/vendor/hamburgers/hamburgers.min.css">
		<link rel="stylesheet" href="../assets/vendor/dzsparallaxer/dzsparallaxer.css">
		<link rel="stylesheet" href="../assets/vendor/slick-carousel/slick/slick.css">
		<link rel="stylesheet" href="../assets/vendor/cubeportfolio-full/cubeportfolio/css/cubeportfolio.min.css">
		<link  rel="stylesheet" href="../assets/vendor/animate.css">
		<link  rel="stylesheet" href="../assets/vendor/custombox/custombox.min.css">
		<link rel="stylesheet" href="../assets/vendor/hs-megamenu/src/hs.megamenu.css">

		<!-- <link rel="stylesheet" href="../assets/vendor/fancybox/jquery.fancybox.css"> -->

		<link rel="stylesheet" href="../assets/css/unify-core.css">
		<link rel="stylesheet" href="../assets/css/unify-components.css">
		<link rel="stylesheet" href="../assets/css/unify-globals.css">

		<!-- CSS Template -->
		<link rel="stylesheet" href="../assets/css/styles.op-corporate.css">

		<!-- CSS Customization -->
		<link rel="stylesheet" href="../assets/css/custom.css">
	</head>

	<body id="home-section">
		<main>
			<!-- Header -->
			<header id="js-header" class="u-header u-header--static--lg u-header--show-hide--lg u-header--change-appearance--lg" data-header-fix-moment="0" data-header-fix-effect="slide">
				<div class="u-header__section u-header__section--light g-bg-white g-transition-0_3 g-py-10 g-py-0--lg" data-header-fix-moment-classes="u-shadow-v18">
					<nav class="js-mega-menu navbar navbar-expand-lg py-0">
						<div class="container">
							<!-- Responsive Toggle Button -->
							<button class="navbar-toggler navbar-toggler-right btn g-line-height-1 g-brd-none g-pa-0 g-pos-abs g-top-3 g-right-0" type="button" aria-label="Toggle navigation" aria-expanded="false" aria-controls="navBar" data-toggle="collapse" data-target="#navBar">
								<span class="hamburger hamburger--slider">
									<span class="hamburger-box">
										<span class="hamburger-inner"></span>
									</span>
								</span>
							</button>
							<!-- End Responsive Toggle Button -->
							<!-- Logo -->
							<a href="../index.html" class="navbar-brand">
								<img src="../assets/img/evolvers_logo.png" alt="evolvers_logo">
							</a>
							<!-- End Logo -->

							<!-- Navigation -->
							<div class="collapse navbar-collapse align-items-center flex-sm-row g-pt-10 g-pt-5--lg" id="navBar">
								<ul class="navbar-nav ml-auto text-uppercase g-pt-40 g-pb-40 u-sub-menu-v3">
									<li class="nav-item g-mx-15--lg g-mb-7 g-mb-0--lg">
										<a href="../index.html" class="nav-link p-0">Home

										</a>
									</li>
									<li class="nav-item g-mx-15--lg g-mb-7 g-mb-0--lg">
										<a href="../about.html" class="nav-link p-0">About

										</a>
									</li>

									<li class="nav-item hs-has-sub-menu g-mx-2--md g-mx-5--xl g-mb-5 g-mb-0--lg g-mx-15--lg g-mb-7 g-mb-0--lg">
										<a href="../services.html" class="nav-link p-0" id="nav-link-1" aria-haspopup="true" aria-expanded="false" aria-controls="nav-submenu-1">Services

										</a>
										<!-- Submenu -->
										<ul class="hs-sub-menu list-unstyled" id="nav-submenu-1" aria-labelledby="nav-link-1">
											<li class="hs-has-sub-menu">
												<a href="services.html#audit" id="nav-link-2" aria-haspopup="true" aria-expanded="false" aria-controls="nav-submenu-2">Strategy and Architecture</a>
												<ul class="hs-sub-menu" id="nav-submenu-2" aria-labelledby="nav-link-2">
													<li class="dropdown-item">
														<a href="../services.html#audit">Assessments and Audit</a>
													</li>
													<li class="dropdown-item">
														<a href="../services.html#recommendations">Recommendations</a>
													</li>
													<li class="dropdown-item">
														<a href="../services.html#process-improvements">Process Improvements</a>
													</li>
													<li class="dropdown-item">
														<a href="../services.html#technology-roadmaps">Roadmaps and Blueprints</a>
													</li>
													<li class="dropdown-item">
														<a href="../services.html#solution-architecture">Solution Architecture</a>
													</li>
												</ul>
											</li>
											<li class="hs-has-sub-menu">
												<a href="services.html#business-analytics" id="nav-link-3" aria-haspopup="true" aria-expanded="false" aria-controls="nav-submenu-3">Data Science
												</a>
												<!-- Submenu (level 2) -->
												<ul class="hs-sub-menu list-unstyled" id="nav-submenu-3" aria-labelledby="nav-link-3">
													<li class="dropdown-item">
														<a href="../services.html#business-analytics">Business Analytics</a>
													</li>
													<li class="dropdown-item">
														<a href="../services.html#data-science">Data Science</a>
													</li>
													<li class="dropdown-item">
														<a href="../services.html#data-visualization">Data Visualization</a>
													</li>
													<li class="dropdown-item">
														<a href="../services.html#data-warehousing">Data Warehousing</a>
													</li>
												</ul>
												<!-- End Submenu (level 2) -->
											</li>
											<li class="hs-has-sub-menu">
												<a href="services.html#pmo" id="nav-link-4" aria-haspopup="true" aria-expanded="false" aria-controls="nav-submenu-4">Project Management</a>
												<!-- Submenu (level 2) -->
												<ul class="hs-sub-menu list-unstyled" id="nav-submenu-4" aria-labelledby="nav-link-4">
													<li class="dropdown-item">
														<a href="../services.html#pmo">PMO</a>
													</li>
													<li class="dropdown-item">
														<a href="../services.html#agile-transformation">Agile Transformation</a>
													</li>
												</ul>
												<!-- End Submenu (level 2) -->
											</li>
											<li class="hs-has-sub-menu">
												<a href="services.html#erp" id="nav-link-5" aria-haspopup="true" aria-expanded="false" aria-controls="nav-submenu-5">Solutions</a>
												<!-- Submenu (level 2) -->
												<ul class="hs-sub-menu list-unstyled" id="nav-submenu-5" aria-labelledby="nav-link-5">
													<li class="dropdown-item">
														<a href="../services.html#erp">ERP</a>
													</li>
													<li class="dropdown-item">
														<a href="../services.html#gis">GIS</a>
													</li>
												</ul>
												<!-- End Submenu (level 2) -->
											</li>
											<li class="hs-has-sub-menu">
												<a href="services.html#healthcare-it" id="nav-link-6" aria-haspopup="true" aria-expanded="false" aria-controls="nav-submenu-6">Healthcare</a>
												<!-- Submenu (level 2) -->
												<ul class="hs-sub-menu list-unstyled" id="nav-submenu-6" aria-labelledby="nav-link-6">
													<li class="dropdown-item">
														<a href="../services.html#healthcare-it">Healthcare IT</a>
													</li>
													<li class="dropdown-item">
														<a href="https://evolvershealthcare.com/">Healthcare Services</a>
													</li>
												</ul>
												<!-- End Submenu (level 2) -->
											</li>
										</ul>
										<!-- End Submenu -->
									</li>
									<li class="nav-item g-mx-15--lg g-mb-7 g-mb-0--lg">
										<a href="../practices.html" class="nav-link p-0 ">Practices

										</a>
									</li>
									<li class="nav-item g-mx-15--lg g-mb-7 g-mb-0--lg">
										<a href="../contracts.html" class="nav-link p-0">Contracts

										</a>
									</li>
									<li class="nav-item g-mx-15--lg g-mb-7 g-mb-0--lg">
										<a href="../careers.php" class="nav-link p-0 ">Jobs

										</a>
									</li>
									<li class="nav-item g-mx-15--lg g-mb-7 g-mb-0--lg">
										<a href="http://webmail.evolversgroup.com/" class="nav-link p-0 ">Login

										</a>
									</li>
								</ul>
							</div>
							<!-- End Navigation -->
						</div>
					</nav>
				</div>
			</header>
			<!-- End Header -->


			<!-- Promo Block -->
			<div class="dzsparallaxer auto-init height-is-based-on-content use-loading mode-scroll loaded dzsprx-readyall g-min-height-50vh g-bg-cover g-bg-black-opacity-0_2--after" data-options='{direction: "reverse", settings_mode_oneelement_max_offset: "150"}'>
				<div class="divimage dzsparallaxer--target w-100" style="height: 115%; background-image: url(../assets/img/1.jpg);"></div>

				<div class="g-absolute-centered--y g-bg-cover__inner w-100">
					<div class="container g-pos-rel g-z-index-1 g-mt-50--md">
						<div class="row align-items-center">
							<div class="col-sm-6 col-lg-12">
								<h1 class="g-color-white g-font-weight-300 g-font-size-45 g-mb-30 g-mb-50--sm">Jobs</h1>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- End Promo Block -->

			<section class="g-bg-gray-light-v5 g-py-50">
				<div class="container g-pb-40">
					<form action="" method="post">

						<div class="d-sm-flex text-center g-mb-30 g-mb-50--sm">

							<div class="align-self-center ml-auto">
								<ul class="u-list-inline">
									<li class="list-inline-item g-mr-5">
										<input class="u-link-v5 g-color-main g-color-primary--hover" type="submit" name="add" value="Add" />
										<input class="u-link-v5 g-color-main g-color-primary--hover" type="submit" value="Delete" name="delete" />
									</li>
								</ul>
							</div>
						</div>
						<div class="row justify-content-between">
							<!-- Hoverable Rows -->
							<div class="table-responsive">
								<table class="table table-hover">
									<thead>
										<tr>
											<th></th>
											<th>#</th>
											<th>Date</th>
											<th class="hidden-sm">Available Jobs</th>
											<th>Location</th>
											<th>Posted By</th>
											<th></th>
										</tr>
									</thead>
									<tbody id = "tbody">
										<?php
										$flg = 0;

										while ($line = $results_show->fetch_assoc()){
											$flg = $flg + 1;
											echo '<tr><td><input type="checkbox" value="';
											echo $line["id"];
											echo '" name="lang[]" /><button type="submit" name="edit" class="btn" value="';
											echo $line["id"].','.$line["status"];
											echo '"><i class="fa fa-pencil"></i></button></td><td>';
											echo $flg;
											echo '</td> <td>';
											echo date('m-d-Y', strtotime($line["date_posted"]));
											if ($line["status"] == 'Active'){
												echo '</td> <td><a href="https://evolversgroup.com/jobs-description.php?id=';
												echo $line["id"];
												echo '">';
												echo $line["title"];
												echo '</td> <td>';
											}
											else{
												echo '</td> <td>';
												echo $line["title"];
												echo '</td> <td>';
											}
											echo $line["location"];
											echo '</td><td>';
											echo $line["posted_by"];
											echo '</td>';
											echo '<td><button type="submit" name="activate" class="btn" value="';
											echo $line["id"].','.$line["status"];
											echo '">';
											echo $line["status"];
											echo '</button></td></tr>';
										}
										?>
									</tbody>
								</table>
							</div>
							<!-- End Hoverable Rows -->
						</div>
					</form>
				</div>
			</section>


			<!-- Footer -->
			<footer id="contact-section" class="container" style="font-size:1rem">
				<div class="row g-pt-80">
					<div class="col-sm-6 col-lg g-mb-50">
						<h3 class="text-uppercase g-font-weight-500 g-font-size-13 mb-3">About</h3>

						<!-- Links -->
						<ul class="list-unstyled">
							<li class="g-py-6"><a class="u-link-v5 g-color-text" href="http://evolversgroup.com/about.html">About</a></li>
						</ul>
						<!-- End Links -->
					</div>

					<div class="col-sm-6 col-lg g-mb-50">
						<h3 class="text-uppercase g-font-weight-500 g-font-size-13 mb-3">Useful Links</h3>
						<!-- Links -->
						<ul class="list-unstyled">
							<li class="g-py-6"><a class="u-link-v5 g-color-text" href="http://evolversgroup.com/crm/index.php?action=Login&module=Users">CRM</a></li>
							<li class="g-py-6"><a class="u-link-v5 g-color-text" href="http://webmail.evolversgroup.com/">Email</a></li>

						</ul>
						<!-- End Links -->
					</div>

					<div class="col-sm-6 col-lg g-mb-50">
						<h3 class="text-uppercase g-font-weight-500 g-font-size-13 mb-3">Career</h3>

						<!-- Links -->
						<ul class="list-unstyled">
							<li class="g-py-6"><a class="u-link-v5 g-color-text" href="http://evolversgroup.com/careers.php">Jobs</a></li>
						</ul>
						<!-- End Links -->
					</div>

					<div class="col-sm-6 col-lg g-mb-50">
						<h3 class="text-uppercase g-font-weight-500 g-font-size-13 mb-3"><a href="../contact_us.html" style="color:#12222d;">Contact Us</a></h3>

						<address class="g-bg-no-repeat g-font-size-12 mb-0">
							<!-- Location -->
							<div class="d-flex g-mb-20">
								<div class="g-mr-10">
									<span class="u-icon-v3 u-icon-size--xs g-color-text">
										<i class="fa fa-map-marker"></i>
									</span>
								</div>
								<p class="mb-0">HQ: Flower Mound (TX)
									<br>AZ: Tempe
									<br>CA: Fremont
									<br>DC Area: Arlington (VA)
									<br>NC: Charlotte
									<br>NJ: Jersey City
									<br>TX: Austin, Fort Worth</p>
								</div>
								<!-- End Location -->

								<!-- Phone -->
								<div class="d-flex g-mb-20">
									<div class="g-mr-10">
										<span class="u-icon-v3 u-icon-size--xs g-color-text">
											<i class="fa fa-phone"></i>
										</span>
									</div>
									<p class="mb-0">(214) 224-0866</p>
								</div>
								<!-- End Phone -->

								<!-- Email and Website -->
								<div class="d-flex g-mb-20">
									<div class="g-mr-10">
										<span class="u-icon-v3 u-icon-size--xs g-bg-black-opacity-0_1 g-color-black-opacity-0_6">
											<i class="fa fa-globe"></i>
										</span>
									</div>
									<p class="mb-0">
										<a class="u-link-v5 g-color-text">info at evolversgroup.com</a>
										<br>
										<a class="u-link-v5 g-color-text" href="https://www.evolversgroup.com">www.evolversgroup.com</a>
									</p>
								</div>
								<!-- End Email and Website -->
							</address>

						</div>
						<div class="col-sm-6 col-lg g-mb-50">
							<h3 class="text-uppercase g-font-weight-500 g-font-size-13 mb-3">Stay in Touch</h3>

							<!-- Social Icons -->
							<ul class="list-inline mb-0">
								<li class="list-inline-item g-mx-2">
									<a class="u-icon-v3 g-width-35 g-height-35 g-color-main g-bg-secondary g-color-white--hover g-bg-primary--hover g-font-size-13 rounded-circle" href="https://twitter.com/evolversgroup">
										<i class="fa fa-twitter"></i>
									</a>
								</li>
							</ul>
							<!-- End Social Icons -->
						</div>
					</div>

					<hr class="g-brd-secondary-light-v1 my-0">

					<!-- Copyright -->
					<div class="row align-items-center g-py-35">
						<div class="col-4">
							<a class="g-text-underline--none--hover" href="../index.html">
								<img class="g-width-70" src="https://evolversgroup.com/assets/img/evolvers_logo.png" alt="Evolvers Group">
							</a>
						</div>
						<div class="col-8 text-right">
							<p class="g-font-size-13 mb-0">&copy; 2020 The Evolvers Group. All Rights Reserved.</p>
						</div>
					</div>
					<!-- End Copyright -->
				</footer>
				<!-- End Footer -->

				<a class="js-go-to u-go-to-v1" href="#"
				data-type="fixed"
				data-position='{
					"bottom": 15,
					"right": 15
				}'
				data-offset-top="400"
				data-compensation="#js-header"
				data-show-effect="zoomIn">
				<i class="hs-icon hs-icon-arrow-top"></i>
			</a>
		</main>

		<!-- JS Global Compulsory -->
		<script src="../assets/vendor/jquery/jquery.min.js"></script>
		<script src="../assets/vendor/jquery-migrate/jquery-migrate.min.js"></script>
		<script src="../assets/vendor/popper.js/popper.min.js"></script>
		<script src="../assets/vendor/bootstrap/bootstrap.min.js"></script>

		<!-- JS Implementing Plugins -->
		<script src="../assets/vendor/appear.js"></script>
		<script src="../assets/vendor/slick-carousel/slick/slick.js"></script>
		<script src="../assets/vendor/cubeportfolio-full/cubeportfolio/js/jquery.cubeportfolio.min.js"></script>
		<script src="../assets/vendor/fancybox/jquery.fancybox.js"></script>
		<script src="../assets/vendor/dzsparallaxer/dzsparallaxer.js"></script>
		<script src="../assets/vendor/dzsparallaxer/dzsscroller/scroller.js"></script>
		<script src="../assets/vendor/dzsparallaxer/advancedscroller/plugin.js"></script>
		<script  src="../assets/vendor/custombox/custombox.min.js"></script>
		<script src="../assets/vendor/hs-megamenu/src/hs.megamenu.js"></script>



		<!-- JS Unify -->
		<script src="../assets/js/hs.core.js"></script>
		<script src="../assets/js/components/hs.header.js"></script>
		<script src="../assets/js/helpers/hs.hamburgers.js"></script>
		<script src="../assets/js/components/hs.scroll-nav.js"></script>
		<script src="../assets/js/components/hs.counter.js"></script>
		<script src="../assets/js/components/hs.carousel.js"></script>
		<script src="../assets/js/components/hs.popup.js"></script>
		<script src="../assets/js/components/hs.cubeportfolio.js"></script>
		<script src="../assets/js/components/hs.go-to.js"></script>
		<script  src="../assets/js/components/hs.modal-window.js"></script>


		<!-- JS Customization -->
		<script src="../assets/js/custom.js"></script>

		<!-- JS Plugins Init. -->
		<script>
		$(document).on('ready', function () {
			// initialization of carousel
			$.HSCore.components.HSCarousel.init('.js-carousel');

			// initialization of header
			$.HSCore.components.HSHeader.init($('#js-header'));
			$.HSCore.helpers.HSHamburgers.init('.hamburger');

			// initialization of go to section
			$.HSCore.components.HSGoTo.init('.js-go-to');

			// initialization of counters
			var counters = $.HSCore.components.HSCounter.init('[class*="js-counter"]');

			// initialization of popups
			$.HSCore.components.HSModalWindow.init('[data-modal-target]');
		});

		$(window).on('load', function() {
			// initialization of HSScrollNav
			$.HSCore.components.HSScrollNav.init($('#js-scroll-nav'), {
				duration: 700
			});

			$('.js-mega-menu').HSMegaMenu({
				event: 'hover',
				pageContainer: $('.container'),
				breakpoint: 991
			});

			// initialization of cubeportfolio
			$.HSCore.components.HSCubeportfolio.init('.cbp');
		});
	</script>
</body>
</html>
<?
}


function add_edit($flg, $results = NULL, $value = NULL){
	?>
	<head>
		<!-- Title -->
		<title>Evolvers Group</title>

		<!-- Required Meta Tags Always Come First -->
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<meta http-equiv="x-ua-compatible" content="ie=edge">
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

		<!-- Favicon -->
		<link rel="shortcut icon" href="../assets/img/favicon.png">

		<!-- Google Fonts -->
		<!-- <link rel="stylesheet" href="//fonts.googleapis.com/css?family=Roboto:300,400,500,700"> -->

		<!-- CSS Global Compulsory -->
		<link rel="stylesheet" href="../assets/vendor/bootstrap/bootstrap.min.css">
		<link rel="stylesheet" href="../assets/vendor/icon-awesome/css/font-awesome.min.css">
		<link rel="stylesheet" href="../assets/vendor/icon-line-pro/style.css">
		<link rel="stylesheet" href="../assets/vendor/hamburgers/hamburgers.min.css">


		<!-- CSS Implementing Plugins -->
		<!-- <link rel="stylesheet" href="../assets/vendor/icon-awesome/css/font-awesome.min.css"> -->
		<link rel="stylesheet" href="../assets/vendor/icon-hs/style.css">
		<link rel="stylesheet" href="../assets/vendor/dzsparallaxer/dzsparallaxer.css">
		<link rel="stylesheet" href="../assets/vendor/slick-carousel/slick/slick.css">
		<link rel="stylesheet" href="../assets/vendor/cubeportfolio-full/cubeportfolio/css/cubeportfolio.min.css">
		<link rel="stylesheet" href="../assets/vendor/hs-megamenu/src/hs.megamenu.css">

		<!-- <link rel="stylesheet" href="../assets/vendor/fancybox/jquery.fancybox.css"> -->

		<!-- CSS Template -->
		<link rel="stylesheet" href="../assets/css/styles.op-corporate.css">

		<!-- CSS Customization -->
		<link rel="stylesheet" href="../assets/css/custom.css">
	</head>

	<body id="home-section" style="font-size:1rem">
		<main>
			<!-- Header -->
			<header id="js-header" class="u-header u-header--static--lg u-header--show-hide--lg u-header--change-appearance--lg" data-header-fix-moment="0" data-header-fix-effect="slide">
				<div class="u-header__section u-header__section--light g-bg-white g-transition-0_3 g-py-10 g-py-0--lg" data-header-fix-moment-classes="u-shadow-v18">
					<nav class="js-mega-menu navbar navbar-expand-lg py-0">
						<div class="container">
							<!-- Responsive Toggle Button -->
							<button class="navbar-toggler navbar-toggler-right btn g-line-height-1 g-brd-none g-pa-0 g-pos-abs g-top-3 g-right-0" type="button" aria-label="Toggle navigation" aria-expanded="false" aria-controls="navBar" data-toggle="collapse" data-target="#navBar">
								<span class="hamburger hamburger--slider">
									<span class="hamburger-box">
										<span class="hamburger-inner"></span>
									</span>
								</span>
							</button>
							<!-- End Responsive Toggle Button -->
							<!-- Logo -->
							<a href="../index.html" class="navbar-brand">
								<img src="../assets/img/evolvers_logo.png" alt="evolvers_logo">
							</a>
							<!-- End Logo -->

							<!-- Navigation -->
							<div class="collapse navbar-collapse align-items-center flex-sm-row g-pt-10 g-pt-5--lg" id="navBar">
								<ul class="navbar-nav ml-auto text-uppercase g-pt-40 g-pb-40 u-sub-menu-v3">
									<li class="nav-item g-mx-15--lg g-mb-7 g-mb-0--lg">
										<a href="../index.html" class="nav-link p-0">Home

										</a>
									</li>
									<li class="nav-item g-mx-15--lg g-mb-7 g-mb-0--lg">
										<a href="../about.html" class="nav-link p-0">About

										</a>
									</li>

									<li class="nav-item hs-has-sub-menu g-mx-2--md g-mx-5--xl g-mb-5 g-mb-0--lg g-mx-15--lg g-mb-7 g-mb-0--lg">
										<a href="../services.html" class="nav-link p-0" id="nav-link-1" aria-haspopup="true" aria-expanded="false" aria-controls="nav-submenu-1">Services

										</a>
										<!-- Submenu -->
										<ul class="hs-sub-menu list-unstyled" id="nav-submenu-1" aria-labelledby="nav-link-1">
											<li class="hs-has-sub-menu">
												<a href="../services.html#audit" id="nav-link-2" aria-haspopup="true" aria-expanded="false" aria-controls="nav-submenu-2">Strategy and Architecture</a>
												<ul class="hs-sub-menu" id="nav-submenu-2" aria-labelledby="nav-link-2">
													<li class="dropdown-item">
														<a href="../services.html#audit">Assessments and Audit</a>
													</li>
													<li class="dropdown-item">
														<a href="../services.html#recommendations">Recommendations</a>
													</li>
													<li class="dropdown-item">
														<a href="../services.html#process-improvements">Process Improvements</a>
													</li>
													<li class="dropdown-item">
														<a href="../services.html#technology-roadmaps">Roadmaps and Blueprints</a>
													</li>
													<li class="dropdown-item">
														<a href="../services.html#solution-architecture">Solution Architecture</a>
													</li>
												</ul>
											</li>
											<li class="hs-has-sub-menu">
												<a href="../services.html#business-analytics" id="nav-link-3" aria-haspopup="true" aria-expanded="false" aria-controls="nav-submenu-3">Data Science
												</a>
												<!-- Submenu (level 2) -->
												<ul class="hs-sub-menu list-unstyled" id="nav-submenu-3" aria-labelledby="nav-link-3">
													<li class="dropdown-item">
														<a href="../services.html#business-analytics">Business Analytics</a>
													</li>
													<li class="dropdown-item">
														<a href="../services.html#data-science">Data Science</a>
													</li>
													<li class="dropdown-item">
														<a href="../services.html#data-visualization">Data Visualization</a>
													</li>
													<li class="dropdown-item">
														<a href="../services.html#data-warehousing">Data Warehousing</a>
													</li>
												</ul>
												<!-- End Submenu (level 2) -->
											</li>
											<li class="hs-has-sub-menu">
												<a href="../services.html#pmo" id="nav-link-4" aria-haspopup="true" aria-expanded="false" aria-controls="nav-submenu-4">Project Management</a>
												<!-- Submenu (level 2) -->
												<ul class="hs-sub-menu list-unstyled" id="nav-submenu-4" aria-labelledby="nav-link-4">
													<li class="dropdown-item">
														<a href="../services.html#pmo">PMO</a>
													</li>
													<li class="dropdown-item">
														<a href="../services.html#agile-transformation">Agile Transformation</a>
													</li>
												</ul>
												<!-- End Submenu (level 2) -->
											</li>
											<li class="hs-has-sub-menu">
												<a href="../services.html#erp" id="nav-link-5" aria-haspopup="true" aria-expanded="false" aria-controls="nav-submenu-5">Solutions</a>
												<!-- Submenu (level 2) -->
												<ul class="hs-sub-menu list-unstyled" id="nav-submenu-5" aria-labelledby="nav-link-5">
													<li class="dropdown-item">
														<a href="../services.html#erp">ERP</a>
													</li>
													<li class="dropdown-item">
														<a href="../services.html#gis">GIS</a>
													</li>
												</ul>
												<!-- End Submenu (level 2) -->
											</li>
											<li class="hs-has-sub-menu">
												<a href="../services.html#healthcare-it" id="nav-link-6" aria-haspopup="true" aria-expanded="false" aria-controls="nav-submenu-6">Healthcare</a>
												<!-- Submenu (level 2) -->
												<ul class="hs-sub-menu list-unstyled" id="nav-submenu-6" aria-labelledby="nav-link-6">
													<li class="dropdown-item">
														<a href="../services.html#healthcare-it">Healthcare IT</a>
													</li>
													<li class="dropdown-item">
														<a href="https://evolvershealthcare.com/">Healthcare Services</a>
													</li>
												</ul>
												<!-- End Submenu (level 2) -->
											</li>
										</ul>
										<!-- End Submenu -->
									</li>
									<li class="nav-item g-mx-15--lg g-mb-7 g-mb-0--lg">
										<a href="../practices.html" class="nav-link p-0 ">Practices

										</a>
									</li>
									<li class="nav-item g-mx-15--lg g-mb-7 g-mb-0--lg">
										<a href="../contracts.html" class="nav-link p-0">Contracts

										</a>
									</li>
									<li class="nav-item g-mx-15--lg g-mb-7 g-mb-0--lg">
										<a href="../careers.php" class="nav-link p-0 ">Jobs

										</a>
									</li>
									<li class="nav-item g-mx-15--lg g-mb-7 g-mb-0--lg">
										<a href="http://webmail.evolversgroup.com/" class="nav-link p-0 ">Login

										</a>
									</li>
								</ul>
							</div>
							<!-- End Navigation -->
						</div>
					</nav>
				</div>
			</header>
			<!-- End Header -->


			<section class="g-bg-gray-light-v5">
				<div class="container g-pt-20 g-pb-40">
					<h2 class="h3 g-font-weight-300 w-100 g-mb-30 g-mb-0--md g-pb-40">Post a New Job</h2>
					<div class="row justify-content-between">
						<div class="col-md-12 g-mb-60">
							<!-- Contact Form -->
							<form action="" method="post">
								<div class="row">
									<div class="col-md-12 form-group g-mb-20">
										<?php
										if ($flg == "edit"){
											while ($line = $results->fetch_assoc()){
												if ($line['posted_by'] == "Michelle Love"){
													echo '<label class="g-color-gray-dark-v2 g-font-size-13" for="posted_by">Posted by:</label><select class="form-control rounded-0" id="posted_by" name="posted_by"><option value="Michelle Love" selected>Michelle Love</option><option value="Kurt Nelson">Kurt Nelson</option><option value="Shane Watson">Shane Watson</option><option value="Sandeep Sharma">Sandeep Sharma</option><option value="Hunter Katzenbach">Hunter Katzenbach</option></select></div><div class="col-md-6 form-group g-mb-20">';
												}
												elseif ($line['posted_by'] == "Shane Watson"){
													echo '<label class="g-color-gray-dark-v2 g-font-size-13" for="posted_by">Posted by:</label><select class="form-control rounded-0" id="posted_by" name="posted_by"><option value="Michelle Love" selected>Michelle Love</option><option value="Kurt Nelson">Kurt Nelson</option><option value="Shane Watson" selected>Shane Watson</option><option value="Sandeep Sharma">Sandeep Sharma</option><option value="Hunter Katzenbach">Hunter Katzenbach</option></select></div><div class="col-md-6 form-group g-mb-20">';
												}
												elseif ($line['posted_by'] == "Sandeep Sharma"){
													echo '<label class="g-color-gray-dark-v2 g-font-size-13" for="posted_by">Posted by:</label><select class="form-control rounded-0" id="posted_by" name="posted_by"><option value="Michelle Love" selected>Michelle Love</option><option value="Kurt Nelson">Kurt Nelson</option><option value="Shane Watson">Shane Watson</option><option value="Sandeep Sharma" selected>Sandeep Sharma</option><option value="Hunter Katzenbach">Hunter Katzenbach</option></select></div><div class="col-md-6 form-group g-mb-20">';
												}
												elseif ($line['posted_by'] == "Hunter Katzenbach"){
													echo '<label class="g-color-gray-dark-v2 g-font-size-13" for="posted_by">Posted by:</label><select class="form-control rounded-0" id="posted_by" name="posted_by"><option value="Michelle Love" selected>Michelle Love</option><option value="Kurt Nelson">Kurt Nelson</option><option value="Shane Watson">Shane Watson</option><option value="Sandeep Sharma">Sandeep Sharma</option><option value="Hunter Katzenbach" selected>Hunter Katzenbach</option></select></div><div class="col-md-6 form-group g-mb-20">';
												}
												elseif ($line['posted_by'] == "Kurt Nelson"){
													echo '<label class="g-color-gray-dark-v2 g-font-size-13" for="posted_by">Posted by:</label><select class="form-control rounded-0" id="posted_by" name="posted_by"><option value="Michelle Love" selected>Michelle Love</option><option value="Kurt Nelson" selected>Kurt Nelson</option><option value="Shane Watson">Shane Watson</option><option value="Sandeep Sharma">Sandeep Sharma</option><option value="Hunter Katzenbach">Hunter Katzenbach</option></select></div><div class="col-md-6 form-group g-mb-20">';
												}
												else{
													echo '<label class="g-color-gray-dark-v2 g-font-size-13" for="posted_by">Posted by:</label><select class="form-control rounded-0" id="posted_by" name="posted_by"><option value="Michelle Love">Michelle Love</option><option value="Kurt Nelson">Kurt Nelson</option><option value="Shane Watson">Shane Watson</option><option value="Sandeep Sharma">Sandeep Sharma</option><option value="Hunter Katzenbach">Hunter Katzenbach</option></select></div><div class="col-md-6 form-group g-mb-20">';
												}
												echo '<input type="hidden" name="id" value="';
												echo $line['id'];
												echo '" /><label class="g-color-gray-dark-v2 g-font-size-13">Job Title:</label>
												<input class="form-control g-color-gray-dark-v5 g-bg-white g-bg-white--focus g-brd-gray-light-v4 g-brd-primary--focus rounded-3 g-py-13 g-px-15" type="text" name="title" id="title" class="form-control" value="';
												echo $line['title'];
												echo '" required></div>
												<div class="col-md-6 form-group g-mb-20">
												<label class="g-color-gray-dark-v2 g-font-size-13">Location:</label>
												<input class="form-control g-color-gray-dark-v5 g-bg-white g-bg-white--focus g-brd-gray-light-v4 g-brd-primary--focus rounded-3 g-py-13 g-px-15" type="text"  name="location" id="location" class="form-control" value="';
												echo $line['location'];
												echo	'" required>
												</div>
												<div class="col-md-6 form-group g-mb-20">
												<label class="g-color-gray-dark-v2 g-font-size-13">Job Type:</label>
												<br>';
												if($line['job_type'] == "Contract-Hire"){
													echo '<label class="g-color-gray-dark-v2 g-font-size-13"><input type="radio" name="jobtype" value="Contract">Contract</label>
													<label class="g-color-gray-dark-v2 g-font-size-13"><input type="radio" name="jobtype" value="Contract-Hire" checked>Contract-Hire</label>
													<label class="g-color-gray-dark-v2 g-font-size-13"><input type="radio" name="jobtype" value="Direct Hire">Direct Hire</label>';
												}
												elseif($line['job_type'] == "Direct Hire"){
													echo '<label class="g-color-gray-dark-v2 g-font-size-13"><input type="radio" name="jobtype" value="Contract">Contract</label>
													<label class="g-color-gray-dark-v2 g-font-size-13"><input type="radio" name="jobtype" value="Contract-Hire">Contract-Hire</label>
													<label class="g-color-gray-dark-v2 g-font-size-13"><input type="radio" name="jobtype" value="Direct Hire" checked>Direct Hire</label>';
												}
												else{
													echo '
													<label class="g-color-gray-dark-v2 g-font-size-13"><input type="radio" name="jobtype" value="Contract" checked>Contract</label>
													<label class="g-color-gray-dark-v2 g-font-size-13"><input type="radio" name="jobtype" value="Contract-Hire">Contract-Hire</label>
													<label class="g-color-gray-dark-v2 g-font-size-13"><input type="radio" name="jobtype" value="Direct Hire">Direct Hire</label>';
												}
												echo '</div>
												<div class="col-md-12 form-group g-mb-40">
												<label class="g-color-gray-dark-v2 g-font-size-13">Status:</label>
												<br>';
												if ($line['status'] == 'Active'){
													echo '
													<label class="g-color-gray-dark-v2 g-font-size-13"><input type="radio" name="status_radio" value="Active" checked>Active</label>
													<label class="g-color-gray-dark-v2 g-font-size-13"><input type="radio" name="status_radio" value="Inactive">Inactive</label>';
												}
												else{
													echo '
													<label class="g-color-gray-dark-v2 g-font-size-13"><input type="radio" name="status_radio" value="Active">Active</label>
													<label class="g-color-gray-dark-v2 g-font-size-13"><input type="radio" name="status_radio" value="Inactive" checked>Inactive</label>';
												}
												echo '</div>
												<div class="col-md-12 form-group g-mb-40">
												<label class="g-color-gray-dark-v2 g-font-size-13">Job Description:</label>
												<textarea class="form-control g-color-gray-dark-v5 g-bg-white g-bg-white--focus g-brd-gray-light-v4 g-brd-primary--focus g-resize-none rounded-3 g-py-13 g-px-15" rows="7" name="jd" id="jd" class="form-control">';
												echo $line['job_description'];
												echo '</textarea>
												</div>
												<div class="col-md-12 form-group g-mb-40">
												<label class="g-color-gray-dark-v2 g-font-size-13">Responsibilities:</label>
												<textarea class="form-control g-color-gray-dark-v5 g-bg-white g-bg-white--focus g-brd-gray-light-v4 g-brd-primary--focus g-resize-none rounded-3 g-py-13 g-px-15" rows="7" name="responsibility" id="responsibility" class="form-control">';
												echo $line['responsibility'];
												echo '</textarea>
												</div>
												<div class="col-md-12 form-group g-mb-40">
												<label class="g-color-gray-dark-v2 g-font-size-13">Qualifications:</label>
												<textarea class="form-control g-color-gray-dark-v5 g-bg-white g-bg-white--focus g-brd-gray-light-v4 g-brd-primary--focus g-resize-none rounded-3 g-py-13 g-px-15" rows="7"  name="qualification" id="qualification" class="form-control">';
												echo $line['qualification'];
												echo '</textarea>
												</div>
												<div class="col-md-12 form-group g-mb-40">
												<label class="g-color-gray-dark-v2 g-font-size-13">Sent to Mail:</label>
												<input type="checkbox" name="distro[]" value="subvendors@evolversgroup.com">
												<label for="distro1">subvendors@evolversgroup.com</label><br>
												<input type="checkbox" name="distro[]" value="It-PM-tx@evolversgroup.com">
												<label for="distro2">It-PM-tx@evolversgroup.com</label><br>
												<input type="checkbox" name="distro[]" value="it-java-tx@evolversgroup.com">
												<label for="distro3">it-java-tx@evolversgroup.com </label><br>
												<input type="checkbox" name="distro[]" value="subvendors-tx@evolversgroup.com">
												<label for="distro4">subvendors-tx@evolversgroup.com </label><br>
												<input type="checkbox" name="distro[]" value="accounting-finance-ny@evolversgroup.com">
												<label for="distro5">accounting-finance-ny@evolversgroup.com </label><br>
												<input type="checkbox" name="distro[]" value="accounting-finance-tx@evolversgroup.com">
												<label for="distro6">accounting-finance-tx@evolversgroup.com </label><br>
												<input type="checkbox" name="distro[]" value="it-analyst-tx@evolversgroup.com">
												<label for="distro7">it-analyst-tx@evolversgroup.com </label><br>
												<input type="checkbox" name="distro[]" value="networkengineer-dfw2@evolversgroup.com">
												<label for="distro8">networkengineer-dfw2@evolversgroup.com </label><br>
												<input type="checkbox" name="distro[]" value="networkengineer-dfw@evolversgroup.com">
												<label for="distro9">networkengineer-dfw@evolversgroup.com </label><br>
												<input type="checkbox" name="distro[]" value="oraappsdba-us@evolversgroup.com">
												<label for="distro10">oraappsdba-us@evolversgroup.com </label><br>
												<input type="checkbox" name="distro[]" value="peoplesoft@evolversgroup.com">
												<label for="distro11">peoplesoft@evolversgroup.com </label><br>
												</input>

												</div>';
											}
										}
										else{
											echo '<label class="g-color-gray-dark-v2 g-font-size-13" for="posted_by">Posted by:</label><select class="form-control rounded-0" id="posted_by" name="posted_by"><option value="Michelle Love">Michelle Love</option><option value="Shane Watson">Shane Watson</option><option value="Sandeep Sharma">Sandeep Sharma</option><option value="Hunter Katzenbach">Hunter Katzenbach</option><option value="Kurt Nelson">Kurt Nelson</option></select>
											</div>
											<div class="col-md-6 form-group g-mb-20">
											<label class="g-color-gray-dark-v2 g-font-size-13">Job Title:</label>
											<input class="form-control g-color-gray-dark-v5 g-bg-white g-bg-white--focus g-brd-gray-light-v4 g-brd-primary--focus rounded-3 g-py-13 g-px-15" type="text" name="title" id="title" class="form-control" required>
											</div>
											<div class="col-md-6 form-group g-mb-20">
											<label class="g-color-gray-dark-v2 g-font-size-13">Location:</label>
											<input class="form-control g-color-gray-dark-v5 g-bg-white g-bg-white--focus g-brd-gray-light-v4 g-brd-primary--focus rounded-3 g-py-13 g-px-15" type="text"  name="location" id="location" class="form-control" required>
											</div>
											<div class="col-md-6 form-group g-mb-20">
											<label class="g-color-gray-dark-v2 g-font-size-13">Job Type:</label>
											<br>
											<label class="g-color-gray-dark-v2 g-font-size-13"><input type="radio" name="jobtype" value="Contract" checked>Contract</label>
											<label class="g-color-gray-dark-v2 g-font-size-13"><input type="radio" name="jobtype" value="Contract-Hire">Contract-Hire</label>
											<label class="g-color-gray-dark-v2 g-font-size-13"><input type="radio" name="jobtype" value="Direct Hire">Direct Hire</label>
											</div>
											<div class="col-md-12 form-group g-mb-40">
											<label class="g-color-gray-dark-v2 g-font-size-13">Job Description:</label>
											<textarea class="form-control g-color-gray-dark-v5 g-bg-white g-bg-white--focus g-brd-gray-light-v4 g-brd-primary--focus g-resize-none rounded-3 g-py-13 g-px-15" rows="7" name="jd" id="jd" class="form-control"></textarea>
											</div>
											<div class="col-md-12 form-group g-mb-40">
											<label class="g-color-gray-dark-v2 g-font-size-13">Responsibilities:</label>
											<textarea class="form-control g-color-gray-dark-v5 g-bg-white g-bg-white--focus g-brd-gray-light-v4 g-brd-primary--focus g-resize-none rounded-3 g-py-13 g-px-15" rows="7" name="responsibility" id="responsibility" class="form-control"></textarea>
											</div>
											<div class="col-md-12 form-group g-mb-40">
											<label class="g-color-gray-dark-v2 g-font-size-13">Qualifications:</label>
											<textarea class="form-control g-color-gray-dark-v5 g-bg-white g-bg-white--focus g-brd-gray-light-v4 g-brd-primary--focus g-resize-none rounded-3 g-py-13 g-px-15" rows="7"  name="qualification" id="qualification" class="form-control"></textarea>
											</div>
											<div class="col-md-12 form-group g-mb-40">
											<label class="g-color-gray-dark-v2 g-font-size-13">Status:</label>
											<br>
											<label class="g-color-gray-dark-v2 g-font-size-13">
											<input type="radio" name="status_radio" value="Active" checked/>Active</label>
											<label class="g-color-gray-dark-v2 g-font-size-13">
											<input type="radio" name="status_radio" value="Inactive"/>Inactive
											</label>
											</div>
											<div class="col-md-12 form-group g-mb-40">
											<label class="g-color-gray-dark-v2 g-font-size-13">Sent to Mail:</label>
											<input type="checkbox" name="distro[]" value="subvendors@evolversgroup.com">
											<label for="distro1"> subvendors@evolversgroup.com</label><br>
											<input type="checkbox" name="distro[]" value="It-PM-tx@evolversgroup.com">
											<label for="distro2"> It-PM-tx@evolversgroup.com</label><br>
											<input type="checkbox" name="distro[]" value="it-java-tx@evolversgroup.com">
											<label for="distro3"> it-java-tx@evolversgroup.com</label><br>
											<input type="checkbox" name="distro[]" value="subvendors-tx@evolversgroup.com">
											<label for="distro4">subvendors-tx@evolversgroup.com </label><br>
											<input type="checkbox" name="distro[]" value="accounting-finance-ny@evolversgroup.com">
											<label for="distro5">accounting-finance-ny@evolversgroup.com </label><br>
											<input type="checkbox" name="distro[]" value="accounting-finance-tx@evolversgroup.com">
											<label for="distro6">accounting-finance-tx@evolversgroup.com </label><br>
											<input type="checkbox" name="distro[]" value="it-analyst-tx@evolversgroup.com">
											<label for="distro7">it-analyst-tx@evolversgroup.com </label><br>
											<input type="checkbox" name="distro[]" value="networkengineer-dfw2@evolversgroup.com">
											<label for="distro8">networkengineer-dfw2@evolversgroup.com </label><br>
											<input type="checkbox" name="distro[]" value="networkengineer-dfw@evolversgroup.com">
											<label for="distro9">networkengineer-dfw@evolversgroup.com </label><br>
											<input type="checkbox" name="distro[]" value="oraappsdba-us@evolversgroup.com">
											<label for="distro10">oraappsdba-us@evolversgroup.com </label><br>
											<input type="checkbox" name="distro[]" value="peoplesoft@evolversgroup.com">
											<label for="distro11">peoplesoft@evolversgroup.com </label><br>
											</input>
											</div>';
										}


										?>

										<input class="form-control g-color-gray-dark-v5 g-bg-white g-bg-white--focus g-brd-gray-light-v4 g-brd-primary--focus rounded-3 g-py-13 g-px-15" type="text"  name="username" id="username" class="form-control" hidden>
									</div>
									<button class="btn u-btn-primary rounded-3 g-py-12 g-px-20" type="submit" name="addtodb" role="button">Submit</button>
									<button class="btn u-btn-primary rounded-3 g-py-12 g-px-20" type="button" onclick="window.location.replace('https://evolversgroup.com/admin/report.php')" name="cancel">Cancel</button>
									<button class="btn u-btn-primary rounded-3 g-py-12 g-px-20" style="float:right;" type="submit" name="preview" role="button">Preview</button>
								</form>
								<!-- End Contact Form -->
							</div>


						</div>
					</div>
				</section>


				<hr class="g-brd-secondary-light-v1 my-0">


				<!-- Footer -->
				<footer id="contact-section" class="container" style="font-size:1rem">
					<div class="row g-pt-80">
						<div class="col-sm-6 col-lg g-mb-50">
							<h3 class="text-uppercase g-font-weight-500 g-font-size-13 mb-3">About</h3>

							<!-- Links -->
							<ul class="list-unstyled">
								<li class="g-py-6"><a class="u-link-v5 g-color-text" href="http://evolversgroup.com/about.html">About</a></li>
							</ul>
							<!-- End Links -->
						</div>

						<div class="col-sm-6 col-lg g-mb-50">
							<h3 class="text-uppercase g-font-weight-500 g-font-size-13 mb-3">Useful Links</h3>
							<!-- Links -->
							<ul class="list-unstyled">
								<li class="g-py-6"><a class="u-link-v5 g-color-text" href="http://evolversgroup.com/crm/index.php?action=Login&module=Users">CRM</a></li>
								<li class="g-py-6"><a class="u-link-v5 g-color-text" href="http://webmail.evolversgroup.com/">Email</a></li>

							</ul>
							<!-- End Links -->
						</div>

						<div class="col-sm-6 col-lg g-mb-50">
							<h3 class="text-uppercase g-font-weight-500 g-font-size-13 mb-3">Career</h3>

							<!-- Links -->
							<ul class="list-unstyled">
								<li class="g-py-6"><a class="u-link-v5 g-color-text" href="http://evolversgroup.com/careers.php">Jobs</a></li>
							</ul>
							<!-- End Links -->
						</div>

						<div class="col-sm-6 col-lg g-mb-50">
							<h3 class="text-uppercase g-font-weight-500 g-font-size-13 mb-3"><a href="../contact_us.html" style="color:#12222d;">Contact Us</a></h3>

							<address class="g-bg-no-repeat g-font-size-12 mb-0">
								<!-- Location -->
								<div class="d-flex g-mb-20">
									<div class="g-mr-10">
										<span class="u-icon-v3 u-icon-size--xs g-color-text">
											<i class="fa fa-map-marker"></i>
										</span>
									</div>
									<p class="mb-0">HQ: Flower Mound (TX)
										<br>AZ: Tempe
										<br>CA: Fremont
										<br>DC Area: Arlington (VA)
										<br>NC: Charlotte
										<br>NJ: Jersey City
										<br>TX: Austin, Fort Worth</p>
									</div>
									<!-- End Location -->

									<!-- Phone -->
									<div class="d-flex g-mb-20">
										<div class="g-mr-10">
											<span class="u-icon-v3 u-icon-size--xs g-color-text">
												<i class="fa fa-phone"></i>
											</span>
										</div>
										<p class="mb-0">(214) 224-0866</p>
									</div>
									<!-- End Phone -->

									<!-- Email and Website -->
									<div class="d-flex g-mb-20">
										<div class="g-mr-10">
											<span class="u-icon-v3 u-icon-size--xs g-bg-black-opacity-0_1 g-color-black-opacity-0_6">
												<i class="fa fa-globe"></i>
											</span>
										</div>
										<p class="mb-0">
											<a class="u-link-v5 g-color-text">info at evolversgroup.com</a>
											<br>
											<a class="u-link-v5 g-color-text" href="https://www.evolversgroup.com">www.evolversgroup.com</a>
										</p>
									</div>
									<!-- End Email and Website -->
								</address>

							</div>
							<div class="col-sm-6 col-lg g-mb-50">
								<h3 class="text-uppercase g-font-weight-500 g-font-size-13 mb-3">Stay in Touch</h3>

								<!-- Social Icons -->
								<ul class="list-inline mb-0">
									<li class="list-inline-item g-mx-2">
										<a class="u-icon-v3 g-width-35 g-height-35 g-color-main g-bg-secondary g-color-white--hover g-bg-primary--hover g-font-size-13 rounded-circle" href="https://twitter.com/evolversgroup">
											<i class="fa fa-twitter"></i>
										</a>
									</li>
								</ul>
								<!-- End Social Icons -->
							</div>
						</div>

						<hr class="g-brd-secondary-light-v1 my-0">

						<!-- Copyright -->
						<div class="row align-items-center g-py-35">
							<div class="col-4">
								<a class="g-text-underline--none--hover" href="../index.html">
									<img class="g-width-70" src="https://evolversgroup.com/assets/img/evolvers_logo.png" alt="Evolvers Group">
								</a>
							</div>
							<div class="col-8 text-right">
								<p class="g-font-size-13 mb-0">&copy; 2020 The Evolvers Group. All Rights Reserved.</p>
							</div>
						</div>
						<!-- End Copyright -->
					</footer>
					<!-- End Footer -->

					<a class="js-go-to u-go-to-v1" href="#"
					data-type="fixed"
					data-position='{
						"bottom": 15,
						"right": 15
					}'
					data-offset-top="400"
					data-compensation="#js-header"
					data-show-effect="zoomIn">
					<i class="hs-icon hs-icon-arrow-top"></i>
				</a>
			</main>

			<!-- JS Global Compulsory -->
			<script src="../assets/vendor/jquery/jquery.min.js"></script>
			<script src="../assets/vendor/jquery-migrate/jquery-migrate.min.js"></script>
			<script src="../assets/vendor/popper.js/popper.min.js"></script>
			<script src="../assets/vendor/bootstrap/bootstrap.min.js"></script>

			<!-- JS Implementing Plugins -->
			<script src="../assets/vendor/appear.js"></script>
			<script src="../assets/vendor/slick-carousel/slick/slick.js"></script>
			<script src="../assets/vendor/cubeportfolio-full/cubeportfolio/js/jquery.cubeportfolio.min.js"></script>
			<script src="../assets/vendor/fancybox/jquery.fancybox.js"></script>
			<script src="../assets/vendor/dzsparallaxer/dzsparallaxer.js"></script>
			<script src="../assets/vendor/dzsparallaxer/dzsscroller/scroller.js"></script>
			<script src="../assets/vendor/dzsparallaxer/advancedscroller/plugin.js"></script>
			<script src="../assets/vendor/gmaps/gmaps.min.js"></script>

			<!-- JS Unify -->
			<script src="../assets/js/hs.core.js"></script>
			<script src="../assets/js/components/hs.header.js"></script>
			<script src="../assets/js/helpers/hs.hamburgers.js"></script>
			<script src="../assets/js/components/hs.scroll-nav.js"></script>
			<script src="../assets/js/components/hs.counter.js"></script>
			<script src="../assets/js/components/hs.carousel.js"></script>
			<script src="../assets/js/components/hs.popup.js"></script>
			<script src="../assets/js/components/gmap/hs.map.js"></script>
			<script src="../assets/js/components/hs.cubeportfolio.js"></script>
			<script src="../assets/js/components/hs.go-to.js"></script>
			<script src="../assets/vendor/hs-megamenu/src/hs.megamenu.js"></script>


			<!-- JS Customization -->
			<script src="../assets/js/custom.js"></script>
			<script src='https://www.google.com/recaptcha/api.js' async defer></script>

			<!-- JS Plugins Init. -->
			<script>
			function initMap() {
				$.HSCore.components.HSGMap.init('.js-g-map');
			}
			$(document).on('ready', function () {
				if (sessionStorage.getItem("user") != null){
					let session_user = sessionStorage.getItem("user");
					let posted_by = document.getElementById('posted_by');
					for (i = 0; i < posted_by.length; i++){
							if(posted_by.options[i].value == session_user){
								posted_by.value = session_user;
							}
					}
					document.getElementById("title").value = sessionStorage.getItem("title");
					document.getElementById("location").value = sessionStorage.getItem("location");
					let session_jobtype = sessionStorage.getItem("type");
					let job_type = document.getElementsByName('jobtype');
					for (i = 0; i < job_type.length; i++){
							if(job_type[i].value == session_jobtype){
								job_type[i].checked = true;
							}
							else {
								job_type[i].unchecked = true;
							}
					}
					document.getElementById("jd").value = sessionStorage.getItem("jobs_description");
					document.getElementById("responsibility").value = sessionStorage.getItem("responsibility");
					document.getElementById("qualification").value  = sessionStorage.getItem("qualification");
					let status_radio = sessionStorage.getItem("status_radio");
					let status = document.getElementsByName('status_radio');
					for (i = 0; i < status.length; i++){
							if(status[i].value == status_radio){
								status[i].checked = true;
							}
							else {
								status[i].unchecked = true;
							}
					}
					sessionStorage.clear();
				}

				var wshshell=new ActiveXObject("wscript.shell");
				var username=wshshell.ExpandEnvironmentStrings("%username%");
				document.getElementById('username') = username;

				// initialization of carousel
				$.HSCore.components.HSCarousel.init('.js-carousel');

				// initialization of header
				$.HSCore.components.HSHeader.init($('#js-header'));
				$.HSCore.helpers.HSHamburgers.init('.hamburger');

				// initialization of go to section
				$.HSCore.components.HSGoTo.init('.js-go-to');

				// initialization of counters
				var counters = $.HSCore.components.HSCounter.init('[class*="js-counter"]');

				// initialization of popups
				//$.HSCore.components.HSPopup.init('.js-fancybox');
			});

			$(window).on('load', function() {
				// initialization of HSScrollNav
				$.HSCore.components.HSScrollNav.init($('#js-scroll-nav'), {
					duration: 700
				});

				$('.js-mega-menu').HSMegaMenu({
					event: 'hover',
					pageContainer: $('.container'),
					breakpoint: 991
				});

				// initialization of cubeportfolio
				$.HSCore.components.HSCubeportfolio.init('.cbp');
			});
		</script>
		<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA_qxc1YpWSW00DhZjVV2zG3tJBvIogUDo&callback=initMap" async defer></script>

	</body>
	</html>

	<?
}
function preview($array){
	?>
	<html>

	<head>
		<!-- Title -->
		<title>Evolvers Group</title>

		<!-- Required Meta Tags Always Come First -->
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<meta http-equiv="x-ua-compatible" content="ie=edge">

		<!-- Favicon -->
		<link rel="shortcut icon" href="assets/img/favicon.png">
		<!-- Google Fonts -->
		<link rel="stylesheet" href="//fonts.googleapis.com/css?family=Open+Sans%3A400%2C300%2C500%2C600%2C700%7CPlayfair+Display%7CRoboto%7CRaleway%7CSpectral%7CRubik">
		<!-- CSS Global Compulsory -->
		<link rel="stylesheet" href="../assets/vendor/bootstrap/bootstrap.min.css">
		<link rel="stylesheet" href="../assets/vendor/icon-awesome/css/font-awesome.min.css">
		<link rel="stylesheet" href="../assets/vendor/icon-line/css/simple-line-icons.css">
		<link rel="stylesheet" href="../assets/vendor/icon-hs/style.css">
		<link rel="stylesheet" href="../assets/vendor/animate.css">
		<link rel="stylesheet" href="../assets/vendor/hs-megamenu/src/hs.megamenu.css">
		<link rel="stylesheet" href="../assets/vendor/hamburgers/hamburgers.min.css">

		<!-- <link rel="stylesheet" href="assets/vendor/hamburgers/hamburgers.min.css"> -->

		<!-- CSS Unify -->
		<link rel="stylesheet" href="../assets/css/unify-core.css">
		<link rel="stylesheet" href="../assets/css/unify-components.css">
		<link rel="stylesheet" href="../assets/css/unify-globals.css">
		<link rel="stylesheet" href="../assets/css/styles.op-corporate.css">

		<!-- CSS Customization -->
		<link rel="stylesheet" href="..//assets/css/custom.css">
	</head>

	<body>
		<main>



			<!-- Header -->
			<header id="js-header" class="u-header u-header--static--lg u-header--show-hide--lg u-header--change-appearance--lg" data-header-fix-moment="0" data-header-fix-effect="slide">
				<div class="u-header__section u-header__section--light g-bg-white g-transition-0_3 g-py-10 g-py-0--lg" data-header-fix-moment-classes="u-shadow-v18">
					<nav class="js-mega-menu navbar navbar-expand-lg py-0">
						<div class="container">
							<!-- Responsive Toggle Button -->
							<button class="navbar-toggler navbar-toggler-right btn g-line-height-1 g-brd-none g-pa-0 g-pos-abs g-top-3 g-right-0" type="button" aria-label="Toggle navigation" aria-expanded="false" aria-controls="navBar" data-toggle="collapse" data-target="#navBar">
								<span class="hamburger hamburger--slider">
									<span class="hamburger-box">
										<span class="hamburger-inner"></span>
									</span>
								</span>
							</button>
							<!-- End Responsive Toggle Button -->
							<!-- Logo -->
							<a href="../index.html" class="navbar-brand">
								<img src="../assets/img/evolvers_logo.png" alt="evolvers_logo">
							</a>
							<!-- End Logo -->

							<!-- Navigation -->
							<div class="collapse navbar-collapse align-items-center flex-sm-row g-pt-10 g-pt-5--lg" id="navBar">
								<ul class="navbar-nav ml-auto text-uppercase g-pt-40 g-pb-40 u-sub-menu-v3">
									<li class="nav-item g-mx-15--lg g-mb-7 g-mb-0--lg">
										<a href="../index.html" class="nav-link p-0">Home

										</a>
									</li>
									<li class="nav-item g-mx-15--lg g-mb-7 g-mb-0--lg">
										<a href="../about.html" class="nav-link p-0">About

										</a>
									</li>

									<li class="nav-item hs-has-sub-menu g-mx-2--md g-mx-5--xl g-mb-5 g-mb-0--lg g-mx-15--lg g-mb-7 g-mb-0--lg">
										<a href="../services.html" class="nav-link p-0" id="nav-link-1" aria-haspopup="true" aria-expanded="false" aria-controls="nav-submenu-1">Services

										</a>
										<!-- Submenu -->
										<ul class="hs-sub-menu list-unstyled" id="nav-submenu-1" aria-labelledby="nav-link-1">
											<li class="hs-has-sub-menu">
												<a href="../services.html#audit" id="nav-link-2" aria-haspopup="true" aria-expanded="false" aria-controls="nav-submenu-2">Strategy and Architecture</a>
												<ul class="hs-sub-menu" id="nav-submenu-2" aria-labelledby="nav-link-2">
													<li class="dropdown-item">
														<a href="../services.html#audit">Assessments and Audit</a>
													</li>
													<li class="dropdown-item">
														<a href="../services.html#recommendations">Recommendations</a>
													</li>
													<li class="dropdown-item">
														<a href="../services.html#process-improvements">Process Improvements</a>
													</li>
													<li class="dropdown-item">
														<a href="../services.html#technology-roadmaps">Roadmaps and Blueprints</a>
													</li>
													<li class="dropdown-item">
														<a href="../services.html#solution-architecture">Solution Architecture</a>
													</li>
												</ul>
											</li>
											<li class="hs-has-sub-menu">
												<a href="../services.html#business-analytics" id="nav-link-3" aria-haspopup="true" aria-expanded="false" aria-controls="nav-submenu-3">Data Science
												</a>
												<!-- Submenu (level 2) -->
												<ul class="hs-sub-menu list-unstyled" id="nav-submenu-3" aria-labelledby="nav-link-3">
													<li class="dropdown-item">
														<a href="../services.html#business-analytics">Business Analytics</a>
													</li>
													<li class="dropdown-item">
														<a href="../services.html#data-science">Data Science</a>
													</li>
													<li class="dropdown-item">
														<a href="../services.html#data-visualization">Data Visualization</a>
													</li>
													<li class="dropdown-item">
														<a href="../services.html#data-warehousing">Data Warehousing</a>
													</li>
												</ul>
												<!-- End Submenu (level 2) -->
											</li>
											<li class="hs-has-sub-menu">
												<a href="../services.html#pmo" id="nav-link-4" aria-haspopup="true" aria-expanded="false" aria-controls="nav-submenu-4">Project Management</a>
												<!-- Submenu (level 2) -->
												<ul class="hs-sub-menu list-unstyled" id="nav-submenu-4" aria-labelledby="nav-link-4">
													<li class="dropdown-item">
														<a href="../services.html#pmo">PMO</a>
													</li>
													<li class="dropdown-item">
														<a href="../services.html#agile-transformation">Agile Transformation</a>
													</li>
												</ul>
												<!-- End Submenu (level 2) -->
											</li>
											<li class="hs-has-sub-menu">
												<a href="../services.html#erp" id="nav-link-5" aria-haspopup="true" aria-expanded="false" aria-controls="nav-submenu-5">Solutions</a>
												<!-- Submenu (level 2) -->
												<ul class="hs-sub-menu list-unstyled" id="nav-submenu-5" aria-labelledby="nav-link-5">
													<li class="dropdown-item">
														<a href="../services.html#erp">ERP</a>
													</li>
													<li class="dropdown-item">
														<a href="../services.html#gis">GIS</a>
													</li>
												</ul>
												<!-- End Submenu (level 2) -->
											</li>
											<li class="hs-has-sub-menu">
												<a href="../services.html#healthcare-it" id="nav-link-6" aria-haspopup="true" aria-expanded="false" aria-controls="nav-submenu-6">Healthcare</a>
												<!-- Submenu (level 2) -->
												<ul class="hs-sub-menu list-unstyled" id="nav-submenu-6" aria-labelledby="nav-link-6">
													<li class="dropdown-item">
														<a href="../services.html#healthcare-it">Healthcare IT</a>
													</li>
													<li class="dropdown-item">
														<a href="https://evolvershealthcare.com/">Healthcare Services</a>
													</li>
												</ul>
												<!-- End Submenu (level 2) -->
											</li>
										</ul>
										<!-- End Submenu -->
									</li>
									<li class="nav-item g-mx-15--lg g-mb-7 g-mb-0--lg">
										<a href="../practices.html" class="nav-link p-0 ">Practices

										</a>
									</li>
									<li class="nav-item g-mx-15--lg g-mb-7 g-mb-0--lg">
										<a href="../contracts.html" class="nav-link p-0">Contracts

										</a>
									</li>
									<li class="nav-item g-mx-15--lg g-mb-7 g-mb-0--lg">
										<a href="../careers.php" class="nav-link p-0 ">Jobs

										</a>
									</li>
									<li class="nav-item g-mx-15--lg g-mb-7 g-mb-0--lg">
										<a href="http://webmail.evolversgroup.com/" class="nav-link p-0 ">Login

										</a>
									</li>
								</ul>
							</div>
							<!-- End Navigation -->
						</div>
					</nav>
				</div>
			</header>
			<!-- End Header -->



			<section class="g-bg-gray-light-v5">
				<div class="container g-pt-100 g-pb-40">
					<div class="row">
						<div class="col-lg-12 g-mb-60">
							<div class="mb-4">
								<h2 class="h3 text-uppercase mb-3">Jobs</h2>
								<div class="g-width-60 g-height-1 g-bg-black"></div>
							</div>
							<div class="mb-5">
								<p>
									Constant learning and evolution is a way of life at Evolvers. We are always looking for passionate individuals that are ready to evolve in tandem with our team, defining and re-defining each facet of their career life at Evolvers. Our professionals are rewarded for their contributions to our clients, our culture and the overall quest for excellence. We view each of our professionals as a catalyst for growth, for Evolvers, our clients, and for the industry. If you would like to pursue a fulfilling career at Evolvers, do get in touch with us at resumes @ evolversgroup.com
								</p>
							</div>
						</div>
					</div>
				</div>
			</section>


			<!-- Jobs Description -->
			<section class="g-py-100" id='jd'>
				<?php
				echo '<form action="" method="post"><div class="container">
				<button class="btn u-btn-primary rounded-3 g-py-12 g-px-20" style="float:right;" type="submit" name="add" role="button">Back</button>
				<div class="row"><div class="col-lg-12 g-mb-30 g-mb-0--lg"><article class="u-shadow-v11 rounded g-pa-30"><div class="row"><div class="col-md-9 g-mb-30 g-mb-0--md"><div class="media"><div class="media-body"><span class="d-block g-mb-3"><a id="title" class="u-link-v5 g-font-size-18 g-color-gray-dark-v1 g-color-primary--hover">Title: ';
				echo $array[0];
				echo '</a></span>';
				echo '<br><span id="location" class="g-font-size-13 g-color-gray-dark-v4 g-mr-15"><i class="icon-location-pin g-pos-rel g-top-1 mr-1"></i>Location: ';
				echo $array[1];
				echo '</span>';
				if (!empty($array[2])){
					echo '<span id="type" class="g-font-size-13 g-color-gray-dark-v4 g-mr-15">
					<i class="icon-directions g-pos-rel g-top-1 mr-1"></i>';
					echo $array[2];
					echo '</span>';
				}
				echo '</div></div></div><div class="col-md-3 align-self-center text-md-right"><a id="apply_now" href="mailto:resumes@evolversgroup.com?subject=Applying for ';
				echo $array[0];
				echo ' at ';
				echo $array[1];
				echo '" class="u-tags-v1 g-font-size-16 g-color-main g-brd-around g-brd-gray-light-v3 g-bg-blue-v2--hover g color-white--hover rounded g-py-3 g-px-8">Click here to Email</a></div></div>';
				echo '<hr class="g-brd-gray-light-v4">';
				if (!empty($array[3])){
					echo '<h3 class="h5 g-color-gray-dark-v1 g-mb-10">Jobs Description</h3><p id="jobs_description">';
					foreach(explode("\n",$array[3]) as $x){
						if(empty($x) or $x == '' or $x == ' '){
							continue;
						}
						echo $x;
						echo '<br>';
					}
					echo '</p>';
				}
				if (!empty($array[4])){
					echo '<hr class="g-brd-gray-light-v4"><h3 class="h5 g-color-gray-dark-v1 g-mb-10">Responsibilities</h3><div class="g-mb-20"><ul id="responsibility">';
					foreach(explode("\n",$array[4]) as $x){
						if(empty($x) or $x == '' or $x == ' '){
							continue;
						}
						echo '<li>';
						echo $x;
						echo '</li>';
					}
					echo '</ul></div>';
				}
				if (!empty($array[5])){
					echo '<h3 class="h5 g-color-gray-dark-v1 g-mb-10">Qualifications</h3><div class="g-mb-20"><ul id="qualification">';
					foreach(explode("\n",$array[5]) as $x){
						if(empty($x) or $x == '' or $x == ' '){
							continue;
						}
						echo '<li>';
						echo $x;
						echo '</li>';
					}
					echo '</ul></div>';
				}
				echo '</article></div></div></div><br><br></form>';
		?>
	</section>
	<!-- End Jobs Description -->

	<hr class="g-brd-gray-light-v4 my-0">

	<!-- Footer -->
	<footer id="contact-section" class="container" style="font-size:1rem">
		<div class="row g-pt-80">
			<div class="col-sm-6 col-lg g-mb-50">
				<h3 class="text-uppercase g-font-weight-500 g-font-size-13 mb-3">About</h3>

				<!-- Links -->
				<ul class="list-unstyled">
					<li class="g-py-6"><a class="u-link-v5 g-color-text" href="http://evolversgroup.com/about.html">About</a></li>
				</ul>
				<!-- End Links -->
			</div>

			<div class="col-sm-6 col-lg g-mb-50">
				<h3 class="text-uppercase g-font-weight-500 g-font-size-13 mb-3">Useful Links</h3>
				<!-- Links -->
				<ul class="list-unstyled">
					<li class="g-py-6"><a class="u-link-v5 g-color-text" href="http://evolversgroup.com/crm/index.php?action=Login&module=Users">CRM</a></li>
					<li class="g-py-6"><a class="u-link-v5 g-color-text" href="http://webmail.evolversgroup.com/">Email</a></li>

				</ul>
				<!-- End Links -->
			</div>

			<div class="col-sm-6 col-lg g-mb-50">
				<h3 class="text-uppercase g-font-weight-500 g-font-size-13 mb-3">Career</h3>

				<!-- Links -->
				<ul class="list-unstyled">
					<li class="g-py-6"><a class="u-link-v5 g-color-text" href="http://evolversgroup.com/careers.php">Jobs</a></li>
				</ul>
				<!-- End Links -->
			</div>

			<div class="col-sm-6 col-lg g-mb-50">
				<h3 class="text-uppercase g-font-weight-500 g-font-size-13 mb-3"><a href="contact_us.html" style="color:#12222d;">Contact Us</a></h3>

				<address class="g-bg-no-repeat g-font-size-12 mb-0">
					<!-- Location -->
					<div class="d-flex g-mb-20">
						<div class="g-mr-10">
							<span class="u-icon-v3 u-icon-size--xs g-color-text">
								<i class="fa fa-map-marker"></i>
							</span>
						</div>
						<p class="mb-0">HQ: Flower Mound (TX)
							<br>AZ: Tempe
							<br>CA: Fremont
							<br>DC Area: Arlington (VA)
							<br>NC: Charlotte
							<br>NJ: Jersey City
							<br>TX: Austin, Fort Worth</p>
						</div>
						<!-- End Location -->

						<!-- Phone -->
						<div class="d-flex g-mb-20">
							<div class="g-mr-10">
								<span class="u-icon-v3 u-icon-size--xs g-color-text">
									<i class="fa fa-phone"></i>
								</span>
							</div>
							<p class="mb-0">(214) 224-0866</p>
						</div>
						<!-- End Phone -->

						<!-- Email and Website -->
						<div class="d-flex g-mb-20">
							<div class="g-mr-10">
								<span class="u-icon-v3 u-icon-size--xs g-bg-black-opacity-0_1 g-color-black-opacity-0_6">
									<i class="fa fa-globe"></i>
								</span>
							</div>
							<p class="mb-0">
								<a class="u-link-v5 g-color-text">info at evolversgroup.com</a>
								<br>
								<a class="u-link-v5 g-color-text" href="https://www.evolversgroup.com">www.evolversgroup.com</a>
							</p>
						</div>
						<!-- End Email and Website -->
					</address>

				</div>
				<div class="col-sm-6 col-lg g-mb-50">
					<h3 class="text-uppercase g-font-weight-500 g-font-size-13 mb-3">Stay in Touch</h3>

					<!-- Social Icons -->
					<ul class="list-inline mb-0">
						<li class="list-inline-item g-mx-2">
							<a class="u-icon-v3 g-width-35 g-height-35 g-color-main g-bg-secondary g-color-white--hover g-bg-primary--hover g-font-size-13 rounded-circle" href="https://twitter.com/evolversgroup">
								<i class="fa fa-twitter"></i>
							</a>
						</li>
					</ul>
					<!-- End Social Icons -->
				</div>
			</div>

			<hr class="g-brd-secondary-light-v1 my-0">

			<!-- Copyright -->
			<div class="row align-items-center g-py-35">
				<div class="col-4">
					<a class="g-text-underline--none--hover" href="index.html">
						<img class="g-width-70" src="https://evolversgroup.com/assets/img/evolvers_logo.png" alt="Evolvers Group">
					</a>
				</div>
				<div class="col-8 text-right">
					<p class="g-font-size-13 mb-0">&copy; 2020 The Evolvers Group. All Rights Reserved.</p>
				</div>
			</div>
			<!-- End Copyright -->
		</footer>
		<!-- End Footer -->

		<a class="js-go-to u-go-to-v1" href="#" data-type="fixed" data-position='{
			"bottom": 15,
			"right": 15
		}' data-offset-top="400" data-compensation="#js-header" data-show-effect="zoomIn">
		<i class="hs-icon hs-icon-arrow-top"></i>
	</a>
</main>

<div class="u-outer-spaces-helper"></div>


<!-- JS Global Compulsory -->
<script src="../assets/vendor/jquery/jquery.min.js"></script>
<script src="../assets/vendor/jquery-migrate/jquery-migrate.min.js"></script>
<script src="../assets/vendor/popper.js/popper.min.js"></script>
<script src="../assets/vendor/bootstrap/bootstrap.min.js"></script>


<!-- JS Implementing Plugins -->
<script src="../assets/vendor/hs-megamenu/src/hs.megamenu.js"></script>
<script src="../assets/vendor/appear.js"></script>
<script src="../assets/vendor/gmaps/gmaps.min.js"></script>

<!-- JS Unify -->
<script src="../assets/js/hs.core.js"></script>
<script src="../assets/js/helpers/hs.hamburgers.js"></script>
<script src="../assets/js/components/hs.header.js"></script>
<script src="../assets/js/components/hs.tabs.js"></script>
<script src="../assets/js/components/hs.rating.js"></script>
<script src="../assets/js/components/gmap/hs.map.js"></script>
<script src="../assets/js/components/hs.progress-bar.js"></script>
<script src="../assets/js/components/hs.go-to.js"></script>
<script src="../assets/vendor/hs-megamenu/src/hs.megamenu.js"></script>


<!-- JS Customization -->
<script src="../assets/js/custom.js"></script>

<!-- JS Plugins Init. -->
<script>
// initialization of google map
function initMap() {
	$.HSCore.components.HSGMap.init('.js-g-map');
}

$(document).on('ready', function () {
	// initialization of tabs
	$.HSCore.components.HSTabs.init('[role="tablist"]');

	// initialization of go to
	$.HSCore.components.HSGoTo.init('.js-go-to');

	// initialization of rating
	$.HSCore.components.HSRating.init($('.js-rating'), {
		spacing: 2
	});
});

$(window).on('load', function () {
	let title = document.getElementById("title").innerText;
	title = title.substring(7, title.length);
	sessionStorage.setItem("title", title);
	let location = document.getElementById("location").innerText;
	location = location.substring(10, location.length);
	sessionStorage.setItem("location", location);
	if(document.getElementById("type").innerText){
		let type = document.getElementById("type").innerText;
		type = type.substring(1, type.length);
		sessionStorage.setItem("type", type);
	}
	else{
		sessionStorage.setItem("type", "");
	}
	console.log("Hi");
	if (document.getElementById("jobs_description")){
		let jobs_description = document.getElementById("jobs_description").innerText;
		console.log(jobs_description);
		sessionStorage.setItem("jobs_description", jobs_description);
	}
	else {
		sessionStorage.setItem("jobs_description", "");
	}
	if(document.getElementById("responsibility")){
		let responsibility = document.getElementById("responsibility").innerText;
		sessionStorage.setItem("responsibility", responsibility);
	}
	else{
		sessionStorage.setItem("responsibility", "");
	}
	if(document.getElementById("qualification")){
		let qualification = document.getElementById("qualification").innerText;
		sessionStorage.setItem("qualification", qualification);
	}
	else{
		sessionStorage.setItem("qualification", "");
	}
	<?php
	echo 'sessionStorage.setItem("status_radio", "';
	echo $array[6];
	echo '" );';
	?>
	<?php
	echo 'sessionStorage.setItem("user", "';
	echo $array[7];
	echo '" );';
	?>
	console.log(sessionStorage);
	// initialization of header
	$.HSCore.components.HSHeader.init($('#js-header'));
	$.HSCore.helpers.HSHamburgers.init('.hamburger');

	// initialization of HSMegaMenu component
	$('.js-mega-menu').HSMegaMenu({
		event: 'hover',
		pageContainer: $('.container'),
		breakpoint: 991
	});

	// initialization of horizontal progress bars
	setTimeout(function () { // important in this case
		var horizontalProgressBars = $.HSCore.components.HSProgressBar.init('.js-hr-progress-bar', {
			direction: 'horizontal',
			indicatorSelector: '.js-hr-progress-bar-indicator'
		});
	}, 1);
});

$(window).on('resize', function () {
	setTimeout(function () {
		$.HSCore.components.HSTabs.init('[role="tablist"]');
	}, 200);
});
</script>

</body>

</html>
<?
}
?>
