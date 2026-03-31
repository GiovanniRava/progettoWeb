<?php
require_once("bootstrap.php");

$templateParams["header"] = "header_pagine.php";

$formatoNome = "/^[A-Z][a-zA-Z0-9]+ [A-Z][a-zA-Z0-9]+$/";
$errore = '';
if (isset($_POST['submit']) && isset($_POST['aula-lab']) && isset($_POST['data']) && isset($_POST['oraInizio']) &&
    isset($_POST['durataPermanenza']) && isset($_POST['nominativo']) && isset($_POST['motivazionePrenotazione'])) {
    
    $aulaLab = $_POST['aula-lab'];
    $data = $_POST['data'];
    $oraInizio = $_POST['oraInizio'];
    $durata = $_POST['durataPermanenza'];
    $nome = $_POST['nominativo'];
    $motivazione = $_POST['motivazionePrenotazione'];
    
    if (empty($aulaLab) || empty($data) || empty($oraInizio) || empty($durata) || empty($nome) || empty($motivazione)){
        $errore = "Devi compilare tutti i campi";
    }
    else if (preg_match($formatoNome, $nome)) {
        
    }
    else {
        $errore = "Email non valida. Usa un formato come nome.cognome@unibo.it oppure nome.cognome@studio.unibo.it";
    }
}

require("template/nuova_prenotazione_base.php");
?>