<?php
  include('controler.php');

  if ($_SESSION['connected']) {
    ?>
    <!DOCTYPE html>
    <html lang="fr">
      <head>
        <meta charset="utf-8">

        <!-- Fichier CSS téléchargé depuis le CDN de Bootstrap pour optimiser le chargement de la page -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

        <!-- Scripts JavaScript pour Bootstrap provenant du CDN -->
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

        <!-- JQuery téléchargé depuis le CDN de Google pour optimiser le chargement de la page -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-tofit=no"/>

        <!-- Fichier CSS Principal du site -->
        <link rel="stylesheet" href="public\css\style.css">
        <link href="https://fonts.googleapis.com/css?family=Exo+2&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">



        

        <title>CESI</title>
      </head>

      <body>
        <header class="Banner">
          <nav id="navbar-example2" class="navbar navbar-light bg-light">
              <a class="navbar-brand" href="accueil.php">
                <img src="public\images\logo-CESI.png" width="230" height="70" class="d-inline-block align-top" alt=""> 
              </a>
              <ul class="nav nav-pills">
                <li class="nav-item">
                    <img src="public\images\panier.png" width="55" height="55" class="d-inline-block align-top" alt="">
                </li>
                <li class="nav-item">
                    <a class="navbar-brand" href="profil.php">
                      <img src="public\images\profil.png" width="55" height="55" class="d-inline-block align-top" alt=""></a>
                </li>
                <li class="nav-item">
                    <p><?php echo $_SESSION['prenom'];?></p>
                </li>
                <?php
            if ($_SESSION['connected']) {
              ?>
              <form action="controler.php" method="post">
                <input type="submit" class="btn btn-dark" name="btn-deconnect" value="Se déconnecter">
              </form>
              <?php
            } else {
              ?>
              <a href="connexion.php">
                <button class="btn btn-dark">Se connecter</button>
              </a>
              <?php
            }
          ?>
              </ul>
            </nav>

          </header>
          
    

    <div id="wrapper" class="active">  
        
        <div id="sidebar-wrapper">
            <ul id="sidebar_menu" class="sidebar-nav">
              <li class="sidebar-brand"><a id="menu-toggle" href="#">Menu<span id="main_icon" class="fa fa-align-justify"></span></a></li>
            </ul>
            <ul class="sidebar-nav" id="sidebar">
              <li class="nav-item">
                <a class="nav-link" href="accueil.php">Accueil</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="boutique.php">Boutique</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="bde.php">BDE</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="events.php">Evenements</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="associations.php">Associations</a>
              </li>
            </ul>
          </div> 

    <div class="card-columns">
      <?= $events ?>
      <div class="card">
        <img src="public\images\wei.jpg"  class="card-img-top" alt="...">
        <div class="card-body">
          <h5 class="card-title">Le WEEEEEEEEEI</h5>
          <p class="card-text">Vous l’attendiez avec impatience, votre WEI arrive du 28/11 au 30/11 // Spot de folie, Nombreuses activités et Cocktails // RDV sur notre page Facebook et réserves ta place rapidement ! 🌴🏄🏻‍♂🍹 #WEI #CESI #CEFIPA #CESFA #BDE #BDENANTERRE #BDECESINANTERRE </p>
        </div>
      </div>
      <div class="card p-3">
        <blockquote class="blockquote mb-0 card-body">
              <img src="public\images\kiss.jpg"  class="card-img-top" alt="...">
              <h5 class="card-title">Kiss cool</h5>
          <p>🎙Le BDE t’attend mercredi 13 Février pour une soirée KisssssCooooool ❄️ Au programme: AfterWEI Des familles 🎬 Shot Kiss Cool 🥶 Beer Pong 🎯 #WEI #CESI #CESFA #CEFIPA #EXIA #BDECESINANTERRE #geekmemore</p>
          <footer class="blockquote-footer">
            <small class="text-muted">
            </small>
          </footer>
        </blockquote>
      </div>
      <div class="card">
      <img src="public\images\gliss.jpg"  class="card-img-top" alt="...">
        <div class="card-body">
          <h5 class="card-title">Cesi Gliss</h5>
          <p class="card-text">Êtes-vous prêts ? J-8 avant le #CESIGLISS !! #CESIGLISS2016 #RISOUL #Jmoins8 #bdecesinanterre #cesifriends #cesisfaction #cesilinstant #cesimoi #vacancesdefolie </p>
        </div>
      </div>
      <div class="card bg-primary text-white text-center p-3">
        <blockquote class="blockquote mb-0">
        <img src="public\images\danse.jpg"  class="card-img-top" alt="...">
        <h5 class="card-title">Cesi Danse</h5>
          <p>🔊Un grand merci et bravo à tous les participants, vous êtes le meilleur campus de Nanterre 😉🎉🎶🎶 #bdecesinanterre #campus_cesinanterre #flashmob2019 #soleil</p>
          <footer class="blockquote-footer text-white">
          </footer>
        </blockquote>
      </div>

      <div class="card p-3 text-right">
        <blockquote class="blockquote mb-0">
              <img src="public\images\4l trophy.jpg"  class="card-img-top" alt="...">
      <h5 class="card-title">4l trophy</h5>
      <p>Participez au prochain 4L Trophy au moins de mars.</p>
      <p>Inscrivez vous vite au BDE les place sont limités!!!!!!!!!</p>
        </blockquote>
      </div>
      <div class="card bg-primary text-white text-center p-3">
        <blockquote class="blockquote mb-0">
          <a href="upload2.php" class="list-group-item">Creer une nouvelle activité</a>
          
        </blockquote>
      </div>
    </div>
    </div>




    <script type="text/javascript">
      $("#menu-toggle").click(function(e) {
            e.preventDefault();
            $("#wrapper").toggleClass("active");
    });
    </script>



    <footer class="py-5 bg-dark">

        <div class="foot" align="center">

          <a class="" href="legal.php">Mentions Légales</a>

          <!-- Add icon library -->

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    

    <!-- Add font awesome icons -->

    <a href="https://www.facebook.com/pg/BDECESINanter/posts/" class="fa fa-facebook"></a>

    <a href="https://www.instagram.com/bdecesinanterre/" class="fa fa-instagram"></a>

    

      </footer>

      </body>
    </html>
    <?php
  } else {
    header('Location: connexion.php');
  }
?>