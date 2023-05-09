<?php
	class Sport extends Database {

		/* POST/sports */
		public function setSport($spo_libelle, $spo_nbmax) {
			$pdo = $this->connexion();
			$req = "INSERT INTO t_sport (spo_libelle, spo_nbmax) VALUES (:libelle, :nbmax)";

			$stmt = $pdo->prepare($req);

			$stmt->bindParam(':libelle', $spo_libelle, PDO::PARAM_STR);
			$stmt->bindParam(':nbmax', $spo_nbmax, PDO::PARAM_INT);

			if ($stmt->execute()) {
				return true;
			}

			return false;
			
			$stmt->closeCursor();
		}

		/* GET/sports */
		public function getSports() {
			$pdo = $this->connexion();
			$req = "SELECT * FROM t_sport";

			$stmt = $pdo->prepare($req);
			$stmt->execute();

			$sports = $stmt->fetchAll(PDO::FETCH_ASSOC);

			$stmt->closeCursor();

			Utils::sendJSON(200, $sports);
		}

		/* GET/sports/{spo_id} */
		public function getSportById($spo_id) {
			$pdo = $this->connexion();
			$req = "SELECT * FROM t_sport WHERE spo_id = :id";

			$stmt = $pdo->prepare($req);

			$stmt->bindValue(':id', $spo_id, PDO::PARAM_INT);

			$stmt->execute();

			$sport = $stmt->fetch(PDO::FETCH_ASSOC);

			$stmt->closeCursor();

			if (empty($sport)) {
				Utils::sendResult(204, "Aucun sport trouvé.");
			} else {
				Utils::sendJSON(200, $sport);
			}
		}

		/* (PUT) POST/sports/{spo_id} */
		public function updateSport($spo_id, $spo_libelle, $spo_nbmax) {
			$pdo = $this->connexion();
			$req = "UPDATE t_sport SET spo_libelle = :libelle, spo_nbmax = :nbmax WHERE spo_id = :id";
			
			$stmt = $pdo->prepare($req);

			$stmt->bindValue(':id', $spo_id, PDO::PARAM_INT);
			$stmt->bindValue(':libelle', $spo_libelle, PDO::PARAM_STR);
			$stmt->bindValue(':nbmax', $spo_nbmax, PDO::PARAM_INT);

			if ($stmt->execute()) {
				return true;
			}

			return false;
			$stmt->closeCursor();
		}

		/* DELETE/sports/{spo_id} */
		public function deleteSport($spo_id) {
			$pdo = $this->connexion();
			$req = "DELETE FROM t_sport where spo_id = :id";

			$stmt = $pdo->prepare($req);

			$stmt->bindValue(':id', $spo_id, PDO::PARAM_INT);

			if ($stmt->execute()) {
				return true;
			}

			return false;
			$stmt->closeCursor();
		}
	}
?>