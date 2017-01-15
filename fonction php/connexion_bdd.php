<?php

try{
	//connexion a la base de donnée//
	$bdd = new PDO ('mysql:host=localhost;dbname=footballmanager;charset=utf8', 'root','');

}catch (Exception $e){
	//si connexion impossible on affiche ça://
	die('erreur : ' . $e -> getMessage());
}

?>