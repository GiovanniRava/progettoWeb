<?php
require_once("bootstrap.php");

$username = strstr($_SESSION["email_utente"], '@', true);
$nome_db = ucwords(str_replace('.', ' ', $username));
$templateParams["prenotazioni"] = $dbh->get_prenotazioni_studente($nome_db);
$templateParams["header"] = "header_pagine.php";
if (isset($_POST['nome_da_eliminare'])) {
    $codice = $_POST['nome_da_eliminare'];
    $dbh->delete_prenotazione($codice);
    header("Location: prenotazioni_studente.php");
    exit();
}

// require("template/listaPrenotazioni_studente_base.php");
?>