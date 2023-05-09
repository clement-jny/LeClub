<?php
	class Session extends Database {

		/* POST/sessions */
		public function setSession($ses_date, $ses_heure, $ses_sport) {
			$pdo = $this->connexion();
			$req = "INSERT INTO t_session (ses_date, ses_heure, ses_sport) VALUES (:date, :heure, :sport)";

			$stmt = $pdo->prepare($req);

			$stmt->bindParam(':date', $ses_date, PDO::PARAM_STR);
			$stmt->bindParam(':heure', $ses_heure, PDO::PARAM_STR);
			$stmt->bindParam(':sport', $ses_sport, PDO::PARAM_INT);

			if ($stmt->execute()) {
				return true;
			}

			return false;
			
			$stmt->closeCursor();
		}

		/* GET/sessions */
		public function getSessions() {
			$pdo = $this->connexion();
			$req = "SELECT * FROM t_session";

			$stmt = $pdo->prepare($req);
			$stmt->execute();

			$sessions = $stmt->fetchAll(PDO::FETCH_ASSOC);

			$stmt->closeCursor();

			Utils::sendJSON(200, $sessions);
		}

		/* GET/sessions/{ses_id} */
		public function getSessionById($ses_id) {
			$pdo = $this->connexion();
			$req = "SELECT * FROM t_session WHERE ses_id = :id";
	
			$stmt = $pdo->prepare($req);

			$stmt->bindValue(':id', $ses_id, PDO::PARAM_INT);

			$stmt->execute();

			$session = $stmt->fetch(PDO::FETCH_ASSOC);

			$stmt->closeCursor();

			if (empty($session)) {
				Utils::sendResult(204, "Aucune session trouvée.");
			} else {
				Utils::sendJSON(200, $session);
			}
		}

		/* (PUT) POST/sessions/{ses_id} */
		public function updateSession($ses_id, $ses_date, $ses_heure, $ses_sport) {
			$pdo = $this->connexion();
			$req = "UPDATE t_session SET ses_date = :date, ses_heure = :heure, ses_sport = :sport WHERE ses_id = :id";
			
			$stmt = $pdo->prepare($req);

			$stmt->bindValue(':id', $ses_id, PDO::PARAM_INT);
			$stmt->bindValue(':date', $ses_date, PDO::PARAM_STR);
			$stmt->bindValue(':heure', $ses_heure, PDO::PARAM_STR);
			$stmt->bindValue(':sport', $ses_sport, PDO::PARAM_INT);

			if ($stmt->execute()) {
				return true;
			}

			return false;
			$stmt->closeCursor();
		}

		/* DELETE/sessions/{ses_id} */
		public function deleteSession($ses_id) {
			$pdo = $this->connexion();
			$req = "DELETE FROM t_session where ses_id = :id";

			$stmt = $pdo->prepare($req);

			$stmt->bindValue(':id', $ses_id, PDO::PARAM_INT);

			if ($stmt->execute()) {
				return true;
			}

			return false;
			$stmt->closeCursor();
		}
	}
?>