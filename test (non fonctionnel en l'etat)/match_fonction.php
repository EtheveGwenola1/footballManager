<?php
require 'connexion_bdd.php';
require 'footballManager.php';

if(isset($_GET["action"])){
	if($_GET["action"] == "match"){
		//tout selecectionné de la table joue_contre//
		$match = $bdd->prepare("SELECT * FROM joue_contre");
		$match->execute();

		$req = $bdd->prepare ('INSERT INTO joue_contre(id_equipe, id_equipe_adverse, date_match, score) VALUES (:id_equipe, :id_equipe_adverse, :date_match, :score)');

			if(isset($_GET['id_equipe']) && $_GET['id_equipe_adverse'] && $_GET['date_match'] && $_GET['score']!= NULL) {

			 	$req->execute(array( 
			 		'id_equipe' => $_GET['id_equipe'],             
			 		'id_equipe_adverse' => $_GET['id_equipe_adverse'],             
			 		'date_match' => $_GET['date_match'],
			 		'score' => $_GET['score']        
				));  
			
				echo "article ok";
			}else  echo 'recommence';
		//si on valide//
		if(isset($_GET['formvalider'])) {

			//fonction rand qui génére les match
			$score = rand(1,3);
			echo $score;
		}

		$select = $bdd->prepare("SELECT id_equipe, nom_equipe FROM equipe");
		$select->execute();	
		?>
		<br>
		<div align="center">
		<form action="?action=match" method="GET">
		<legend>Equipe 1</legend><br>
		<?php
		if ($equipe=$select->fetch(PDO::FETCH_OBJ)) {
		 echo $equipe->id_equipe. ": " .$equipe->nom_equipe;
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
		<a href="#"><input type="submit" name="formvalider"></a>
		</form>
		</div>

		<?php
	}
}
?>