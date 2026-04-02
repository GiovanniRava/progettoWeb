<?php
require_once("bootstrap.php");
$templateParams["nome"] = "header_pagine.php"; 
$templateParams["eventi"] = $dbh->get_eventi(); 
require("template/eventi_admin_base.php");
?>