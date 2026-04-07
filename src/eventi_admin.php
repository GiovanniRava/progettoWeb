<?php
require_once("bootstrap.php");
$templateParams["header"] = "header_pagine.php";

include("lista_eventi_admin.php");
include("nuovoEvento_amministratore.php");
require("template/eventi_admin_base.php");
?>