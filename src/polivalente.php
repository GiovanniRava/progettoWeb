<?php
require_once("bootstrap.php");
$templateParams["nome"] = "header_pagine.php";
$templateParams["statistiche"] = $dbh->get_statistiche_polivalente();

require("template/polivalente_base.php");
?>