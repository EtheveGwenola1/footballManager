<?php
//FONCTION A REVOIR!

require 'connexion_bdd.php';
require 'footballManager.php';

if(isset($_GET["action"])){
	if($_GET["action"]== "achat"){
		//selection des attribut dans la bdd
		$select = $bdd->prepare("SELECT est_transfere.montant, joueur.nom_joueur, equipe.nom_equipe FROM est_transfere INNER JOIN joueur ON est_transfere.id_joueur = joueur.id_joueur INNER JOIN equipe ON joueur.id_equipe = equipe.id_equipe;");
		$select->execute();
		//boucle qui affiche tout le joueur + attribut de la table est_transfere
		while ($achat = $select->fetch(PDO::FETCH_OBJ)){		
	?>
		<div align="center">
			<h3><?php echo $achat->montant;?>€</h3>
			<label>Date de transfert:</label><br>
			<input type="date" name="date_transfert" placeholder="date" />
			<p><?php echo "Joueur: " .$achat->nom_joueur;?></p>
			<p><?php echo "Equipe: " .$achat->nom_equipe;?></p>
			<input type="submit" name="submit" value="valider">
		</div>
	<?php
		}
		//fonction de selection de la date de transfert PAS ENCORE AU POINT//
		if(isset($_POST['submit'])){
			$date = $_POST["date_transfert"];

			$modify = $bdd->prepare("UPDATE est_transfere SET date_transfert='$date'");
			$modify->execute();
			echo "L'article a bien été modifier";
		}else{
			echo "L'article n'a pas pu être modifier suite a une erreur";
		}		
	}
}

?>