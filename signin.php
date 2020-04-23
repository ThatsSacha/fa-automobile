<?php
	session_start();

	if (!$_SESSION['connected']) {
		?>
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
				<title>FA Automobile | Inscription</title>
			</head>
			<body>
				<?php include('assets/inc/nav-bar.php'); ?>
					<main>
						<h1>Inscription</h1>
						<form action="controler.php" method="POST">
							<input type="text" name="first-name" class="form-control" placeholder="Votre nom" autofocus required>
							<input type="text" name="second-name" class="form-control" placeholder="Votre prénom" required>
							<input type="email" name="mail" class="form-control" placeholder="Votre adresse mail" required>
							<input type="password" name="password" class="form-control" placeholder="Votre mot de passe" required>
							<input type="password" name="confirm-password" class="form-control" placeholder="Confirmez votre mot de passe" required>
							<input type="submit" name="submit-signin" class="btn btn-primary" value="S'inscrire">
						</form>
					</main>
				<?php include('assets/inc/footer.php'); ?>
			</body>
		</html>
		<?php
	} else {
		header('Location: dashboard.php');
	}
?>