<?php
require_once __DIR__ . '/config.php';
header("Content-Type: text/html; charset=utf-8");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Recrutement</title>
    <link rel="icon" href="assets/images/Li.png" sizes="32x32" type="image/png">


    <!-- google fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:400,700&display=swap" rel="stylesheet">

    <!-- Template CSS -->
    <link rel="stylesheet" href="assets/css/style-starter.css">
    <link rel="stylesheet" href="assets/css/style.css">

    <!-- samar font awesome -->
  <link href="assets/css/font-awesome.min.css" rel="stylesheet">
  <script src="https://kit.fontawesome.com/adaf660447.js" crossorigin="anonymous"></script>

</head>

<body>
    <!-- inner page header -->
    <div class="inner-banner">
        <header>
        <div class="w3l-header inner-w3l-header" id="home">
            <div class="container">
                <nav class="navbar navbar-expand-lg navbar-dark pl-0 pr-0">
                    <div class="logo"><a class="navbar-brand m-0 text-primary" href="index.php"><img src="assets/images/Sans titre-2.png" alt="logo"> </a>  </div> 

                    <!-- <span class="logo">portfolio</span>-->
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarNav">
                        <ul class="navbar-nav ml-auto">
                            
                            <li class="nav-item mr-lg-4">
                              <a class="nav-link pl-0 pr-0 font-weight-bold" href="about.html">BICLINK<i class="fa fa-angle-down"></i></a>
                               <ul class="dropdown">
                                  <li><a href="about.html #notremission">Notre mission</a></li>
                                  <li><a href="about.html #VALEURS">Notre valeur</a></li>
                                  <li><a href="about.html #team">Notre équipe</a></li>
                                </ul>
                            </li>


                    <li class="nav-item mr-lg-4">
                        <a class="nav-link pl-0 pr-0 font-weight-bold" href="offre.html">Offre<i class="fa fa-angle-down"></i></a>
                        <ul class="dropdown">
                          <li><a href="offre.html">Business</a></li>
                          <li><a href="offre.html">Innovation</a></li>
                          <li><a href="offre.html">Change</a></li>
                        </ul>
                    </li>

                    <li class="nav-item mr-lg-4">
                        <a class="nav-link pl-0 pr-0 font-weight-bold" href="référence.html">Références</a>
                    </li>
                    <li class="nav-item active mr-lg-4">
                        <a class="nav-link pl-0 pr-0 font-weight-bold" href="recrutement.php">Recrutement<i class="fa fa-angle-down"></i></a>
                        <ul class="dropdown">
                          <li><a href="recrutement.php">Pourquoi nous rejoindre?</a></li>
                          <li><a href="recrutement.php #emploi">Offre d'emlpoi</a></li>
                          <li><a href="recrutement.php #candidature">Candidature spontanée</a></li>
                        </ul>
                    </li>

                    <li class="nav-item mr-lg-4">
                        <a class="nav-link pl-0 pr-0 font-weight-bold" href="actualite.php">Actualités<i class="fa fa-angle-down"></i></a>
                        <ul class="dropdown">
                          <li><a href="actualite.php">Evénements</a></li>
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

<!--  candidature spontanée  -->

 <div class="candidature" id="candidature">
    <div class="container1">
        <h4 class="title"> Postuler </h4>
    </div>
    <div class="container">
        <?php
                         // SQL INJECTION FIX: was "... where idE=" . $_GET["Emploi"]
                         $emploiId = (int) ($_GET["Emploi"] ?? 0);
                         $stmtEmploi = mysqli_prepare($link, "SELECT * FROM `emploi` WHERE idE = ?");
                         mysqli_stmt_bind_param($stmtEmploi, 'i', $emploiId);
                         mysqli_stmt_execute($stmtEmploi);
                         $result = mysqli_stmt_get_result($stmtEmploi);
                         if ($result && mysqli_num_rows($result) > 0) {
                         // output data of each row
                         while($row = mysqli_fetch_assoc($result)) {
        ?>
        <form id="candidature-form" method="post" action="postulersend.php " enctype="multipart/form-data">

           <label for="email">Titre d'emploi : </label>
           <input type="text" id="titre" name="titre" value="<?php echo e($row["titreE"]);?>" readonly>

           <label for="fname">Nom/Prénom : </label>
           <input type="text" id="name" name="name" placeholder="Nom">

           <label for="email">Email : </label>
           <input type="email" id="email" name="email" placeholder="Email">

           <label for="phone">Téléphone :</label>
           <input type="tel" id="phone" name="phone" placeholder="numero de Téléphone">

           <label for="message">Lettre de motivation :</label>
           <input type="file"  id="myInput" aria-describedby="myInput" name="message" required>
           <!--textarea id="message" name="message" placeholder="Message" style="height:160px"></textarea-->

           <label for="cv"> CV : </label>
           <input type="file"  id="myInput" aria-describedby="myInput" name="cv" required>
           

           <input type="submit" name="envoyer" value="Envoyer">

        </form>
        <?php
    }}
    ?>
    </div>
    

</div>



    <!-- Footer -->
    <section class="w3l-footers-1">
        <div class="footer bg-secondary">
            <div class="container">
                <div class="footer-content">
                    <div class="row">
                        <div class="col-lg-8 footer-left">
                            <p class="m-0">© Copyright 2020 BICLINK </p>
                        </div>
                        <div class="col-lg-4 footer-right text-lg-right text-center mt-lg-0 mt-3">
                            <ul class="social m-0 p-0">
                                <li><a href="#facebook"><span class="fa fa-facebook"></span></a></li>
                                <li><a href="#linkedin"><span class="fa fa-linkedin"></span></a></li>
                                <li><a href="#instagram"><span class="fa fa-instagram"></span></a></li>
                                <li><a href="#twitter"><span class="fa fa-twitter"></span></a></li>
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

    <!-- disable body scroll which navbar is in active -->
    <script>
        $(function () {
            $('.navbar-toggler').click(function () {
                $('body').toggleClass('noscroll');
            })
        });
    </script>
    <!-- disable body scroll which navbar is in active -->

    <!--  bootstrap js -->
    <script src="assets/js/bootstrap.min.js"></script>
    <!--  //bootstrap js -->
<script src="assets/js/javaR.js"></script>

</body>

</html>