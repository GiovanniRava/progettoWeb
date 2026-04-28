<?php
require_once("bootstrap.php");

$username = strstr($_SESSION["email_utente"], '@', true);
$nome_db = ucwords(str_replace('.', ' ', $username));

$search = isset($_GET["search"]) && !empty($_GET["search"]) ? $_GET["search"] : null;
$data = isset($_GET["data-prenotazione"]) && !empty($_GET["data-prenotazione"]) ? $_GET["data-prenotazione"] : null;

if($search === null || $data === null) {
    $templateParams["prenotazioni"] = $dbh->get_prenotazioni_admin();
} else {
    $templateParams["prenotazioni"] = $dbh->get_prenotazioni_filtrate_admin($search, $data);
}

$templateParams["search_selezionata"] = $search;
$templateParams["data_selezionata"] = $data;

$templateParams["elencoAule"] = $dbh->get_aule();
$templateParams["elencoLab"] = $dbh->get_lab();

$templateParams["header"] = "header_pagine.php";
$templateParams["footer"] = "footer.php";


if (isset($_POST['nome_da_eliminare'])) {
    $codice = $_POST['nome_da_eliminare'];
    $dbh->delete_prenotazione($codice);
    header("Location: listaPrenotazioni_admin.php");
    exit();
}

require("template/listaPrenotazioni_admin_base.php");
?>