<?php require_once __DIR__ . '/require_login.php'; ?>
<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
	<title>UpDatepage | BICLINK</title>

	
    
	<link href="csslogin/styleupdate.css" rel="stylesheet">
	

          
    <link rel="shortcut icon" href="images/ico/li.png">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="images/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="images/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="images/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="images/ico/apple-touch-icon-57-precomposed.png">
</head>
<body>

	

    <!-- boutton ajouter un article -->
    <div class="form-group">

        <h1 class="logo"><img src="images/logo.png" alt="logo"></h1>
        <h2> Mis à jours des pages BICLINK </h2>

        <a href="ajouterarticle.php"><input type="submit" name="ajout" class="btn btn-submit" value="Ajouter Article"></a>

       
        <a href="afficherarticle.php"><input type="submit" name="affichea" class="btn btn-submit" value="Afficher  les articles"></a><br>

        <a href="ajouteremploi.php"><input type="submit" name="ajout" class="btn btn-submit" value="Ajouter Emploi"></a>
        
        <a href="afficherEmploi.php"><input type="submit" name="ajout" class="btn btn-submit" value="Afficher les emplois"></a><br>

        <a href="afficherCandidat.php"><input type="submit" name="afficheCandidat" class="btn btn-submit" value="Afficher les candidats spontanées"></a> <br>

         <a href="afficherPostulant.php"><input type="submit" name="affichePostulant" class="btn btn-submit" value="Afficher les postulants"></a>

         <a href="afficherContact.php"><input type="submit" name="affichecontact" class="btn btn-submit" value="Afficher  les messages"></a><br>

         <a href="logout.php"><input type="submit" name="logout" class="btn btn-submit" value="Se déconnecter"></a>


    </div>




</body>
</html>
