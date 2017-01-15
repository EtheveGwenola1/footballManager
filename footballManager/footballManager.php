<?php 
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
	<a href="?action=showEquipe">Les equipes</a>
	<a href="?action=showJoueur">Les joueurs</a>
	<a href="?action=match">Match</a>
	</div>
</body>
</html>


<?php
try{
	//connexion a la base de donnée//
	$bdd = new PDO ('mysql:host=localhost;dbname=footballmanager;charset=utf8', 'root','');

}catch (Exception $e){
	//si connexion impossible on affiche ça://
	die('erreur : ' . $e -> getMessage());
}

//selon l'action: //
if(isset($_GET["action"])){
	//si l'action est égale a showequipe//
	if($_GET["action"] == "showEquipe"){
		//lien avec la bdd table equipe//
		$select = $bdd->prepare("SELECT * FROM equipe");
		$select->execute();
		//stock toute les infos dans $equipe sous la forme d'objet//
		while ($equipe=$select->fetch(PDO::FETCH_OBJ)) {
		?>
			<!-- affiche le nom de l'équipe et le nbr de point !-->
			<h2><?php echo $equipe->nom_equipe;?></h2>
			<h4><?php echo $equipe->points_equipe. "points";?></h4>

		<?php
		}
	}

	if($_GET["action"] == "showJoueur"){
		$select = $bdd->prepare("SELECT * FROM joueur");
		$select->execute();

		while ($joueur = $select->fetch(PDO::FETCH_OBJ)){
		?>
			<h2><?php echo $joueur->nom_joueur;?></h2>
			<h4><?php if($joueur->titulaire_joueur !=0){ echo "titulaire";}?></h4>
		<?php

		}
	}

	if($_GET["action"] == "match"){
		$select = $bdd->prepare("SELECT * FROM equipe");
		$select->execute();

		?>
		<br>
		<div align="center">
		<form>
		<legend>Equipe 1</legend>
		<select>
			<option>France</option>
			<option>Allemagne</option>
			<option>Italie</option>
			<option>Angleterre</option>
			<option>Espagne</option>
		</select>
		</form>
		<br>

		<h4>Adversaire:</h4>

		<br>
		<form>
		<legend>Equipe 2</legend>
		<select>
			<option>France</option>
			<option>Allemagne</option>
			<option>Italie</option>
			<option>Angleterre</option>
			<option>Espagne</option>
		</select>
		</form>
		</div>
		<?php
	}
}
?>
