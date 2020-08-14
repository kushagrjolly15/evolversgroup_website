<?php session_start(); ?>
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
  else{
    if (isset($_GET['id'])) {
      $id = $_GET['id'];
      $results = $db->query("SELECT * FROM jobs where id=$id") or onError($db, "Getting records from job Detail is Aborted");

    }
     else {
      $results = $db->query("SELECT * FROM jobs order by date_posted desc") or onError($db, "Getting records from job Detail is Aborted");
    }
  }
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
    <link rel="stylesheet" href="assets/vendor/bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="assets/vendor/icon-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/vendor/icon-line/css/simple-line-icons.css">
    <link rel="stylesheet" href="assets/vendor/icon-hs/style.css">
    <link rel="stylesheet" href="assets/vendor/animate.css">
    <link rel="stylesheet" href="assets/vendor/hs-megamenu/src/hs.megamenu.css">
    <link rel="stylesheet" href="assets/vendor/hamburgers/hamburgers.min.css">
    <link  rel="stylesheet" href="assets/vendor/custombox/custombox.min.css">

    <!-- CSS Unify -->
    <link rel="stylesheet" href="assets/css/unify-core.css">
    <link rel="stylesheet" href="assets/css/unify-components.css">
    <link rel="stylesheet" href="assets/css/unify-globals.css">
    <link rel="stylesheet" href="assets/css/styles.op-corporate.css">

    <!-- CSS Customization -->
    <link rel="stylesheet" href="/assets/css/custom.css">
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
        if (isset($_SESSION['success_message'])) {
          echo '<div class="alert alert-dismissible fade show g-bg-teal g-color-white rounded-0" role="alert">
        <button type="button" class="close u-alert-close--light" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>

        <div class="media">
          <span class="d-flex g-mr-10 g-mt-5">
            <i class="icon-check g-font-size-25"></i>
          </span>
          <span class="media-body align-self-center">';
          echo $_SESSION['success_message'];
          echo'</span>
        </div>
      </div>';
          unset($_SESSION['success_message']);
        }
        $flg = 0;
        if ($results) {
          while ($line = $results->fetch_assoc()){
            // $userObject= new Job($result);
            // $res[]=$userObject;
            $flg = $flg + 1;
            echo '<div class="container"><div class="row"><div class="col-lg-12 g-mb-30 g-mb-0--lg">
            <a href="/admin/report.php" style="float:right;background-color:blue;color:white;" class="u-tags-v1 g-font-size-16 g-brd-around g-brd-gray-light-v3 g-bg-blue-v2--hover g color-white--hover rounded g-py-3 g-px-8">Back</a>

            </div></div><div class="row g-py-20"><div class="col-lg-12 g-mb-30 g-mb-0--lg"><article class="u-shadow-v11 rounded g-pa-30"><div class="row"><div class="col-md-9 g-mb-30 g-mb-0--md"><div class="media"><div class="media-body"><span class="d-block g-mb-3"><a id = "title" name = "title" class="u-link-v5 g-font-size-18 g-color-gray-dark-v1 g-color-primary--hover">Title: ';
            echo $line["title"];
            echo '</a></span>';
            echo '<br><span class="g-font-size-13 g-color-gray-dark-v4 g-mr-15"><i class="icon-location-pin g-pos-rel g-top-1 mr-1"></i>Location: ';
            echo $line["location"];
            echo '</span>';
            if (!empty($line["job_type"])){
              echo '<span class="g-font-size-13 g-color-gray-dark-v4 g-mr-15">
                  <i class="icon-directions g-pos-rel g-top-1 mr-1"></i>';
              echo $line["job_type"];
              echo '</span>';
            }
            echo '</div></div></div><div class="col-md-3 align-self-center text-md-right"><a id="apply_now" href="/jobs.php?id=';
            echo $line['id'];
            echo '" class="u-tags-v1 g-font-size-16 g-color-main g-brd-around g-brd-gray-light-v3 g-bg-blue-v2--hover g color-white--hover rounded g-py-3 g-px-8">Apply Now</a>
            </div></div>';
            echo '<hr class="g-brd-gray-light-v4">';
            if (!empty($line["job_description"])){
              echo '<h3 class="h5 g-color-gray-dark-v1 g-mb-10">Jobs Description</h3><p>';
              foreach(explode("\n",$line["job_description"]) as $x){
    						if(empty($x) or $x == '' or $x == ' '){
    							continue;
    						}
    						echo $x;
    						echo '<br>';
    					}
              echo '</p>';
            }
            if (!empty($line['responsibility'])){
              echo '<hr class="g-brd-gray-light-v4"><h3 class="h5 g-color-gray-dark-v1 g-mb-10">Responsibilities</h3><div class="g-mb-20"><ul>';
              foreach(explode("\n",$line['responsibility']) as $x){
                if(empty($x) or $x == '' or $x == ' '){
    							continue;
    						}
                echo '<li>';
                echo $x;
                echo '</li>';
              }
              echo '</ul></div>';
            }
            if (!empty($line['qualification'])){
              echo '<h3 class="h5 g-color-gray-dark-v1 g-mb-10">Qualifications</h3><div class="g-mb-20"><ul>';
              foreach(explode("\n",$line['qualification']) as $x){
                if(empty($x) or $x == '' or $x == ' '){
    							continue;
    						}
                echo '<li>';
                echo $x;
                echo '</li>';
              }
              echo '</ul></div>';
            }
            echo '</article></div></div></div><br><br>';

          }
        }
        else{
          echo '<div class="container g-pt-100 g-pb-40">
          <div class="row">
          <div class="col-lg-12 g-mb-60">
          <div class="mb-4">
          <h2 class="h3 text-uppercase mb-3">No Open Position</h2>
          <div class="g-width-60 g-height-1 g-bg-black"></div>
          </div>
          <div class="mb-5">
          <p>
          Please Come Back Later
          </p>
          </div>
          </div>
          </div>
          </div>';
        }
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

      <a class="js-go-to u-go-to-v1" href="#" data-type="fixed" data-position='{
        "bottom": 15,
        "right": 15
      }' data-offset-top="400" data-compensation="#js-header" data-show-effect="zoomIn">
      <i class="hs-icon hs-icon-arrow-top"></i>
    </a>
  </main>

  <div class="u-outer-spaces-helper"></div>


  <!-- JS Global Compulsory -->
  <script src="assets/vendor/jquery/jquery.min.js"></script>
  <script src="assets/vendor/jquery-migrate/jquery-migrate.min.js"></script>
  <script src="assets/vendor/popper.js/popper.min.js"></script>
  <script src="assets/vendor/bootstrap/bootstrap.min.js"></script>


  <!-- JS Implementing Plugins -->
  <script src="assets/vendor/hs-megamenu/src/hs.megamenu.js"></script>
  <script src="assets/vendor/appear.js"></script>
  <script src="assets/vendor/gmaps/gmaps.min.js"></script>

  <!-- JS Unify -->
  <script src="assets/js/hs.core.js"></script>
  <script src="assets/js/helpers/hs.hamburgers.js"></script>
  <script src="assets/js/components/hs.header.js"></script>
  <script src="assets/js/components/hs.tabs.js"></script>
  <script src="assets/js/components/hs.rating.js"></script>
  <script src="assets/js/components/gmap/hs.map.js"></script>
  <script src="assets/js/components/hs.progress-bar.js"></script>
  <script src="assets/js/components/hs.go-to.js"></script>
  <script src="assets/vendor/hs-megamenu/src/hs.megamenu.js"></script>
  <script src="assets/js/components/hs.modal-window.js"></script>
  <script  src="assets/vendor/custombox/custombox.min.js"></script>
  <!-- JS Customization -->
  <script src="assets/js/custom.js"></script>

  <!-- JS Plugins Init. -->
  <script>

  // initialization of google map
  function initMap() {
    $.HSCore.components.HSGMap.init('.js-g-map');
  }

  $(document).on('ready', function () {

    // initialization of popups
    $.HSCore.components.HSModalWindow.init('[data-modal-target]');

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
