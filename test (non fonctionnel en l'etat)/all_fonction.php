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
			<div align="center">
			<!-- affiche le nom de l'équipe et le nbr de point !-->
			<h2><?php echo $equipe->nom_equipe;?></h2>
			<h4><?php echo $equipe->points_equipe. "points";?></h4>
			</div>
		<?php
		}
	}

	if($_GET["action"] == "showJoueur"){
		$select = $bdd->prepare("SELECT joueur.nom_joueur, joueur.poste_joueur, joueur.titulaire_joueur, equipe.nom_equipe  FROM joueur INNER JOIN equipe ON joueur.id_equipe = equipe.id_equipe ORDER BY equipe.nom_equipe");
		$select->execute();

		while ($joueur = $select->fetch(PDO::FETCH_OBJ)){		
		?>
			<div align="center">
			<h2><?php echo $joueur->nom_joueur;?></h2>
			<h3><?php echo "Equipe: " .$joueur->nom_equipe;?></h3>
			<h4><?php if($joueur->titulaire_joueur !=0){ echo "titulaire";}?></h4>
			<h5><?php echo $joueur->poste_joueur;?></h5>
			<a href="?action=achat"><input type="submit" name="achat" value="achat"></a>
			</div>
		<?php
		}
	}
	if($_GET["action"]== "achat"){

		$select = $bdd->prepare("SELECT est_transfere.montant, joueur.nom_joueur, equipe.nom_equipe FROM est_transfere INNER JOIN joueur ON est_transfere.id_joueur = joueur.id_joueur INNER JOIN equipe ON joueur.id_equipe = equipe.id_equipe;");
		$select->execute();

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
		if(isset($_POST['submit'])){

			$date = $_POST["date_transfert"];

			$modify = $bdd->prepare("UPDATE est_transfere SET date_transfert='$date'");
			$modify->execute();
			echo "L'article a bien été modifier";

			}else{
				echo "L'article n'a pas pu être modifier suite a une erreur";
			}		
	}

		if($_GET["action"] == "match"){
			if(isset($_POST['formvalider'])) {
		$select = $bdd->prepare("SELECT * FROM equipe");
		$select->execute();

		?>
		<br>
		<div align="center">
		<form action="" method="POST">
		<legend>Equipe 1</legend>
		<select>
			<option value="France">France</option>
			<option value="Allemagne">Allemagne</option>
			<option value="Italie">Italie</option>
			<option value="Angleterre">Angleterre</option>
			<option value="Espagne">Espagne</option>
		</select>
		</form>
		<br>

		<h4>Adversaire:</h4>

		<br>
		<form action="" methode="POST">
		<legend>Equipe 2</legend>
		<select>
			<option>France</option>
			<option>Allemagne</option>
			<option>Italie</option>
			<option>Angleterre</option>
			<option>Espagne</option>
		</select><br>
		<a href="?action=showequipe"><input type="submit" name="formvalider"></a>
		</form>
		</div>
		<?php
				
			$rand = rand();
			$max = getrandmax();
			echo $rand. "/".$max;
		}else echo "NON";
	
	}
}
?>

