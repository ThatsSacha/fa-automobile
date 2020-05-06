<?php
    // Comme la page controler.php n'a pas encore été incluse via le fichier nav-bar.php on start la session pour vérifier si l'user est connecté
    session_start();
    if ($_SESSION['connected']) {
        ?>
        <!DOCTYPE html>
        <html lang="fr">
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1"/>
                <link rel="stylesheet" href="assets/css/style.css">
                <link href="https://fonts.googleapis.com/css?family=Exo+2&display=swap" rel="stylesheet">
                <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
                <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
                <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
                <script src="assets/js/app.js"></script>
                <title>FA Automobile | Dashboard</title>
            </head>
            <body>
                <?php include('assets/inc/nav-bar.php'); ?>
                    <main>
                        <form action="controler.php?action=modify-account" method="POST">
                            <input type="text" name="modify-first-name" class="form-control" value="<?= $_SESSION['first_name'] ?>" placeholder="Votre prénom" autofocus required>
                            <input type="text" name="modify-second-name" class="form-control" value="<?= $_SESSION['second_name'] ?>" placeholder="Votre nom de famille" required>
                            <input type="email" name="modify-mail" class="form-control" value="<?= $_SESSION['mail'] ?>" placeholder="Votre adresse mail" required>
                            <input type="password" name="modify-password" class="form-control" placeholder="Votre nouveau mot de passe (non obligatoire)">
                            <input type="submit" name="submit-modify" class="btn btn-success" value="Changer mes informations">
                        </form>
                    </main>
                <?php include('assets/inc/footer.php'); ?>
            </body>
        </html>
        <?php
    } else {
        header('Location: login.php');
    }
?>