<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Website Bootstrap dengan CodeIgniter</title>
    <link rel="stylesheet" href="<?php echo base_url("bootstrap/css/bootstrap.min.css"); ?>" type="text/css">
    <script src="<?php echo base_url("bootstrap/js/jquery.js");?>" type="text/javascript"></script>
    <script type="text/javascript" src="<?php echo base_url("bootstrap/js/bootstrap.min.js");?>"></script>


    <meta property="og:title" content=""/>
	<meta property="og:image" content=""/>
	<meta property="og:url" content=""/>
	<meta property="og:site_name" content=""/>
	<meta property="og:description" content=""/>
	<meta name="twitter:title" content="" />
	<meta name="twitter:image" content="" />
	<meta name="twitter:url" content="" />
    <meta name="twitter:card" content="" />
    <link href="https://fonts.googleapis.com/css?family=Space+Mono" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Kaushan+Script" rel="stylesheet">
	
	<!-- Animate.css -->
	<link rel="stylesheet" href="<?php echo base_url("bootstrap/css/animate.css");?>">
	<!-- Icomoon Icon Fonts-->
	<link rel="stylesheet" href="<?php echo base_url("bootstrap/css/icomoon.css");?>">
	<!-- Bootstrap  -->
	<!-- <link rel="stylesheet" href="<?php echo base_url("bootstrap/css/bootstrap.css");?>"> -->

	<!-- Theme style  -->
	<link rel="stylesheet" href="<?php echo base_url("bootstrap/css/style.css");?>">

	<!-- Modernizr JS -->
	<script src="bootstrap/js/modernizr-2.6.2.min.js"></script>

</head>
<body>
    <nav class="navbar navbar-fixed-top navbar-inverse">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                    <span class="sr-only">Toggle Navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="<?php echo site_url();?>">Pencari Kerja</a>
            </div>
            <div id="navbar" class="collapse navbar-collapse">
                <ul class="nav navbar-nav">
                    <li class="active"><a href="<?php echo site_url();?>">Home</a></li>
                    <li><a href="<?php echo site_url("daftar");?>">Daftar Kerja</a></li>
                    <li><a href="<?php echo site_url("pendaftarkerja");?>">Pendaftar Kerja</a></li>
                    <li><a href="<?php echo site_url("tentang");?>">Tentang</a></li>
                    <li><a href="<?php echo site_url("contact");?>">Contact</a></li>
                </ul>
            </div>
        </div>
    </nav>
</body>
</html>