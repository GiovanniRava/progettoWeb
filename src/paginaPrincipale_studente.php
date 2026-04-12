<?php 
require_once("bootstrap.php"); 

$templateParams["header"] = "header_pagine.php";
$templateParams["footer"] = "footer.php"; 
$templateParams["lezioni"] = $dbh->get_lezioni_in_corso();

require("template/paginaPrincipale_studente_base.php");
?>
