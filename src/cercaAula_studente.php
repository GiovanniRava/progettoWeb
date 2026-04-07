<?php 
require_once("bootstrap.php");

//recupero i valori di search e della data nel caso in cui siano stati inseriti
$search = isset($_GET["search"]) ? $_GET["search"] : "";
$data = isset($_GET["data-lezione"]) ? $_GET["data-lezione"] : date("Y-m-d");

$templateParams["aule"] = $dbh->get_aula_cercata($search, $data);

require("template/cercaAulaStudente.php");
?>
