<?php
	class Historique extends Database {

		/* POST/historiques */
		public function setHistorique($his_session, $his_utilisateur, $his_date) {
			$pdo = $this->connexion();
			$req = "INSERT INTO t_historique VALUES (:session, :utilisateur, :date)";

			$stmt = $pdo->prepare($req);

			$stmt->bindParam(':session', $his_session, PDO::PARAM_INT);
			$stmt->bindParam(':utilisateur', $his_utilisateur, PDO::PARAM_INT);
			$stmt->bindParam(':date', $uti_mail, PDO::PARAM_STR);

			if ($stmt->execute()) {
				return true;
			}

			return false;
			
			$stmt->closeCursor();
		}

		/* GET/historiques */
		public function getHistoriques() {
			$pdo = $this->connexion();
			$req = "SELECT * FROM t_historique";

			$stmt = $pdo->prepare($req);
			$stmt->execute();

			$historiques = $stmt->fetchAll(PDO::FETCH_ASSOC);

			$stmt->closeCursor();

			Utils::sendJSON(200, $historiques);
		}

		/* GET/historiques/{his_utilisateur} */
		public function getHistoriquesById($his_utilisateur) {
			$pdo = $this->connexion();
			$req = "SELECT * FROM t_historique WHERE his_utilisateur = :id";

			$stmt = $pdo->prepare($req);

			$stmt->bindValue(':id', $his_utilisateur, PDO::PARAM_INT);

			$stmt->execute();

			$historiques = $stmt->fetchAll(PDO::FETCH_ASSOC);

			$stmt->closeCursor();

			if (empty($historiques)) {
				Utils::sendResult(204, "Aucun historique trouvé pour l'utilisateur.");
			} else {
				Utils::sendJSON(200, $historiques);
			}
		}

		/* (PUT) POST/historiques/{his_session}/{his_utilisateur} */
		public function updateHistorique($his_session, $his_utilisateur, $his_date) {
			$pdo = $this->connexion();
			$req = "UPDATE t_historique SET his_date = :date WHERE his_session = :session AND his_utilisateur = :utilisateur";
			
			$stmt = $pdo->prepare($req);

			$stmt->bindValue(':session', $his_session, PDO::PARAM_INT);
			$stmt->bindValue(':utilisateur', $his_utilisateur, PDO::PARAM_INT);
			$stmt->bindValue(':date', $his_date, PDO::PARAM_STR);

			if ($stmt->execute()) {
				return true;
			}

			return false;
			$stmt->closeCursor();
		}

		/* DELETE/historiques/{his_session}/{his_utilisateur} */
		public function deleteHistorique($his_session, $his_utilisateur) {
			$pdo = $this->connexion();
			$req = "DELETE FROM t_historique WHERE his_session = :ses AND his_utilisateur = :uti";

			$stmt = $pdo->prepare($req);

			$stmt->bindValue(':ses', $his_session, PDO::PARAM_INT);
			$stmt->bindValue(':uti', $his_utilisateur, PDO::PARAM_INT);

			if ($stmt->execute()) {
				return true;
			}

			return false;
			$stmt->closeCursor();
		}
	}