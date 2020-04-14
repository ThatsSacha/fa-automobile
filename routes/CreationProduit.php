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
   $nom = htmlspecialchars($_POST['nom']);
   $des = htmlspecialchars($_POST['des']);
   $prix = htmlspecialchars($_POST['prix']);
   $nbs = htmlspecialchars($_POST['nbs']);
   $photo =$_SESSION['filename'];
   $nbv = 0;

   if(!empty($_POST['nom']) AND !empty($_POST['des']) AND !empty($_POST['prix']) AND !empty($_POST['nbs']) AND !empty($_SESSION['filename'])) {
      	$nomlength = strlen($nom);
      	$deslength = strlen($des);
      	if($nomlength <= 255) {
         	if($deslength <= 2555) {
         		$reqnom = $bdd->prepare("SELECT * FROM produits WHERE nom = ?");
            	$reqnom->execute(array($nom));
            	$prodexist = $reqnom->rowCount();
            	if ( $prodexist == 0 ) {
            		if( $prix > 0 ) {
               			if( $nbs > 0 ) {
                  			if($nbv == 0) {
                           		$insertprod = $bdd->prepare("INSERT INTO Produits(Nom, Description, Photo, Prix, Nombre_en_stock, Nombre_Vendu) VALUES(?, ?, ?, ?, ?, ?)");
                           		$insertprod->execute(array($nom, $des, $photo, $prix, $nbs, $nbv));
                           		$_GET['filename'] = $photo;
                           		$erreur = "Votre produit a bien été ajouté ! <a href='boutique.php'>Retourner à la boutique</a>";
                  			} else {
                     			$erreur = "tqt pour la photo je fais ca apres !";
                  			}
               			} else {
                  			$erreur = "Le nombre de produit en stock doit être superieur à 0 !";
               			}
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