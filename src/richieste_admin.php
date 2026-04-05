<?php
require_once("bootstrap.php");
$templateParams["nome"] = "header_pagine.php";
$templateParams["richieste_in_corso"] = $dbh->getRichiesteInCorso();

require("template/richieste_admin_base.php");
?>