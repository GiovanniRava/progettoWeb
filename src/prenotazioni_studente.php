<?php
require_once("bootstrap.php");

$username = strstr($_SESSION["email_utente"], '@', true);
$nome_db = ucwords(str_replace('.', ' ', $username));
$templateParams["prenotazioni"] = $dbh->get_prenotazioni_studente($nome_db);
$templateParams["nome"] = "header_pagine.php";

require("template/prenotazioni_studente_base.php");
?>