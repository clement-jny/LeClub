<?php
	class Utilisateur extends Database {

		/* POST/utilisateurs */
		public function setUtilisateur($uti_nom, $uti_prenom, $uti_mail, $uti_mdp) {
			$pdo = $this->connexion();
			$req = "INSERT INTO t_utilisateur (uti_nom, uti_prenom, uti_mail, uti_mdp) VALUES (:nom, :prenom, :mail, :mdp)";

			$stmt = $pdo->prepare($req);

			$stmt->bindParam(':nom', $uti_nom, PDO::PARAM_STR);
			$stmt->bindParam(':prenom', $uti_prenom, PDO::PARAM_STR);
			$stmt->bindParam(':mail', $uti_mail, PDO::PARAM_STR);

			$mdpHash = password_hash($uti_mdp, PASSWORD_BCRYPT);
			$stmt->bindParam(':mdp', $mdpHash, PDO::PARAM_STR);

			if ($stmt->execute()) {
				return true;
			}

			return false;

			$stmt->closeCursor();
		}

		/* GET/utilisateurs */
		public function getUtilisateurs() {
			$pdo = $this->connexion();
			$req = "SELECT * FROM t_utilisateur";
	
			$stmt = $pdo->prepare($req);
			$stmt->execute();
	
			$utilisateurs = $stmt->fetchAll(PDO::FETCH_ASSOC);
			
			$stmt->closeCursor();

			Utils::sendJSON(200, $utilisateurs);
		}
	
		/* GET/utilisateurs/{uti_id} */
		public function getUtilisateurById($uti_id) {
			$pdo = $this->connexion();
			$req = "SELECT * FROM t_utilisateur WHERE uti_id = :id";
	
			$stmt = $pdo->prepare($req);

			$stmt->bindValue(':id', $uti_id, PDO::PARAM_INT);

			$stmt->execute();

			$utilisateur = $stmt->fetch(PDO::FETCH_ASSOC);

			$stmt->closeCursor();

			if (empty($utilisateur)) {
				Utils::sendResult(204, "Aucun utilisateur trouvé.");
			} else {
				Utils::sendJSON(200, $utilisateur);
			}
		}

		/* (PUT) POST/utilisateurs/{uti_id} */
		public function updateUtilisateur($uti_id, $uti_nom, $uti_prenom, $uti_mail, $uti_role) {
			$pdo = $this->connexion();
			$req = "UPDATE t_utilisateur SET
				uti_nom = :nom, uti_prenom = :prenom, uti_mail = :mail, uti_role = :role WHERE uti_id = :id";
			
			$stmt = $pdo->prepare($req);

			$stmt->bindValue(':id', $uti_id, PDO::PARAM_INT);
			$stmt->bindValue(':nom', $uti_nom, PDO::PARAM_STR);
			$stmt->bindValue(':prenom', $uti_prenom, PDO::PARAM_STR);
			$stmt->bindValue(':mail', $uti_mail, PDO::PARAM_STR);
			$stmt->bindValue(':role', $uti_role, PDO::PARAM_INT);

			if ($stmt->execute()) {
				return true;
			}

			return false;
			$stmt->closeCursor();
		}

		/* DELETE/utilisateurs/{uti_id} */
		public function deleteUtilisateur($uti_id) {
			$pdo = $this->connexion();
			$req = "DELETE FROM t_utilisateur where uti_id = :id";

			$stmt = $pdo->prepare($req);

			$stmt->bindValue(':id', $uti_id, PDO::PARAM_INT);

			if ($stmt->execute()) {
				return true;
			}

			return false;
			$stmt->closeCursor();
		}
	}
?>