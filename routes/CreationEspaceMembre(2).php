<?php

try{
   $bdd = new PDO('mysql:host=localhost;dbname=projet web;','root','root');
   $retour["sucess"] = true;
   $retour["message"] = "Connexion à la base de donnée reussie";
}
catch(Exception $e){
   $retour["sucess"] = false;
   $retour["message"] = "Connexion à la base de donnée impossible";
   throw new Exception("Error Processing Request", 1);
   
}


if(isset($_POST['forminscription'])) {
   $prenom = htmlspecialchars($_POST['prenom']);
   $nom = htmlspecialchars($_POST['nom']);
   $lieu = htmlspecialchars($_POST['lieu']);
   $mail = htmlspecialchars($_POST['mail']);
   $mail2 = htmlspecialchars($_POST['mail2']);
   $mdp = sha1($_POST['mdp']);
   $mdp2 = sha1($_POST['mdp2']);
   $status = 1;
   $actif = $_POST['cgu'];
   if(!empty($_POST['prenom']) AND !empty($_POST['nom']) AND !empty($_POST['lieu']) AND !empty($_POST['mail']) AND !empty($_POST['mail2']) AND !empty($_POST['mdp']) AND !empty($_POST['mdp2'] AND !empty($_POST['cgu']))) {
      $prenomlength = strlen($prenom);
      $nomlength = strlen($nom);
      if($prenomlength <= 255) {
         if($nomlength <= 255) {
            if($mail == $mail2) {
               if(filter_var($mail, FILTER_VALIDATE_EMAIL)) {
                  $reqmail = $bdd->prepare("SELECT * FROM Users WHERE email = ?");
                  $reqmail->execute(array($mail));
                  $mailexist = $reqmail->rowCount();
                  if($mailexist == 0) {
                     if (preg_match('#^(?=.*[A-Z])(?=.*[0-9])#', $_POST['mdp'])) {
                        if($mdp == $mdp2) {
                           $insertmbr = $bdd->prepare("INSERT INTO Users(Prenom, Nom, Lieu, Email, Mot_de_passe, Status, Actif) VALUES(?, ?, ?, ?, ?, ?, ?)");
                           $insertmbr->execute(array($prenom, $nom, $lieu, $mail, $mdp, $status, $actif));
                           session_start();
                           $_SESSION['User_ID'] = $compte[User_ID];
                           $_SESSION['prenom'] = $compte[Prenom];
                           $_SESSION['nom'] = $nom;
                           $_SESSION['lieu'] = $lieu;
                           $_SESSION['mail'] = $mail;
                           $_SESSION['mdp'] = $_POST['mdp'];
                           $_SESSION['status'] = $compte[Status];
                           $erreur = "Votre compte a bien été créé ! <a href=\"connexion.php\">Me connecter</a>";
                        } else {
                           $erreur = "Vos mots de passes ne correspondent pas !";
                        }
                     } else {
                        $erreur ="Votre Mot de passe doit comporter minimum une Majuscule et un chiffres";
                     }
                  } else {
                     $erreur = "Adresse email déjà utilisée !";
                  }
               } else {
                  $erreur = "Votre adresse email n'est pas valide !";
               }
            } else {
               $erreur = "Vos adresses email ne correspondent pas !";
            }
         } else {
            $erreur = "Votre nom ne doit pas dépasser 255 caractères !";
         }   
      } else {
         $erreur = "Votre prenom ne doit pas dépasser 255 caractères !";
      }
   } else {
      $erreur = "Tous les champs doivent être complétés !";
   }
}
?>
