<?php
require 'connexion_bdd.php';
require 'footballManager.php';

if(isset($_GET["action"])){
	if($_GET["action"] == "showJoueur"){
		//selection dans la base de donnée
		$select = $bdd->prepare("SELECT joueur.nom_joueur, joueur.poste_joueur, joueur.titulaire_joueur, equipe.nom_equipe  FROM joueur INNER JOIN equipe ON joueur.id_equipe = equipe.id_equipe ORDER BY equipe.nom_equipe");
		$select->execute();
		//boucle pour afficher toutes les equipes+bouton d'achat
		while ($joueur = $select->fetch(PDO::FETCH_OBJ)){		
		?>
			<div align="center">
			<h2><?php echo $joueur->nom_joueur;?></h2>
			<h3><?php echo "Equipe: " .$joueur->nom_equipe;?></h3>
			<h4><?php if($joueur->titulaire_joueur !=0){ echo "titulaire";}?></h4>
			<h5><?php echo $joueur->poste_joueur;?></h5>
			<a href="achat_fonction.php?action=achat"><input type="submit" name="achat" value="achat"></a>
			</div>
		<?php
		}
	}
}

?>