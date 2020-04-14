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


if(isset($_POST['formconnexion'])) {
   $mail = htmlspecialchars($_POST['mail']);
   $mdp = sha1($_POST['mdp']);
   if( !empty($_POST['mail']) AND !empty($_POST['mdp'])) {
      if(filter_var($mail, FILTER_VALIDATE_EMAIL)) {
         $reqmail = $bdd->prepare("SELECT * FROM Users WHERE email = ?");
         $reqmail->execute(array($mail));
         $mailexist = $reqmail->rowCount();
         if($mailexist == 1) {
            
            $compte = $reqmail->fetch();
            if($mdp == $compte[Mot_de_passe]) {
               session_start();
               $_SESSION['User_ID'] = $compte[User_ID];
               $_SESSION['prenom'] = $compte[Prenom];
               $_SESSION['nom'] = $compte[Nom];
               $_SESSION['lieu'] = $compte[Lieu];
               $_SESSION['mail'] = $compte[Email];
               $_SESSION['status'] = $compte[Status];
               $erreur = "Vous etes connectés";
               header('Location: accueil.php');
            } else {
               $erreur = "Votre adresse email ou mot de passe est incorrect !";
            }
         } else {
            $erreur = "Votre adresse email ou mot de passe est incorrect !";
         }
      } else {
         $erreur = "Votre adresse email n'est pas valide !";
      }
   } else {
      $erreur = "Tous les champs doivent être complétés !";
   }
}
?>
