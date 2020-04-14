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

    <p>
    Site Internet CESI BDE<br>
    Par le CESI Ecole d'ingénieurs<br>
    93 Boulevard de la Seine<br>
    92000 Nanterre<br>
    France<br>
    <br>
    Tel.    : 555-01-26-25-64<br>
    Fax     : 555-05-40-00-12<br>
    https://www.cesi-bde.fr<br>
    <br>
    Le CESI est une école d'ingénieurs au capital de 25 000 €<br>
    RCS B 497 553 71 - Siret : 49755371900020 - APE : 6201Z<br>
    N° déclaration CNIL : 2831470<br>
    <br>
    Conditions d'utilisation :<br>
    <br>
    Le site accessible par les URL suivants : www.cesi-bde.fr est exploité dans le respect de la législation française. L'utilisation de ce site est régie par les présentes conditions générales. En utilisant le site, vous reconnaissez avoir pris connaissance de ces conditions et les avoir acceptées. Celles-ci pourront êtres modifiées à tout moment et sans préavis par l'école CESI Ecole d'ingénieurs.<br>
    Le CESI Ecole d'ingénieurs ne saurait être tenu pour responsable en aucune manière d’une mauvaise utilisation du service.
</p>

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
