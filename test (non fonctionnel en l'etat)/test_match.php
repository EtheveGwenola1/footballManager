<?php
require 'connexion_bdd.php';
if(isset($_GET["action"])){
if($_GET["action"] == "match"){
	//si on valide//
		if(isset($_GET['formvalider'])) {
			if($id_equipe && $id_equipe_adverse && $date_match && $score){

				/*$Query="INSERT INTO article ('titre', 'description', 'prix') VALUES ('$titre','$description','$prix')";
				print($Query);
				$insert = $bdd->prepare ($Query);
				$insert->execute();*/
				$insert = $bdd->prepare("INSERT INTO joue_contre(id_equipe, id_equipe_adverse, date_match, score) VALUES (:id_equipe, :id_equipe_adverse, :date_match, :score)");
				$erreur = "votre article a bien été ajouter";

			}

				//tout selecectionné de la table joue_contre//
				$match = $bdd->prepare("SELECT * FROM joue_contre");
				$match->execute();

			//fonction rand qui génére les match
			$score = rand(1,3);
			echo $score;
		}

		}

		$select = $bdd->prepare("SELECT id_equipe, nom_equipe FROM equipe");
		$select->execute();	
		?>
		<br>
		<div align="center">
		<form action="?action=match" method="POST">
		<legend>Equipe 1</legend><br>
		<?php
		if ($equipe=$select->fetch(PDO::FETCH_OBJ)) {
			?>
		 <p><?php echo $equipe->id_equipe. ": " .$equipe->nom_equipe;?><p>
		 <?php
		}
		?>
		<br><br>
		<h4>Adversaire:</h4>
		<legend>Equipe 2</legend><br>
			<?php
			while ($equipe = $select->fetch(PDO::FETCH_OBJ)){		
			?>
			<input type="radio" name="id_equipe_adverse"><?php echo $equipe->id_equipe. ": " .$equipe->nom_equipe;?>
		
			<?php
			}
			?>

		<br><br>
		<label>Date du match</label><br>
		<input type="date" name="date_match" placeholder="date du match" /><br><br>
		<input type="submit" name="formvalider">
		</form>
		</div>

		<?php
}
