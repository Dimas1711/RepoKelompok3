<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
    <!-- Favicons -->
  <link href="<?php echo base_url("img/favicon.png");?>" rel="icon">
  <link href="<?php echo base_url("img/apple-touch-icon.png");?>" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,400i,600,700|Raleway:300,400,400i,500,500i,700,800,900" rel="stylesheet">

  <!-- Bootstrap CSS File -->
  <link href="<?php echo base_url("lib/bootstrap/css/bootstrap.min.css");?>" rel="stylesheet">

  <!-- Libraries CSS Files -->
  <link href="<?php echo base_url("lib/nivo-slider/css/nivo-slider.css");?>" rel="stylesheet">
  <link href="<?php echo base_url("lib/owlcarousel/owl.carousel.css");?>" rel="stylesheet">
  <link href="<?php echo base_url("lib/owlcarousel/owl.transitions.css");?>" rel="stylesheet">
  <link href="<?php echo base_url("lib/font-awesome/css/font-awesome.min.css");?>" rel="stylesheet">
  <link href="<?php echo base_url("lib/animate/animate.min.css");?>" rel="stylesheet">
  <link href="<?php echo base_url("lib/venobox/venobox.css");?>" rel="stylesheet">

  <!-- Nivo Slider Theme -->
  <link href="<?php echo base_url("css/nivo-slider-theme.css");?>" rel="stylesheet">

  <!-- Main Stylesheet File -->
  <link href="<?php echo base_url("css/style.css");?>" rel="stylesheet">

  <!-- Responsive Stylesheet File -->
  <link href="<?php echo base_url("css/responsive.css");?>" rel="stylesheet">
</head>
<body data-spy="scroll" data-target="#navbar-example">

  <div id="preloader"></div>

    <header>
      <!-- header-area start -->
      <div id="sticker" class="header-area">
        <div class="container">
          <div class="row">
            <div class="col-md-12 col-sm-12">

              <!-- Navigation -->
              <nav class="navbar navbar-default">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                  <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".bs-example-navbar-collapse-1" aria-expanded="false">
                      <span class="sr-only">Toggle navigation</span>
                      <span class="icon-bar"></span>
                      <span class="icon-bar"></span>
                      <span class="icon-bar"></span>
                    </button>
                  <!-- Brand -->
                  <a class="navbar-brand page-scroll sticky-logo" href="index.html">
                    <h1><img src="<?php echo base_url("gambar/Polije.png")?>" alt="" width="50px"><span>Klinik</span>Polije</h1>
                    <!-- Uncomment below if you prefer to use an image logo -->
                    <!-- <img src="img/logo.png" alt="" title=""> -->
                  </a>
                </div>
                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse main-menu bs-example-navbar-collapse-1" id="navbar-example">
                  <ul class="nav navbar-nav navbar-right">
                    <li class="active">
                      <a class="page-scroll" href="#home">Home</a>
                    </li>
                    <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown">Profil<span class="caret"></span></a>
                      <ul class="dropdown-menu" role="menu">
                        <li><a href=# >Data Klinik</a></li>
                        <li><a href=# >Alur Berobat</a></li>
                      </ul> 
                    </li>
                    <li>
                      <a class="page-scroll" href="#about">Fasilitas</a>
                    </li>
                    <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown">User<span class="caret"></span></a>
                      <ul class="dropdown-menu" role="menu">
                        <li><a href=# >Drop Down 1</a></li>
                        <li><a href=# >Drop Down 2</a></li>
                      </ul> 
                    </li>

                    <li>
                      <a class="page-scroll" href="#blog">Login</a>
                    </li>
                  </ul>
                </div>
                <!-- navbar-collapse -->
              </nav>
              <!-- END: Navigation -->
            </div>
          </div>
        </div>
      </div>
      <!-- header-area end -->
    </header>
    <!-- header end -->


    
<!-- Start Slider Area -->
<div id="home" class="slider-area">
    <div class="bend niceties preview-2">
      <div id="ensign-nivoslider" class="slides">
        <img src="<?php echo base_url("img/slider/slider1.jpg");?>" alt="" title="#slider-direction-1" />
        <img src="<?php echo base_url("img/slider/slider2.jpg");?>" alt="" title="#slider-direction-2" />
        <img src="<?php echo base_url("img/slider/slider3.jpg");?>" alt="" title="#slider-direction-3" />
      </div>

      <!-- direction 1 -->
      <div id="slider-direction-1" class="slider-direction slider-one">
        <div class="container">
          <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="slider-content">
                <!-- layer 1 -->
                <div class="layer-1-1 hidden-xs wow slideInDown" data-wow-duration="2s" data-wow-delay=".2s">
                  <h2 class="title1">The Best Business Information </h2>
                </div>
                <!-- layer 2 -->
                <div class="layer-1-2 wow slideInUp" data-wow-duration="2s" data-wow-delay=".1s">
                  <h1 class="title2">We're In The Business Of Helping You Start Your Business</h1>
                </div>
                <!-- layer 3 -->
                <div class="layer-1-3 hidden-xs wow slideInUp" data-wow-duration="2s" data-wow-delay=".2s">
                  <a class="ready-btn right-btn page-scroll" href="#services">See Services</a>
                  <a class="ready-btn page-scroll" href="#about">Learn More</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- direction 2 -->
      <div id="slider-direction-2" class="slider-direction slider-two">
        <div class="container">
          <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="slider-content text-center">
                <!-- layer 1 -->
                <div class="layer-1-1 hidden-xs wow slideInUp" data-wow-duration="2s" data-wow-delay=".2s">
                  <h2 class="title1">The Best Business Information </h2>
                </div>
                <!-- layer 2 -->
                <div class="layer-1-2 wow slideInUp" data-wow-duration="2s" data-wow-delay=".1s">
                  <h1 class="title2">We're In The Business Of Get Quality Business Service</h1>
                </div>
                <!-- layer 3 -->
                <div class="layer-1-3 hidden-xs wow slideInUp" data-wow-duration="2s" data-wow-delay=".2s">
                  <a class="ready-btn right-btn page-scroll" href="#services">See Services</a>
                  <a class="ready-btn page-scroll" href="#about">Learn More</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- direction 3 -->
      <div id="slider-direction-3" class="slider-direction slider-two">
        <div class="container">
          <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="slider-content">
                <!-- layer 1 -->
                <div class="layer-1-1 hidden-xs wow slideInUp" data-wow-duration="2s" data-wow-delay=".2s">
                  <h2 class="title1">The Best business Information </h2>
                </div>
                <!-- layer 2 -->
                <div class="layer-1-2 wow slideInUp" data-wow-duration="2s" data-wow-delay=".1s">
                  <h1 class="title2">Helping Business Security  & Peace of Mind for Your Family</h1>
                </div>
                <!-- layer 3 -->
                <div class="layer-1-3 hidden-xs wow slideInUp" data-wow-duration="2s" data-wow-delay=".2s">
                  <a class="ready-btn right-btn page-scroll" href="#services">See Services</a>
                  <a class="ready-btn page-scroll" href="#about">Learn More</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- End Slider Area -->
















  <!-- JavaScript Libraries -->
  <script src="<?php echo base_url("lib/jquery/jquery.min.js");?>"></script>
  <script src="<?php echo base_url("lib/bootstrap/js/bootstrap.min.js");?>"></script>
  <script src="<?php echo base_url("lib/owlcarousel/owl.carousel.min.js");?>"></script>
  <script src="<?php echo base_url("lib/venobox/venobox.min.js");?>"></script>
  <script src="<?php echo base_url("lib/knob/jquery.knob.js");?>"></script>
  <script src="<?php echo base_url("lib/wow/wow.min.js");?>"></script>
  <script src="<?php echo base_url("lib/parallax/parallax.js");?>"></script>
  <script src="<?php echo base_url("lib/easing/easing.min.js");?>"></script>
  <script src="<?php echo base_url("lib/nivo-slider/js/jquery.nivo.slider.js");?>" type="text/javascript"></script>
  <script src="<?php echo base_url("lib/appear/jquery.appear.js");?>"></script>
  <script src="<?php echo base_url("lib/isotope/isotope.pkgd.min.js");?>"></script>

  <!-- Contact Form JavaScript File -->
  <script src="<?php echo base_url("contactform/contactform.js");?>"></script>

  <script src="<?php echo base_url("js/main.js");?>"></script>
</body>
</html>