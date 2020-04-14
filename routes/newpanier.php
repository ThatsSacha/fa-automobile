<?php
session_start();


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

$reqpanier = $bdd->prepare("INSERT INTO Panier(User_ID, Produit_ID) VALUES(?, ?)");
$reqpanier->execute(array($_SESSION['User_ID'], $_SESSION['Produit_ID']));

?>