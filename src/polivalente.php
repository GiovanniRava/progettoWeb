<?php
require_once("bootstrap.php");
$templateParams["header"] = "header_pagine.php";
$templateParams["statistiche"] = $dbh->get_statistiche_polivalente();

require("template/polivalente_base.php");
?>