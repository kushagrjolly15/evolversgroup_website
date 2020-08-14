<?
session_start();


if(isset($_POST['Login']))
    {
        func();
    }
else{
  show();
}
    function func()
    {
      $username = $_POST['username'];
      $password = $_POST['password'];
      if ($username == "admin" and $password == "evolversgroup"){
        // session_register("username");
        $_SESSION['login_user'] = $username;
        header("Location: https://evolversgroup.com/admin/report.php");
        exit;
      }
      else{
        $errorMsg = "Incorrect Username and/or Password. Plese check and try again.";
        show($errorMsg);
      }

    }
function show($errorMsg = NULL)
{

  ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Title -->
  <title>Evolvers Group</title>

  <!-- Required Meta Tags Always Come First -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta http-equiv="x-ua-compatible" content="ie=edge">

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
  <link  rel="stylesheet" href="../assets/vendor/animate.css">
  <link  rel="stylesheet" href="../assets/vendor/custombox/custombox.min.css">
  <link rel="stylesheet" href="../assets/vendor/hs-megamenu/src/hs.megamenu.css">

  <!-- <link rel="stylesheet" href="../assets/vendor/fancybox/jquery.fancybox.css"> -->

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


    <!-- Login -->
    <section class="g-bg-gray-light-v5 g-py-50">
      <div class="container g-py-100">
      <div class="row justify-content-center">
        <div class="col-sm-8 col-lg-5">
          <div class="g-brd-around g-brd-gray-light-v4 rounded g-py-40 g-px-30">
            <header class="text-center mb-4">
              <h2 class="h2 g-color-black g-font-weight-600">Login</h2>
            </header>
            <?
              if (!empty($errorMsg)){
                echo "<h6 style='color:red;'>";
                echo $errorMsg;
                echo "</h6>";
              }
            ?>
            <!-- Form -->
            <form class="g-py-15" action="login.php" method="post">
              <div class="mb-4">
                <label class="g-color-gray-dark-v2 g-font-weight-600 g-font-size-13">Email:</label>
                <input class="form-control g-color-black g-bg-white g-bg-white--focus g-brd-gray-light-v4 g-brd-primary--hover rounded g-py-15 g-px-15" type="text" name="username" placeholder="Username">
              </div>

              <div class="g-mb-35">
                <div class="row justify-content-between">
                  <div class="col align-self-center">
                    <label class="g-color-gray-dark-v2 g-font-weight-600 g-font-size-13">Password:</label>
                  </div>
                </div>
                <input class="form-control g-color-black g-bg-white g-bg-white--focus g-brd-gray-light-v4 g-brd-primary--hover rounded g-py-15 g-px-15 mb-3" type="password" name="password" placeholder="Password">
                <div class="row justify-content-between">
                  <div class="col-8 align-self-center">
                    <label class="form-check-inline u-check g-color-gray-dark-v5 g-font-size-13 g-pl-25 mb-0">
                      <input class="g-hidden-xs-up g-pos-abs g-top-0 g-left-0" type="checkbox">
                      <div class="u-check-icon-checkbox-v6 g-absolute-centered--y g-left-0">
                        <i class="fa" data-check-icon="&#xf00c;"></i>
                      </div>
                      Keep signed in
                    </label>
                  </div>
                  <div class="col-4 align-self-center text-right">
                    <input class="btn btn-md u-btn-primary rounded g-py-13 g-px-25" type="submit" name="Login" value="Login" />
                  </div>
                </div>
              </div>
            </form>
            <!-- End Form -->
          </div>
        </div>
      </div>
    </div>
    </section>
    <!-- End Login -->

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
<script src="../assets/js/components/hs.modal-window.js"></script>


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
</body>
</html>
<?
}
?>
