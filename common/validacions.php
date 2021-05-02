<?php

function nomusuariValid($nomUsuari) {
	$valid = false;

	if (strlen($nomUsuari) >= 8) {
		if (!strpos($nomUsuari, " ") && !strpos($nomUsuari, "'") && !strpos($nomUsuari, "à") && !strpos($nomUsuari, "À") && !strpos($nomUsuari, "á") && !strpos($nomUsuari, "Á") && !strpos($nomUsuari, "è") && !strpos($nomUsuari, "È") && !strpos($nomUsuari, "é") && !strpos($nomUsuari, "É") && !strpos($nomUsuari, "ì") && !strpos($nomUsuari, "Ì") && !strpos($nomUsuari, "í") && !strpos($nomUsuari, "Í") && !strpos($nomUsuari, "ò") && !strpos($nomUsuari, "Ò") && !strpos($nomUsuari, "ó") && !strpos($nomUsuari, "Ó") && !strpos($nomUsuari, "ù") && !strpos($nomUsuari, "Ù") && !strpos($nomUsuari, "ú") && !strpos($nomUsuari, "Ú") && !strpos($nomUsuari, "ñ") && !strpos($nomUsuari, "Ú") && !strpos($nomUsuari, "Ñ") && !strpos($nomUsuari, "ç") && !strpos($nomUsuari, "Ç")) {

			$valid = true;

		}
	}

	return $valid;
}

function seguretatContrasenya($password) {
	$seguretat = -1;
	$majus = false;
	$digits = false;
	$alfanum = false;

	if (strlen($password) >= 8) {
		$seguretat++;

		for ($i = 0; $i < strlen($password); $i++) {

			$ascii = ord(substr($password, $i, 1));

			if ($ascii >= 65 && $ascii <= 90){
				$majus = true;
			} 
			
			if ($ascii >= 48 && $ascii <= 57){
				$digits = true;
			}
			if ($ascii < 97 || $ascii > 122) {
				$alfanum = true;
			}
		}

		if ($majus) {
			$seguretat++;
			if ($digits) {
				$seguretat++;
				if ($alfanum) {
					$seguretat++;
				}
			}
		}
	}
	return $seguretat;
}

function comprovaEmail($funcioEmail) {
	$mail = false;
	$posA = strpos($mail, "@");

	if ($posA > 0 && $posA < strlen($mail) - 1) {

		$domini = substr(strrchr($mail, "."), 1);

		if ($domini == "cat" || $domini == "es" || $domini == "com" || $domini == "net" || $domini == "org") {
			$mail = true;
		}
	}

	return $mail;
}

function comprovaNIF($dni) {
	$valid = false;
	$lletres = "TRWAGMYFPDXBNJZSQVHLCKE";

	if (strlen($dni) == 9) {
		$numero = substr($dni, 0, 8);
		$lletraNIF = strtoupper(substr($dni, 8));
		$lletraObtinguda = substr($lletres, $numero % 23, 1);

		if ($lletraNIF == $lletraObtinguda) {
			$valid = true;
		}
	}

	return $valid;
}

?>