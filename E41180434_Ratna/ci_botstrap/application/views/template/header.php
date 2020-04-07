<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Website Bootstrap dengan CodeIgniter</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <!--<link href="<?php echo base_url("assets/css/bootstrap.min.css"); ?>" rel="stylesheet" type="text/css"> -->
    <script type="text/javascript" src="<?php echo ("assets/js/jquery-3.2.1.min.js"); ?>"></script>
    <script type="text/javascript" src="<?php echo ("assets/js/bootstrap.min.js"); ?>"></script>
</head>
<body>
    <nav class="navbar navbar-fixed-top navbar-inverse">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="<?php echo site_url(); ?>">Pencari Kerja</a>
                </div>
                <div id="navbar" class="collapse navbar-collapse">
                    <ul class="nav navbar-nav">
                        <li><a href="<?php echo site_url(); ?>">Home</a></li>
                        <li><a href="<?php echo site_url("daftar"); ?>">Daftar Kerja</a></li>
                        <li><a href="<?php echo site_url("pendaftarkerja"); ?>">Pendaftar Kerja</a></li>
                        <li><a href="<?php echo site_url("tentang"); ?>">Tentang</a></li>
                        <li><a href="<?php echo site_url("contact"); ?>">Contact</a></li>
                    </ul>
                </div> <!-- /.nav-collapse -->
            </div> <!-- /.container -->
        </div>
    </nav>
<br>
<br>
</body>
</html>
