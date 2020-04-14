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

session_start();

if(isset($_POST['nvproduit'])) {
   $titre = htmlspecialchars($_POST['titre']);
   $des = htmlspecialchars($_POST['des']);
   $date = htmlspecialchars($_POST['date']);
   $prix = htmlspecialchars($_POST['prix']);
   $nbl = 0;
   $photo =$_SESSION['filename'];


   if(!empty($_POST['titre']) AND !empty($_POST['des']) AND !empty($_POST['date']) AND !empty($_POST['prix']) AND !empty($_SESSION['filename'])) {
      	$titrelength = strlen($titre);
      	$deslength = strlen($des);
      	if($nomlength <= 255) {
         	if($deslength <= 2555) {
         		$reqnom = $bdd->prepare("SELECT * FROM manifestations WHERE titre = ?");
            	$reqnom->execute(array($titre));
            	$prodexist = $reqnom->rowCount();
            	if ( $prodexist == 0 ) {
            		if( $prix > 0 ) {

                     $insertprod = $bdd->prepare("INSERT INTO Manifestationss(Titre, Description, Photo, Ponctuel, Prix, Nombre_de_likes) VALUES(?, ?, ?, ?, ?, ?)");
                     $insertprod->execute(array($titre, $des, $photo, $date, $prix, $nbl));
                     $erreur = "Votre activité a bien été ajouté ! <a href='events.php'>Retourner aux evenements</a>".$_POST['titre'].$_POST['des'].$_POST['prix'].$_POST['date'].$_SESSION['filename'];
            		} else {
               			$erreur = "Le prix doit être superieur à 0 € !";
            		}
            	} else {
            		$erreur = "Ce produit existe déjà !";
            	}
         	} else {
            	$erreur = "Votre nom ne doit pas dépasser 2555 caractères !";
         	}   
      	} else {
         	$erreur = "Votre prenom ne doit pas dépasser 255 caractères !";
      	}
   	} else {
      	$erreur = "Tous les champs doivent être complétés !".$_POST['nom'].$_POST['des'].$_POST['prix'].$_POST['nbs'].$_SESSION['filename'];
   	}
}
?>