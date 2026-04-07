<?php
require_once("bootstrap.php");
$templateParams["header"] = "header_pagine.php";

include("listaPrenotazioni_studente.php");
include("nuova_prenotazione.php");
require("template/prenotazioni_studente_base.php");
?>