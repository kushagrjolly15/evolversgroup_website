<?
	include("assets/php/jobs.php");
	show();
	function show()
	{
		$dbObject = new Database();
		$db=$dbObject->getConnection();
		if (!$db){
			error_log('db didnt connect');
		}
		else {
			$results = $db->query("SELECT * FROM jobs where status='Active' order by date_posted DESC") or onError($db, "Getting records from job Detail is Aborted");
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

  <!-- Favicon -->
  <link rel="shortcut icon" href="assets/img/favicon.png">

  <!-- Google Fonts -->
  <!-- <link rel="stylesheet" href="//fonts.googleapis.com/css?family=Roboto:300,400,500,700"> -->

  <!-- CSS Global Compulsory -->
  <link rel="stylesheet" href="assets/vendor/bootstrap/bootstrap.min.css">
  <link rel="stylesheet" href="assets/vendor/icon-awesome/css/font-awesome.min.css">
  <link rel="stylesheet" href="assets/vendor/icon-line-pro/style.css">

  <!-- CSS Implementing Plugins -->
  <!-- <link rel="stylesheet" href="assets/vendor/icon-awesome/css/font-awesome.min.css"> -->
  <link rel="stylesheet" href="assets/vendor/icon-hs/style.css">
  <link rel="stylesheet" href="assets/vendor/hamburgers/hamburgers.min.css">
  <link rel="stylesheet" href="assets/vendor/dzsparallaxer/dzsparallaxer.css">
  <link rel="stylesheet" href="assets/vendor/slick-carousel/slick/slick.css">
  <link rel="stylesheet" href="assets/vendor/cubeportfolio-full/cubeportfolio/css/cubeportfolio.min.css">
  <link  rel="stylesheet" href="assets/vendor/animate.css">
  <link  rel="stylesheet" href="assets/vendor/custombox/custombox.min.css">
  <link rel="stylesheet" href="assets/vendor/hs-megamenu/src/hs.megamenu.css">

  <!-- <link rel="stylesheet" href="assets/vendor/fancybox/jquery.fancybox.css"> -->

  <link rel="stylesheet" href="assets/css/unify-core.css">
  <link rel="stylesheet" href="assets/css/unify-components.css">
  <link rel="stylesheet" href="assets/css/unify-globals.css">

  <!-- CSS Template -->
  <link rel="stylesheet" href="assets/css/styles.op-corporate.css">

  <!-- CSS Customization -->
  <link rel="stylesheet" href="assets/css/custom.css">
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
              <img src="assets/img/evolvers_logo.png" alt="evolvers_logo">
            </a>
            <!-- End Logo -->

            <!-- Navigation -->
            <div class="collapse navbar-collapse align-items-center flex-sm-row g-pt-10 g-pt-5--lg" id="navBar">
              <ul class="navbar-nav ml-auto text-uppercase g-pt-40 g-pb-40 u-sub-menu-v3">
                <li class="nav-item g-mx-15--lg g-mb-7 g-mb-0--lg">
                  <a href="index.html" class="nav-link p-0">Home

              </a>
                </li>
                <li class="nav-item g-mx-15--lg g-mb-7 g-mb-0--lg">
                  <a href="about.html" class="nav-link p-0">About

              </a>
                </li>

                <li class="nav-item hs-has-sub-menu g-mx-2--md g-mx-5--xl g-mb-5 g-mb-0--lg g-mx-15--lg g-mb-7 g-mb-0--lg">
                  <a href="services.html" class="nav-link p-0" id="nav-link-1" aria-haspopup="true" aria-expanded="false" aria-controls="nav-submenu-1">Services

              </a>
                  <!-- Submenu -->
                  <ul class="hs-sub-menu list-unstyled" id="nav-submenu-1" aria-labelledby="nav-link-1">
                    <li class="hs-has-sub-menu">
                      <a href="services.html#audit" id="nav-link-2" aria-haspopup="true" aria-expanded="false" aria-controls="nav-submenu-2">Strategy and Architecture</a>
                      <ul class="hs-sub-menu" id="nav-submenu-2" aria-labelledby="nav-link-2">
                        <li class="dropdown-item">
                          <a href="services.html#audit">Assessments and Audit</a>
                        </li>
                        <li class="dropdown-item">
                          <a href="services.html#recommendations">Recommendations</a>
                        </li>
                        <li class="dropdown-item">
                          <a href="services.html#process-improvements">Process Improvements</a>
                        </li>
                        <li class="dropdown-item">
                          <a href="services.html#technology-roadmaps">Roadmaps and Blueprints</a>
                        </li>
                        <li class="dropdown-item">
                          <a href="services.html#solution-architecture">Solution Architecture</a>
                        </li>
                      </ul>
                    </li>
                    <li class="hs-has-sub-menu">
                      <a href="services.html#business-analytics" id="nav-link-3" aria-haspopup="true" aria-expanded="false" aria-controls="nav-submenu-3">Data Science
                  </a>
                      <!-- Submenu (level 2) -->
                      <ul class="hs-sub-menu list-unstyled" id="nav-submenu-3" aria-labelledby="nav-link-3">
                        <li class="dropdown-item">
                          <a href="services.html#business-analytics">Business Analytics</a>
                        </li>
                        <li class="dropdown-item">
                          <a href="services.html#data-science">Data Science</a>
                        </li>
                        <li class="dropdown-item">
                          <a href="services.html#data-visualization">Data Visualization</a>
                        </li>
                        <li class="dropdown-item">
                          <a href="services.html#data-warehousing">Data Warehousing</a>
                        </li>
                      </ul>
                      <!-- End Submenu (level 2) -->
                    </li>
                    <li class="hs-has-sub-menu">
                      <a href="services.html#pmo" id="nav-link-4" aria-haspopup="true" aria-expanded="false" aria-controls="nav-submenu-4">Project Management</a>
                      <!-- Submenu (level 2) -->
                      <ul class="hs-sub-menu list-unstyled" id="nav-submenu-4" aria-labelledby="nav-link-4">
                        <li class="dropdown-item">
                          <a href="services.html#pmo">PMO</a>
                        </li>
                        <li class="dropdown-item">
                          <a href="services.html#agile-transformation">Agile Transformation</a>
                        </li>
                      </ul>
                      <!-- End Submenu (level 2) -->
                    </li>
                    <li class="hs-has-sub-menu">
                      <a href="services.html#erp" id="nav-link-5" aria-haspopup="true" aria-expanded="false" aria-controls="nav-submenu-5">Solutions</a>
                      <!-- Submenu (level 2) -->
                      <ul class="hs-sub-menu list-unstyled" id="nav-submenu-5" aria-labelledby="nav-link-5">
                        <li class="dropdown-item">
                          <a href="services.html#erp">ERP</a>
                        </li>
                        <li class="dropdown-item">
                          <a href="services.html#gis">GIS</a>
                        </li>
                      </ul>
                      <!-- End Submenu (level 2) -->
                    </li>
                    <li class="hs-has-sub-menu">
                      <a href="services.html#healthcare-it" id="nav-link-6" aria-haspopup="true" aria-expanded="false" aria-controls="nav-submenu-6">Healthcare</a>
                      <!-- Submenu (level 2) -->
                      <ul class="hs-sub-menu list-unstyled" id="nav-submenu-6" aria-labelledby="nav-link-6">
                        <li class="dropdown-item">
                          <a href="services.html#healthcare-it">Healthcare IT</a>
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
                  <a href="practices.html" class="nav-link p-0 ">Practices

              </a>
                </li>
                <li class="nav-item g-mx-15--lg g-mb-7 g-mb-0--lg">
                  <a href="contracts.html" class="nav-link p-0">Contracts

              </a>
                </li>
                <li class="nav-item g-mx-15--lg g-mb-7 g-mb-0--lg">
                  <a href="careers.php" class="nav-link p-0 ">Jobs

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
  <div class="divimage dzsparallaxer--target w-100" style="height: 115%; background-image: url(assets/img/1.jpg);"></div>

  <div class="g-absolute-centered--y g-bg-cover__inner w-100">
    <div class="container g-pos-rel g-z-index-1 g-mt-50--md">
      <div class="row align-items-center">
        <div class="col-sm-6 col-lg-12">
          <h1 class="g-color-white g-font-weight-300 g-font-size-45 g-mb-30 g-mb-50--sm">Careers</h1>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- End Promo Block -->
<section class="g-bg-gray-light-v5 g-pt-100 g-pb-40">

<div class="container ">
	<!-- <h3 class="g-font-weight-300 g-font-size-45 g-mb-30 g-mb-50--sm">Available Jobs:</h1> -->
  <div class="row justify-content-between">
<!-- Hoverable Rows -->
<div class="table-responsive">
  <table class="table table-hover">
    <thead>
      <tr>
        <th>#</th>
        <th>Date</th>
        <th class="hidden-sm">Available Jobs</th>
        <th>Location</th>
      </tr>
    </thead>
    <tbody id = "tbody">
			<?php
			$flg = 0;

			while ($line = $results->fetch_assoc()){
				// $userObject= new Job($result);
				// $res[]=$userObject;
				$flg = $flg + 1;
				echo '<tr> <td>';
				echo $flg;
				echo '</td> <td>';
				echo date('m-d-Y', strtotime($line["date_posted"]));
				echo '</td> <td><a href="/jobs.php?id=';
				echo $line["id"];
				echo '">';
				echo $line["title"];
				echo '</a></td> <td>';
				echo $line["location"];
				echo '</td> </tr>';
			}
			?>
    </tbody>
  </table>
</div>
<!-- End Hoverable Rows -->
</div>
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
				<li class="g-py-6"><a class="u-link-v5 g-color-text" href="http://evolversgroup.com/admin/login.php">Post Jobs</a></li>
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
            <br>TX: Austin, Fort Worth
						<br>ON: Toronto</p>
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
<script src="assets/vendor/jquery/jquery.min.js"></script>
<script src="assets/vendor/jquery-migrate/jquery-migrate.min.js"></script>
<script src="assets/vendor/popper.js/popper.min.js"></script>
<script src="assets/vendor/bootstrap/bootstrap.min.js"></script>

<!-- JS Implementing Plugins -->
<script src="assets/vendor/appear.js"></script>
<script src="assets/vendor/slick-carousel/slick/slick.js"></script>
<script src="assets/vendor/cubeportfolio-full/cubeportfolio/js/jquery.cubeportfolio.min.js"></script>
<script src="assets/vendor/fancybox/jquery.fancybox.js"></script>
<script src="assets/vendor/dzsparallaxer/dzsparallaxer.js"></script>
<script src="assets/vendor/dzsparallaxer/dzsscroller/scroller.js"></script>
<script src="assets/vendor/dzsparallaxer/advancedscroller/plugin.js"></script>
<script  src="assets/vendor/custombox/custombox.min.js"></script>
<script src="assets/vendor/hs-megamenu/src/hs.megamenu.js"></script>



<!-- JS Unify -->
<script src="assets/js/hs.core.js"></script>
<script src="assets/js/components/hs.header.js"></script>
<script src="assets/js/helpers/hs.hamburgers.js"></script>
<script src="assets/js/components/hs.scroll-nav.js"></script>
<script src="assets/js/components/hs.counter.js"></script>
<script src="assets/js/components/hs.carousel.js"></script>
<script src="assets/js/components/hs.popup.js"></script>
<script src="assets/js/components/hs.cubeportfolio.js"></script>
<script src="assets/js/components/hs.go-to.js"></script>
<script  src="assets/js/components/hs.modal-window.js"></script>


<!-- JS Customization -->
<script src="assets/js/custom.js"></script>

<!-- JS Plugins Init. -->
<script>
$(document).on('ready', function () {
  // $.ajax({
  //       type: "GET",
  //       url: "assets/data.txt",
  //       dataType: "text",
  //       success: function(data) {processData(data);}
  //    });


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

function processData(allText) {
    var allTextLines = allText.split(/\r\n|\n/);
    var lines = [];
    for (var i=0; i<allTextLines.length - 1; i++) {
        var data = allTextLines[i].split(',');
            var tarr = [];
            for (var j=0; j<data.length; j++)
                tarr.push(data[j]);
            lines.push(tarr);
        }
    var tableContent = '';
    $.each(lines, function(k, v){
            tableContent += '<tr>';
            $.each(v, function(key,value){
              if (v.length != 1){
                if (key == v.length - 1){
                  return;
                }
              if (key == v.length - 3){
                tableContent += '<td><a href="'+v[v.length-1]+'">' + value + '</a></td>';
              }
              else{
                tableContent += '<td>' + value + '</td>';
              }
}
            })
            tableContent += '</tr>';
        });
        $('#tbody').html(tableContent);
}

</script>
</body>
</html>
<?
}
?>
