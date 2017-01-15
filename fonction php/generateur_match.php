<?php
//générateur de match aléatoire

require 'connexion_bdd.php';
require 'footballManager.php';
?>
<div align="center">
	<h1>Générateur de match aléatoire</h1>
</div>
<?php
if(isset($_POST['formvalider'])) {
	//fonction rand qui permet de determminé le perdant et le gagant
	$rand = rand(1, 3);

	$vainqueur = rand(1, 5);

	$perdant = rand(1, 5);

	$min = 1;
	//selection de la table + attributs
	$select = $bdd->prepare("SELECT * FROM equipe");
	$select->execute();	
	//boucle pour afficher toutes les équipes+ les points grace aux rand
	while ($equipe=$select->fetch(PDO::FETCH_OBJ)) {
	?>
		<div align="center">
		<h2><?php echo $equipe->nom_equipe;?></h2>
		<h4><?php if ($equipe->id_equipe == $vainqueur){ 
			echo "Gagnant ";
			echo $equipe->points_equipe+$rand. " points";
		}else if ($equipe->id_equipe == $perdant ){ 
			echo "Perdant ";
			echo $equipe->points_equipe+$min. " points";
		}else if (($equipe->id_equipe == $perdant) == ($equipe->id_equipe == $vainqueur)){
			echo $equipe->points_equipe. " points";}
		}
}	
?>
<div align="center">
	<form action="" method="POST"><br>
		<input type="submit" name="formvalider">
	</form>
</div>