<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-tofit=no"/>
		<link rel="stylesheet" href="assets/css/style.css">
		<link href="https://fonts.googleapis.com/css?family=Exo+2&display=swap" rel="stylesheet">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
		<script src="assets/js/app.js"></script>
		<title>FA Automobile | Votre panier</title>
	</head>
	<body>
		<?php include('assets/inc/nav-bar.php'); ?>
		<main class="h-auto">
            <h1>Votre panier</h1>
            <div class="shop-cage">
                <?= $shop_cage_vehicles ?>
            </div>
			<?php
				if ($_SESSION['connected']) {
					?>
						<a href="controler.php?action=validate-shop-cage">
							<button class="btn btn-success">Valider et acheter le panier</button>
						</a>
					<?php
				} else {
					?>
						<a href="login.php">
							<button class="btn btn-success">Se connecter et valider</button>
						</a>
					<?php
				}
			?>
		</main>
		<?php include('assets/inc/footer.php'); ?>
	</body>
</html>