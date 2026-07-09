<?php
require_once __DIR__ . '/config.php';
header("Content-Type: text/html; charset=utf-8");
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <!-- Required meta tags -->
    <meta charset="ISO-8859-1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <!--meta charset="utf-8"-->

    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Actualit&eacutes</title>
    <link rel="icon" href="assets/images/Li.png" sizes="32x32" type="image/png">

    <!-- Template CSS -->
    <link rel="stylesheet" href="assets/css/style-starter.css">
    <link href="assets/css/responsive.css" rel="stylesheet">
    <link href="assets/css/animate.min.css" rel="stylesheet"> 
    <link href="assets/css/lightbox.css" rel="stylesheet"> 
    <link href="assets/css/bootstrap.min.css" rel="stylesheet"> 


    <!-- font awesome -->
  <link href="assets/css/font-awesome.min.css" rel="stylesheet">
  <script src="https://kit.fontawesome.com/adaf660447.js" crossorigin="anonymous"></script>

    <!-- google fonts -->
  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300&display=swap" rel="stylesheet">


</head> 

<body>
    <!-- inner page header -->
     <div class="inner-banner">
        <header>
        <div class="w3l-header inner-w3l-header" id="home">
            <div class="container">
                <nav class="navbar navbar-expand-lg navbar-dark pl-0 pr-0">
                    <div class="logo"><a class="navbar-brand m-0 text-primary" href="index.html"><img src="assets/images/Sans titre-2.png" alt="logo"> </a></div> 

                     <!-- <span class="logo">portfolio</span>-->
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarNav">
                        <ul class="navbar-nav ml-auto">
                            
                            <li class="nav-item  mr-lg-4">
                        <a class="nav-link pl-0 pr-0 font-weight-bold" href="about.html">BICLINK</a>
                        <ul class="dropdown">
                          <li><a href="about.html">Mieux nous connaître</a></li>
                          <li><a href="about.html#notremission">Notre mission</a></li>
                          <li><a href="about.html#VALEURS">Nos valeurs</a></li>
                        </ul>
                    </li>
                    <li class="nav-item mr-lg-4">
                        <a class="nav-link pl-0 pr-0 font-weight-bold" href="offre.html">Offre</a>
                    </li>

                    <li class="nav-item mr-lg-4">
                        <a class="nav-link pl-0 pr-0 font-weight-bold" href="expertise.html">Expertise</a>
                    </li>
                                        
                    <li class="nav-item mr-lg-4">
                        <a class="nav-link pl-0 pr-0 font-weight-bold" href="référence.html">R&eacutef&eacuterences</a>
                    </li>
                    <li class="nav-item mr-lg-4">
                        <a class="nav-link pl-0 pr-0 font-weight-bold" href="recrutement.php">Recrutement</a>
                        <ul class="dropdown">
                          <li><a href="recrutement.php">Pourquoi nous rejoindre?</a></li>
                          <li><a href="recrutement.php#emploi">Offre d'emlpoi</a></li>
                          <li><a href="recrutement.php#candidature">Candidature spontan&eacutee</a></li>
                        </ul>
                    </li>
                    <li class="nav-item active mr-lg-4">
                        <a class="nav-link pl-0 pr-0 font-weight-bold" href="actualite.php">Actualit&eacutes</a>
						<ul class="dropdown">
                          <li><a href="actualite.php">Ev&eacutenements</a></li>
                          <li><a href="actualite.php">Articles</a></li>                     
                          </ul>
                    </li>
                    <li class="nav-item mr-lg-4">
                        <a class="nav-link pl-0 pr-0 font-weight-bold" href="contact.html">Contact</a>
                    </li>
                        </ul>
                    </div>
                </nav>
            </div>
        </div>
        
        </header>
</div>
    <!-- //inner page header -->
 <div id="actualite" class="actualite">
    <div class="container">

        <br>
           <h4 class="title clr">NOS ACTUALITES</h4>

    </div>

    <section id="blog" class="padding-bottom">
        <div class="container">
            <div class="row">
                <div class="timeline-blog overflow padding-top">
                    
                    <div class="timeline-divider overflow padding-bottom">
                        <?php
                         $i=1;
                         $sql="SELECT * FROM `article`"; 
                         $result=mysqli_query($link,$sql);
                         if (mysqli_num_rows($result) > 0) {
                         // output data of each row
                         while($row = mysqli_fetch_assoc($result)) {
                           if ($i%2 == 1){
                        ?>

                        <div class="col-sm-6 padding-right arrow-right wow fadeInLeft" data-wow-duration="1000ms" data-wow-delay="300ms">
                            <!--center-->
                             <div class="single-blog timeline">
                                <div class="single-blog-wrapper">
                                    <div class="post-thumb">

                                        <img src="admin/images/Article/<?php echo e($row["image"]);?>" class="img-responsive" alt="" style=" width: auto; height: 300px; ">
                                        
                                    </div>
                                </div>
                                <div class="post-content overflow">
                                    <h2 class="post-title bold"><?php echo e($row["titreA"]);?></h2>
                                    <h3 style="color: #5cc4c0;font-size: 19px;" class="post-author"> <i class="fas fa-user"></i> <?php echo e($row["auteur"]);?></h3>
                                    <p><?php echo e($row["texte"]);?></p>
                                    
                                    <div class="post-bottom overflow">
                                        <span class="post-date pull-left"><i class="fas fa-calendar-alt"></i> &nbsp <?php echo e($row["date"]);?></span>
                                        
                                    </div></div>
                                </div><!--/center-->
                            </div>

                      <?php } else { ?>

                        <div class="col-sm-6 padding-left padding-top arrow-left wow fadeInRight" data-wow-duration="1000ms" data-wow-delay="300ms">
                            <!--center-->
                            <div class="single-blog timeline">
                                <div class="single-blog-wrapper">
                                    <div class="post-thumb">
                                        <img src="admin/images/Article/<?php echo e($row["image"]);?>" class="img-responsive" alt="" style=" width: auto; height: 300px; ">
                                        
                                    </div>
                                </div>
                                <div class="post-content overflow">
                                    <h2 class="post-title bold"><?php echo e($row["titreA"]);?></h2>
                                    <h3 style="color: #5cc4c0;font-size: 19px;" class="post-author"><i class="fas fa-user"></i>  <?php echo e($row["auteur"]);?> </h3>
                                    <p><?php echo e($row["texte"]);?></p>
                                   
                                    <div class="post-bottom overflow">
                                        <span class="post-date pull-left"><i class="fas fa-calendar-alt"></i> &nbsp <?php 
                                        echo e($row["date"]);?></span>
                                        
                                    </div>
                                </div>
                            </div><!--center-->
                        </div>
                        <?php }
                    $i++;
                     }
                }?>
                        

                    </div>
                </div>
                
            </div>
        </div>
    </section>
    <!--/#blog-->
 
</div>












    <!-- Footer -->
    <section class="w3l-footers-1">
        <div class="footer bg-secondary">
            <div class="container">
                <div class="footer-content">
                    <div class="row">
                        <div class="col-lg-8 footer-left">
                            <p class="m-0">&copy Copyright 2021 BICLINK </p>
                        </div>
                        <div class="col-lg-4 footer-right text-lg-right text-center mt-lg-0 mt-3">
                            <ul class="social m-0 p-0">
                                <li><a href="https://www.facebook.com/BICLINKconsulting/" target="_blank"><span class="fa fa-facebook"></span></a></li>
                                <li><a href="https://www.linkedin.com/company/biclink/" target="_blank"><span class="fa fa-linkedin"></span></a></li>
                                
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- //Footer -->

    <!-- move top -->
    <button onclick="topFunction()" id="movetop" class="bg-primary" title="Go to top">
        <span class="fa fa-angle-up"></span>
    </button>
    <script>
        // When the user scrolls down 20px from the top of the document, show the button
        window.onscroll = function () {
            scrollFunction()
        };

        function scrollFunction() {
            if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
                document.getElementById("movetop").style.display = "block";
            } else {
                document.getElementById("movetop").style.display = "none";
            }
        }

        // When the user clicks on the button, scroll to the top of the document
        function topFunction() {
            document.body.scrollTop = 0;
            document.documentElement.scrollTop = 0;
        }
    </script>
    <!-- /move top -->

    <!-- common jquery -->
    <script src="assets/js/jquery-3.3.1.min.js"></script>
    <!-- //common jquery -->

    <!--  bootstrap js -->
    <script src="assets/js/bootstrap.min.js"></script>
    <!--  //bootstrap js -->


<!-- samar-->
<script type="text/javascript" src="js/jquery.js"></script>
    <script type="text/javascript" src="assets/bootstrap.min.js"></script>
    <script type="text/javascript" src="assets/lightbox.min.js"></script>
    <script type="text/javascript" src="assets/wow.min.js"></script>
    <script type="text/javascript" src="assets/main.js"></script> 
</body>

</html>