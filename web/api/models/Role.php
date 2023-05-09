<?php
	class Role extends Database {

		/* POST/roles */
		public function setRole($rol_libelle) {
			$pdo = $this->connexion();
			$req = "INSERT INTO t_role (rol_libelle) VALUES (:libelle)";

			$stmt = $pdo->prepare($req);

			$stmt->bindParam(':libelle', $rol_libelle, PDO::PARAM_STR);

			if ($stmt->execute()) {
				return true;
			}

			return false;
			
			$stmt->closeCursor();
		}

		/* GET/roles */
		public function getRoles() {
			$pdo = $this->connexion();
			$req = "SELECT * FROM t_role";

			$stmt = $pdo->prepare($req);
			$stmt->execute();

			$roles = $stmt->fetchAll(PDO::FETCH_ASSOC);
			
			$stmt->closeCursor();

			Utils::sendJSON(200, $roles);
		}

		/* GET/roles/{rol_id} */
		public function getRoleById($rol_id) {
			$pdo = $this->connexion();
			$req = "SELECT * FROM t_role WHERE rol_id = :id";

			$stmt = $pdo->prepare($req);

			$stmt->bindValue(':id', $rol_id, PDO::PARAM_INT);

			$stmt->execute();

			$role = $stmt->fetch(PDO::FETCH_ASSOC);

			$stmt->closeCursor();

			if (empty($role)) {
				Utils::sendResult(204, "Aucun rôle trouvé.");
			} else {
				Utils::sendJSON(200, $role);
			}
		}

		/* (PUT) POST/roles/{rol_id} */
		public function updateRole($rol_id, $rol_libelle) {
			$pdo = $this->connexion();
			$req = "UPDATE t_role SET rol_libelle = :libelle WHERE rol_id = :id";

			$stmt = $pdo->prepare($req);

			$stmt->bindValue(':id', $rol_id, PDO::PARAM_INT);
			$stmt->bindValue(':libelle', $rol_libelle, PDO::PARAM_STR);

			if ($stmt->execute()) {
				return true;
			}

			return false;
			$stmt->closeCursor();
		}

		/* DELETE/roles/{rol_id} */
		public function deleteRole($rol_id) {
			$pdo = $this->connexion();
			$req = "DELETE FROM t_role where rol_id = :id";

			$stmt = $pdo->prepare($req);

			$stmt->bindValue(':id', $rol_id, PDO::PARAM_INT);

			if ($stmt->execute()) {
				return true;
			}

			return false;
			$stmt->closeCursor();
		}
	}
?>