<?php
session_start();
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
          <li class="nav-item">
            <a class="nav-link" href="galerie.php">Galerie</a>
          </li>
        </ul>
      </div> 
  <!-- Page Content -->
  <div class="container">

    <div class="row">

      <div class="col-lg-3">

        <h1 class="my-4">O'Cesi</h1>
        <div class="list-group">
          <a class="list-group-item" href="Category V.php">Vêtements</a>
          <a href="Category A.php" class="list-group-item">Accessoires</a>
        </div>

      </div>
      <div class="row">

        <div class="col-lg-4 col-md-6 mb-4">
          <div class="card h-100">
            <a href="#"><img class="card-img-top" src="public\images\tasse.png" alt=""></a>
            <div class="card-body">
              <h4 class="card-title">
                <a href="#">Tasse Cesi</a>
              </h4>
              <h5>5,50€</h5>
              <p class="card-text">Tasse personnalisée Cesi</p>
            </div>
            <form action="<?php echo $_SESSION['Produit_ID']=30; include 'newpanier.php';?>" method="post">
                <button type="button" class="btn btn-outline-success"> Ajouter au panier </button>
              </form>
            <div class="card-footer">
              <small class="text-muted">&#9733; &#9733; &#9733; &#9733; &#9734;</small>
            </div>
          </div>
        </div>

        <div class="col-lg-4 col-md-6 mb-4">
          <div class="card h-100">
            <a href="#"><img class="card-img-top" src="public\images\pins.png" alt=""></a>
            <div class="card-body">
              <h4 class="card-title">
                <a href="#">Pins</a>
              </h4>
              <h5>5,00€</h5>
              <p class="card-text">Lot de 4 pins Cesi</p>
            </div>
            <form action="<?php echo $_SESSION['Produit_ID']=31; include 'newpanier.php';?>" method="post">
                <button type="button" class="btn btn-outline-success"> Ajouter au panier </button>
              </form>
            <div class="card-footer">
              <small class="text-muted">&#9733; &#9733; &#9733; &#9733; &#9734;</small>
            </div>
          </div>
        </div>
        <div class="col-lg-4 col-md-6 mb-4">
          <div class="card h-100">
            <a href="#"><img class="card-img-top" src="public\images\dessous de table.png" alt=""></a>
            <div class="card-body">
              <h4 class="card-title">
                <a href="#">Dessous de table</a>
              </h4>
              <h5>5,00€</h5>
              <p class="card-text">Lot de 4 dessous de table</p>
            </div>
            <form action="<?php echo $_SESSION['Produit_ID']=32; include 'newpanier.php';?>" method="post">
                <button type="button" class="btn btn-outline-success"> Ajouter au panier </button>
              </form>
            <div class="card-footer">
              <small class="text-muted">&#9733; &#9733; &#9733; &#9733; &#9734;</small>
            </div>
          </div>
        </div>

        <div class="col-lg-4 col-md-6 mb-4">
          <div class="card h-100">
            <a href="#"><img class="card-img-top" src="public\images\nounours.png" alt=""></a>
            <div class="card-body">
              <h4 class="card-title">
                <a href="#">Nounours</a>
              </h4>
              <h5>10,00€</h5>
              <p class="card-text">Un petit nounours personnalisé Cesi</p>
            </div>
            <a <button type="button" class="btn btn-outline-success"> Ajouter au panier </button> </a>
            <div class="card-footer">
              <small class="text-muted">&#9733; &#9733; &#9733; &#9733; &#9734;</small>
            </div>
          </div>
        </div>

        <div class="col-lg-4 col-md-6 mb-4">
          <div class="card h-100">
            <a href="#"><img class="card-img-top" src="public\images\tapis de souris.png" alt=""></a>
            <div class="card-body">
              <h4 class="card-title">
                <a href="#">Tapis de souris</a>
              </h4>
              <h5>4,00€</h5>
              <p class="card-text">Un tapis de souris personnalisé Cesi</p>
            </div>
            <a <button type="button" class="btn btn-outline-success"> Ajouter au panier </button> </a>
            <div class="card-footer">
              <small class="text-muted">&#9733; &#9733; &#9733; &#9733; &#9734;</small>
            </div>
          </div>
        </div>

        <div class="col-lg-4 col-md-6 mb-4">
          <div class="card h-100">
            <a href="#"><img class="card-img-top" src="public\images\coq.png" alt=""></a>
            <div class="card-body">
              <h4 class="card-title">
                <a href="#">Coq iphone 7/8</a>
              </h4>
              <h5>15,00€</h5>
              <p class="card-text">une coq personnalisée Cesi pour Iphone 7/8</p>
            </div>
            <a <button type="button" class="btn btn-outline-success"> Ajouter au panier </button> </a>
            <div class="card-footer">
              <small class="text-muted">&#9733; &#9733; &#9733; &#9733; &#9734;</small>
            </div>
          </div>
        </div>

      </div>
      <!-- /.row -->

    </div>
    <!-- /.col-lg-9 -->

  </div>
  <!-- /.row -->

</div>
<!-- /.container -->
</div>
<!-- Footer -->
<footer class="py-5 bg-dark">

    <div class="foot" align="center">

      <a class="" href="legal.php">Mentions Légales</a>

      <!-- Add icon library -->

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

 

<!-- Add font awesome icons -->

<a href="https://www.facebook.com/pg/BDECESINanter/posts/" class="fa fa-facebook"></a>

<a href="https://www.instagram.com/bdecesinanterre/" class="fa fa-instagram"></a>

 

  </footer>
<!-- Bootstrap core JavaScript -->
<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

</body>

</html>
