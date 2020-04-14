<?php
  //session_start();
  include('controler.php');
  /*try{
    $bdd = new PDO('mysql:host=localhost;dbname=projet web;','root','root');
    $retour["sucess"] = true;
    $retour["message"] = "Connexion à la base de donnée reussie";
  }
  catch(Exception $e){
    $retour["sucess"] = false;
    $retour["message"] = "Connexion à la base de donnée impossible";
    throw new Exception("Error Processing Request", 1);   
  }*/

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
        <script src="vendor/jquery/app.js"></script>

        <!-- JQuery téléchargé depuis le CDN de Google pour optimiser le chargement de la page -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-tofit=no"/>

        <!-- Fichier CSS Principal du site -->
        <link rel="stylesheet" href="public\css\style.css">
        <link rel="stylesheet" href="public/css/other.css">
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
                  <a class="navbar-brand" href="panier.php">
                    <img src="public\images\panier.png" width="55" height="55" class="d-inline-block align-top" alt=""></a>
                </li>
                <li class="nav-item">
                    <a class="navbar-brand" href="profil.php">
                      <img src="public\images\profil.png" width="55" height="55" class="d-inline-block align-top" alt=""></a>
                </li>
                <li class="nav-item">
                    <p><?php $_SESSION['prenom'] ?></p>
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
        </ul>
      </div> 
    </div>

    <?php /*

    //$panier = $bdd->prepare("SELECT * FROM Panier WHERE User_ID = ?");
    //$panier->execute(array($_SESSION['User_ID']));
    //$commande = $panier->fetch();
    //$produit1 = $commande[Produit_ID]

    $produit = $bdd->prepare("SELECT * FROM Panier RIGHT JOIN Produits ON Panier.Produit_ID = Produits.Produit_ID WHERE User_ID = ?");
    $produit->execute(array($_SESSION['User_ID']));
    $prod = $produit->fetch();

    //$panier = $bdd->prepare("SELECT * FROM ? WHERE User_ID = ?");
    //$panier->execute(array($prod, $_SESSION['User_ID']));
    //$commande = $panier->fetch();
    ?>
          


    <!--p><?php //echo $prod[Produit_ID]; ?></p>
    <p><?php //echo $prod[Nom]; ?></p>
    <img src="public\images\<?php //echo $prod[Photo]; */?>" <!--class="d-inline-block align-top" alt="">
    <p> efjbzefubz</p-->
      
    <div align="center" class="center">
      <br /><br />
        <h2>Votre Panier</h2>
        <br /><br />
    </div>

    <!--<div class="col-lg-4 col-md-6 mb-4 panier-container">
      <div class="card h-100">
        <a href="#">
          <img class="card-img-top" src="<?php echo $_SESSION['picture-article'] ?>" alt="">
        </a>
          <div class="card-body">
            <h4 class="card-title">
              <a href="#"><?php /*echo $_SESSION['name-article'] */?></a>
            </h4>
            <h5><?php /*echo $_SESSION['price-article']; */?> €</h5>
            <p class="card-text"><?/*php echo $prod[Description]; */?></p>
            <option>
              <select>1</select>
            </option>
          </div>
          <div class="card-footer">
            <small class="text-muted">&#9733; &#9733; &#9733; &#9733; &#9734;</small>
          </div>
        </div>
      </div>
    </div>-->
    <form action="controler.php" method="post" class="validate-shop-cage-form">
      <?php echo $_SESSION['shop_cage'] ?>
      <button type="submit" name="validate_shop_cage" class="btn btn-success btn-validate">Valider mon panier</button>
      <button name="delete_shop_cage" class="btn btn-danger delete-shop-cage">Vider mon panier</button>
    </form>

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