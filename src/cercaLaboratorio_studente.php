<?php 
require_once("bootstrap.php"); 

$search = isset($_GET["search"]) ? $_GET["search"] : "";
$data = isset($_GET["data-lezione"]) ? $_GET["data-lezione"] : date("Y-m-d");

$templateParams["laboratori"] = $dbh->get_laboratorio_cercato($search, $data);

$templateParams["header"] = "header_pagine.php";
$templateParams["footer"] = "footer.php";
require("template/cercaLaboratorio_studente_base.php");
?>