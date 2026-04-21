<?php
require_once("bootstrap.php");
$templateParams["header"] = "header_pagine.php";
$templateParams["eventi"] = $dbh->get_eventi();
require("template/eventi_studente_base.php");
?>