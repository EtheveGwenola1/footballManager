<?php 
//lien avec la base de donnée
require 'DB.php';
$DB = new DB();
?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<div align="center">
	<h1>Football Manager</h1>

	<!-- Le href sert a définir le bout de code qui doit être executer quand on clique sur le lien !-->
	<a href="affichage_equipe.php?action=showEquipe">Les equipes</a>
	<a href="affichage_joueur.php?action=showJoueur">Les joueurs</a>
	<a href="generateur_match.php">Match</a>
	</div>
</body>
</html>

