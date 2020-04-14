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
            <a class="nav-link" href="#mdo">Boutique</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="bde.php">BDE</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="boutique.php">Evenements</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="associations.php">Associations</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="galerie.php">Galerie</a>
          </li>
        </ul>
      </div> 

        <?php if ($_SESSION['status'] >1) { ?>
        <div align="center">
        <br /><br />
         <h2>Nouveau Produit</h2>
         <br /><br />
         <form method="POST" action="">
            <table>
              <tr>
                <td align="right">
                  <label for="nom">Nom :</label>
                </td>
                <td>
                  <input type="text" placeholder="Nom" id="nom" name="nom" value="<?php if(isset($nom)) { echo $nom; } ?>" />
                </td>
              </tr>
              <tr>
                <td align="right">
                  <label for="description">Description :</label>
                </td>
                <td>
                  <input type="text" placeholder="Description" id="des" name="des" value="<?php if(isset($des)) { echo $des; } ?>" />
                </td>
              </tr>
              <tr>
                <td align="right">
                  <label for="prix">Prix :</label>
                </td>
                <td>
                  <input type="text" placeholder="Prix" id="prix" name="prix" value="<?php if(isset($prix)) { echo $prix; } ?>" />
                </td>
              </tr>
               <tr>
                  <td align="right">
                     <label for="nbs">Nombre en stock :</label>
                  </td>
                  <td>
                     <input type="text" placeholder="Nombre en stock" id="nbs" name="nbs" value="<?php if(isset($nbs)) { echo $nbs; } ?>" />
                  </td>
               </tr>
               <tr>
                
               </tr>
               <tr>
                  <td></td>
                  <td align="center">
                     <br />
                     <input type="submit" name="nvproduit" value="Creer un nouveau produit" />
                  </td>
               </tr>
            </table>
         </form>
         <br>
         <?php
         include('CreationProduit.php');
         if(isset($erreur)) 
         {
            echo '<font color="red">'.$erreur."</font>";
         }
        } else { ?>
          <br>
          <h1>Vous n'avez pas les droits pour pouvoir acceder a cette page</h1>
        <?php } ?>
         <br>
      </div>


      </div>
  <!-- Footer -->
  <footer class="py-5 bg-dark">
    <div class="container">
      <p class="m-0 text-center text-white">Copyright &copy; Your Website 2019</p>
    </div>
    <!-- /.container -->
  </footer>

  <!-- Bootstrap core JavaScript -->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

</body>

</html>