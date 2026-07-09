<?php require_once __DIR__ . '/require_login.php'; ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
	<title>Ajouter Un Article | BICLINK</title>

		<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<!--link rel="icon" type="image/png" href="imageslogin/icons/favicon.ico"/-->
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendorlogin/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fontslogin/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendorlogin/animate/animate.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="vendorlogin/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendorlogin/select2/select2.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="csslogin/util.css">
	<link rel="stylesheet" type="text/css" href="csslogin/main.css">
<!--===============================================================================================-->

	 <link rel="shortcut icon" href="images/ico/li.png">
</head>
<body>
	

		<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<div class="login100-pic js-tilt" data-tilt>
					<a href="updatepage.php"><img src="imageslogin/logo2.png" alt="IMG"></a>
				</div>

				<form class="login100-form validate-form" method="POST" action="ajouterphp.php" enctype="multipart/form-data">
					<span class="login100-form-title">
						Ajouter Article
					</span>

					<input type="hidden" name="csrf_token" value="<?php echo e(csrf_token()); ?>">

					<div class="wrap-input100 validate-input" >
						<input class="input100" type="text" name="titre" placeholder="titre">
						
					</div>

					<div class="wrap-input100 validate-input" >
						<input class="input100" type="text" name="auteur" placeholder="auteur">
						
					</div>
					<div class="wrap-input100 validate-input" >
						<input class="input100" type="text" name="texte" placeholder="texte">
						
					</div>
					<div class="wrap-input100 validate-input" >
						<input class="input100" type="date" name="date" placeholder="date">
						
					</div>

					<div  >
						<input class="input100" type="file" name="file"  placeholder="image">
						
					</div>


					
					<div class="container-login100-form-btn" name="button">
						<button class="login100-form-btn">
							Ajouter
						</button>
					</div>

					

					
				</form>
			</div>
		</div>
	</div>
	
	

	
<!--===============================================================================================-->	
	<script src="vendorlogin/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="vendorlogin/bootstrap/js/popper.js"></script>
	<script src="vendorlogin/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="vendorlogin/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="vendorlogin/tilt/tilt.jquery.min.js"></script>
	<script >
		$('.js-tilt').tilt({
			scale: 1.1
		})
	</script>
<!--===============================================================================================-->
	<script src="jslogin/main.js"></script>


</body>
</html>
