<?php
	class Utils {
		//sans données
		public static function sendResult($code, $message) {
			header('Access-Control-Allow-Origin: *');
			header('Content-Type: application/json');

			http_response_code($code);

			$result = [
				"code" => $code,
				"message" => $message
			];

			echo json_encode($result, JSON_NUMERIC_CHECK, JSON_UNESCAPED_UNICODE);
		}

		//avec données
		public static function sendJSON($code, $data) {
			header('Access-Control-Allow-Origin: *');
			header('Content-Type: application/json');

			http_response_code($code);

			echo json_encode($data, JSON_NUMERIC_CHECK, JSON_UNESCAPED_UNICODE);
		}
	}
?>