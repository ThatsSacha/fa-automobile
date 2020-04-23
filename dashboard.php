<?php
    // Comme la page controler.php n'a pas encore été incluse via le fichier nav-bar.php on start la session pour vérifier si l'user est connecté
    session_start();
    if ($_SESSION['connected']) {
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
                <title>FA Automobile | Dashboard</title>
            </head>
            <body>
                <?php include('assets/inc/nav-bar.php'); ?>
                    <main>
                        <span>Nom: <?php echo $_SESSION['first_name']; ?></span>
                        <span>Prénom: <?php echo $_SESSION['second_name']; ?></span>
                        <span>Adresse mail: <?php echo $_SESSION['mail']; ?></span>
                        <?php
                            if ($_SESSION['admin']) {
                                ?>
                                <span>Vous êtes admin !</span>
                                <?php
                            }
                        ?>
                        <a href="controler.php?action=delete">
                            <button class="btn btn-danger">Supprimer mon compte</button>
                        </a>
                    </main>
                <?php include('assets/inc/footer.php'); ?>
            </body>
        </html>
        <?php
    } else {
        header('Location: login.php');
    }
?>