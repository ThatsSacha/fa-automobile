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
		<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
		<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
		<script src="assets/js/app.js"></script>
		<title>FA Automobile | Ajouter un topic</title>
	</head>
	<body>
		<?php include('assets/inc/nav-bar.php'); ?>
        <main>
            <?php
                if ($_SESSION['connected']) {
                    ?>
                    <h1>Ajouter un topic</h1>
                    <form action="controler.php" method="POST">
                        <input type="text" class="form-control" name="topic-title" placeholder="Titre du topic" autofocus required>
                        <textarea class="form-control" name="topic" placeholder="Votre message" required></textarea>
                        <input type="submit" class="btn btn-success" name="submit-add-topic" value="Poster">
                    </form>
                    <?php
                } else {
                    ?>
                    <h1>Vous devez vous connecter ou vous inscrire pour poster une question</h1>
                    <a href="login.php">Cliquez ici pour vous connecter</a>
                    <a href="signin.php">Cliquez ici pour vous inscrire</a>
                    <?php
                }
            ?>
        </main>
		<?php include('assets/inc/footer.php'); ?>
	</body>
</html>