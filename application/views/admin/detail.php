<!DOCTYPE html>
<html lang="en">
<head>
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style type="text/css">
       
        .warna{
          background-color: blue;
        }
    
      </style>
    <title>Document</title>
     <!--Import materialize.css-->
     <link type="text/css" rel="stylesheet" href="<?php echo base_url('assets') ?>/user/css/materialize.min.css"  media="screen,projection"/>

<!-- my css -->
<link type="text/css" rel="stylesheet" href="<?php echo base_url('assets') ?>/user/css/style.css">
</head>

<body id="home" class="scrollspy">
<body>
<div class="navbar-fixed">
    <nav class="warna">
        <div class="logo">
            <div class="container">
                <div class="nav-wrapper">
                    <div class="text-darken-3">
                    <?php foreach($identitas as $idn) : ?>
                  <a href="" class="brand-logo"><!-- <img src="img/logo/dnbs.png"> -->
                    <?php echo $idn->judul_website; ?>
                  </a>
                <?php endforeach; ?>

                        <a href="#" data-target="mobile-nav" class="sidenav-trigger">
                            <i class="material-icons">menu</i>
                        </a>
                        <ul class="right hide-on-med-and-down">
                            <li><a class="list" href="<?php echo base_url('user/index/#about'); ?>">Pemerintah Desa</a></li>
                            <li><a class="list" href="<?php echo base_url('user/index/#fasilitas'); ?>">Fasilitas</a></li>
                            <li><a class="list" href="<?php echo base_url('user/index/#sistem'); ?>">Sistem Kegiatan</a></li>
                            <li><a class="list" href="<?php echo base_url('user/index/#portofolio'); ?>">Portofolio</a></li>
                            <li><a class="list" href="<?php echo base_url('user/index/#contact'); ?>">Kontak</a></li>
                            <li><a href="<?php echo base_url('login'); ?>">Login</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </nav>
</div>  <!-- sidenav mobile nav-->
      <ul class="sidenav" id="mobile-nav">
        <li><a href="<?php echo base_url('user/index/#about'); ?>">Pemerintah Desa</a></li>
        <li><a href="<?php echo base_url('user/index/#fasilitas'); ?>">Fasilitas</a></li>
        <li><a href="<?php echo base_url('user/index/#sistem'); ?>">Sistem Kegiatan</a></li>
        <li><a href="<?php echo base_url('user/index/#portofolio'); ?>">Portofolio</a></li>
        <li><a href="<?php echo base_url('user/index/#contact'); ?>">Kontak</a></li>
        <li><a href="<?php echo base_url('login'); ?>">Login</a></li>
      </ul>


      
<section id="detail" class="contact grey lighten-3 scrollspy">
    <div class="container">
        <h3 class="center light grey-text text-darken-3"><?php echo $kegiatan->judul; ?></h3>
        <div class="row">
            <div class="col s12">
                <!-- Gambar Kegiatan -->
                <div class="image-container center">
                    <img src="<?php echo base_url('assets/user/img/'.$kegiatan->gambar); ?>" class="responsive-img" alt="Gambar Kegiatan">
                </div>
                
                <!-- Isi Kegiatan -->
                <div class="content">
                    <p><?php echo $kegiatan->isi; ?></p>
                </div>
            </div>
        </div>
        <div class="center">
            <a href="<?php echo base_url('user/index'); ?>" class="btn blue darken-2">Kembali</a>
        </div>
    </div>
</section>
   <!--JavaScript at end of body for optimized loading-->
   <script type="text/javascript" src="<?php echo base_url('assets') ?>/user/js/materialize.min.js"></script>

<!-- sidenav -->
<script>
  const sideNav = document.querySelectorAll('.sidenav');
  M.Sidenav.init(sideNav);



</script>
<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
      <script type="text/javascript">
    $(document).ready(function(){
          $('ul li a').click(function(){
            $('li a').removeClass("active");
            $(this).addClass("active");
        });
    });
</script>
</body>
</html>