<!DOCTYPE html>
<head>
  <meta charset="utf-8">
  <title>Connexion</title>
  <link rel="stylesheet" href="style.css">
  <script src="script.js"></script>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <script src="./assets/vendors/jquery/jquery-3.4.1.min.js"></script>
  <script src="./assets/vendors/bootstrap/js/bootstrap.bundle.min.js"></script>
</head>
<body>
	<header>
		<nav class="navbar navbar-expand-lg navbar-light bg-light">
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item active">
            <a class="navbar-brand" href="#">
              <img src="public\images\logo-CESI.png" width="230" height="70" class="d-inline-block align-top" alt=""> 
            </a>
          </li>
          
        </ul>
        <div class="navbar navbar-light bg-light">
          <form class="form-inline">
              <button class="btn btn-sm btn-outline-secondary"  formaction="Inscription(2).php">Inscription</button>
              <button class="btn btn-sm btn-outline-secondary" formaction="Connexion.php">Connexion</button>
            </form>
        </div>
      </div>
    </nav>
  </header>

      <div align="center">
        <br /><br />
         <h2>Connexion</h2>
         <br /><br />
         <form method="POST" action="controler.php">
            <table>
               <tr>
                  <td align="right">
                     <label for="mail">Email :</label>
                  </td>
                  <td>
                     <input type="text" placeholder="Votre Email" id="mail" name="mail" value="<?php if(isset($mail)) { echo $mail; } ?>" />
                  </td>
               </tr>
               <tr>
                  <td align="right">
                     <label for="mdp">Mot de passe :</label>
                  </td>
                  <td>
                     <input type="password" placeholder="Votre mot de passe" id="mdp" name="mdp" />
                  </td>
               </tr>
               <tr>
                  <td></td>
                  <td align="center">
                     <br />
                     <input type="submit" name="formconnexion" value="Me connecter" />
                  </td>
               </tr>
            </table>
         </form>
         <?php
         include('ConnexionEspaceMembre.php');
         if(isset($erreur)) 
         {
            echo '<br><font color="red">'.$erreur."</font>";
         }
         ?>
      </div>
</body>
</html>