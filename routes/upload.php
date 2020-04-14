<?php session_start(); ?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
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
    <title>Formulaire d'upload de fichiers pour votre nouveau produit</title>
    
</head>
<body>
<title>Formulaire d'upload de fichiers pour votre nouveau produit</title>
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
  <?php
    if ($_SESSION['admin']) {
      ?>
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

        <?php /*if ($_SESSION['status'] > 1) { */?>
        <h1>Ajouter un article</h1>
        <form action="controler.php" method="post" enctype="multipart/form-data" >
            <!--<br>
            <br>
            <h2>Upload Image</h2>
            <label for="fileUpload">Fichier:</label>
            <input type="file" name="photo" id="fileUpload">
            <form>
            <input type="submit" name="submit" value="Upload">
          </form>
            <p><strong>Note:</strong> Seuls les formats .jpg, .jpeg, .jpeg, .gif, .png sont autorisés jusqu'à une taille maximale de 5 Mo.</p>-->
            <input type="text" class="form-control col-lg-4" name="article_name" placeholder="Nom de l'article" autofocus required>
            <textarea cols="30" rows="2" class="form-control col-lg-4" name="article_description" placeholder="Brève description de l'article" required></textarea>
            <input type="file" class="form-control col-lg-4" name="article_picture" required>
            <input type="number" class="form-control col-lg-4" name="article_price" max="99999" min="0" placeholder="Prix de l'article" required>
            <select name="article_note" class="form-control col-lg-4">
              <option value="">Notation de l'article</option>
              <option value="1">1</option>
              <option value="2">2</option>
              <option value="2">2</option>
              <option value="3">3</option>
              <option value="4">4</option>
              <option value="5">5</option>
            </select>
            <input type="submit" class="btn btn-success col-lg-4" name="submit_article" value="Ajouter">
        </form>
        
        <?php
        // Vérifier si le formulaire a été soumis
        /*if($_SERVER["REQUEST_METHOD"] == "POST"){
        // Vérifie si le fichier a été uploadé sans erreur.
        if(isset($_FILES["photo"]) && $_FILES["photo"]["error"] == 0){
            $allowed = array("jpg" => "image/jpg", "jpeg" => "image/jpeg", "gif" => "image/gif", "png" => "image/png", "JPEG" => "image/jpeg", "PNG" => "image/png");
            $filename = $_FILES["photo"]["name"];
            $filetype = $_FILES["photo"]["type"];
            $filesize = $_FILES["photo"]["size"];

            // Vérifie l'extension du fichier
            $ext = pathinfo($filename, PATHINFO_EXTENSION);
            if(!array_key_exists($ext, $allowed)) die("Erreur : Veuillez sélectionner un format de fichier valide.");

            // Vérifie la taille du fichier - 5Mo maximum
            $maxsize = 5 * 1980 * 1980;
            if($filesize > $maxsize) die("Error: La taille du fichier est supérieure à la limite autorisée.");

            // Vérifie le type MIME du fichier
            if(in_array($filetype, $allowed)){
                // Vérifie si le fichier existe avant de le télécharger.
                if(file_exists("upload/" . $_FILES["photo"]["name"])){
                    echo $_FILES["photo"]["name"] . " existe déjà.";
                } else{
                    $nom = $_GET['nom'];
                    move_uploaded_file($_FILES["photo"]["tmp_name"], "public/imagesdl/ " . $_FILES["photo"]["name"]);
                    //header('Location: newproduit.php');
                    echo "Votre fichier a été téléchargé avec succès. <a href=\"newproduit.php\">Continuer la création</a>";
                    $_SESSION['filename']=$filename;
                    
                } 
            } else{
                echo "Error: Il y a eu un problème de téléchargement de votre fichier. Veuillez réessayer."; 
            }
        } else{
            echo "Error: " . $_FILES["photo"]["error"];
        }*/
      /*}*/ ?>
    </div>
      <?php
    } else {
      ?>
      <h1>Vous n'avez pas les droits pour pouvoir acceder a cette page</h1>
      <?php
    }
    ?>
</body>
</html>