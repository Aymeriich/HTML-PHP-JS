<?php
session_start();

if (!isset($_SESSION["carrito"])) $_SESSION["carrito"] = array();

function afegirProducte($vCodi, $vNom, $vPreu, $vQuantitat) {
	$afegit = false;

	if ($vQuantitat >= 1) {
		
		$posicio = buscarProducte($vCodi);
		
		if ($posicio == -1) {
			$nouProducte = array("codi" => $vCodi,"nom" => $vNom,"preu" => $vPreu,"quantitat" => $vQuantitat);
			array_push($_SESSION["carrito"], $nouProducte);
		} else {
			$_SESSION["carrito"][$posicio]["quantitat"] += $vQuantitat;
		}

		$afegit = true;
	}

	return $afegit;
}

function buscarProducte($vCodi) {
	$posicio = -1;

	for ($i = 0; $i < count($_SESSION["carrito"]) && $posicio == -1; $i++) {
		if ($_SESSION["carrito"][$i]["codi"] == $vCodi) $posicio = $i;
	}

	return $posicio;
}

function eliminarProducte($vCodi) {
	$eliminat = false;

	$posicio = buscarProducte($vCodi);

	if ($posicio != -1) {
		unset($_SESSION["carrito"][$posicio]);
		sort($_SESSION["carrito"]);
		$eliminat = true;
	}

	return $eliminat;
}

function importProducte($vCodi) {
	$import = 0;

	$posicio = buscarProducte($vCodi);

	if ($posicio != -1) {
		$import = $_SESSION["carrito"][$posicio]["quantitat"] * $_SESSION["carrito"][$posicio]["preu"];
	}

	return round($import, 2);
}

function importTotal() {
	$import = 0;

	foreach ($_SESSION["carrito"] as $producte) {
		$import += importProducte($producte["codi"]);
	}

	return round($import, 2);
}

?>