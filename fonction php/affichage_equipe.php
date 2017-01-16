<?php
require 'connexion_bdd.php';
require 'index.php';

if(isset($_GET["action"])){
	//si l'action est égale a showequipe//
	if($_GET["action"] == "showEquipe"){
		//lien avec la bdd table equipe//
		$select = $bdd->prepare("SELECT * FROM equipe");
		$select->execute();
		//stock toute les infos dans $equipe sous la forme d'objet//
		while ($equipe=$select->fetch(PDO::FETCH_OBJ)) {
		?>
			<div align="center">
			<!-- affiche le nom de l'équipe et le nbr de point !-->
			<h2><?php echo $equipe->nom_equipe;?></h2>
			<h4><?php echo $equipe->points_equipe. "points";?></h4>
			</div>
		<?php
		}
	}
}

?>