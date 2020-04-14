<?php
//include('controler.php');
// Je commente ici le session_start car je l'ai mit dans controler.php et j'inclus controler.php dans cette page
//session_start();
?>
<!DOCTYPE html>
<head>
  <meta charset="utf-8">
  <title>Insciption</title>
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
         <h2>Inscription</h2>
         <br /><br />
         <form method="POST" action="controler.php">
            <table>
              <tr>
                <td align="right">
                  <label for="prenom">Prenom :</label>
                </td>
                <td>
                  <input type="text" placeholder="Votre prenom" id="prenom" name="prenom" value="<?php if(isset($prenom)) { echo $prenom; } ?>" />
                </td>
              </tr>
              <tr>
                <td align="right">
                  <label for="nom">Nom :</label>
                </td>
                <td>
                  <input type="text" placeholder="Votre nom" id="nom" name="nom" value="<?php if(isset($nom)) { echo $nom; } ?>" />
                </td>
              </tr>
              <tr>
                <td align="right">
                  <label for="lieu">Lieu :</label>
                </td>
                <td>
                    <select name="lieu">
                     <option value="">Selectionner</option>
                     <option value='Aix-En-Provence'>Aix-En-Provence</option>
                     <option value='Arras'>Arras</option>
                     <option value='Brest'>Brest</option>
                     <option value='Nanterre'>Nanterre</option>
                     <option value='Nice'>Nice</option>
                     <option value='Lille'>Lille</option>
                     <option value='Nancy'>Nancy</option>
                     <option value='Strasbourg'>Strasbourg</option>
                     <option value='Bordeaux'>Bordeaux</option>
                    </select>
                </td>
               </tr>
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
                     <label for="mail2">Confirmation de l'Email :</label>
                  </td>
                  <td>
                     <input type="text" placeholder="Confirmez votre mail" id="mail2" name="mail2" value="<?php if(isset($mail2)) { echo $mail2; } ?>" />
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
                  <td align="right">
                     <label for="mdp2">Confirmation du mot de passe :</label>
                  </td>
                  <td>
                     <input type="password" placeholder="Confirmez votre mdp" id="mdp2" name="mdp2" />
                  </td>
               </tr>
               <tr>
                <td>
                  <input type="checkbox" name="cgu" id="cgu" /> 
                     <label for="cgu">J'accepte les <a href="conditions.php"target="_blank"> les conditions generales d'utilisation</a>
                     </label>
                </td>
                </tr>
               <tr>
                  <td></td>
                  <td align="center">
                     <br />
                     <input type="submit" name="forminscription" value="Je m'inscris" />
                  </td>
               </tr>
            </table>
         </form>
         <br>
         <?php
         include('CreationEspaceMembre(2).php');
         if(isset($erreur)) 
         {
            echo '<font color="red">'.$erreur."</font>";
         }
         ?>
      </div>
</body>
</html>