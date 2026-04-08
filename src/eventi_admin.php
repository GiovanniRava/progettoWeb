<?php
require_once("bootstrap.php");
$templateParams["header"] = "header_pagine.php";
$templateParams["footer"] = "footer.php";

include("lista_eventi_admin.php");
include("nuovoEvento_amministratore.php");
require("template/eventi_admin_base.php");
?>