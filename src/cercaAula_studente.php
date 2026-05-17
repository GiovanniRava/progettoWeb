<?php 
require_once("bootstrap.php");

$search = isset($_GET["search"]) ? $_GET["search"] : "";
$data = isset($_GET["data-lezione"]) ? $_GET["data-lezione"] : date("Y-m-d");

$templateParams["aule"] = $dbh->get_aula_cercata($search, $data);

$templateParams["elencoAule"] = $dbh->get_aule();

$templateParams["header"] = "header_pagine.php";
$templateParams["footer"] = "footer.php";

require("template/cercaAula_studente_base.php");
?>
