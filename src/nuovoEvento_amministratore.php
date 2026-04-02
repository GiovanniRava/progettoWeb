<?php
require_once("bootstrap.php");

$templateParams["header"] = "header_pagine.php";
$templateParams["aule"] = $dbh->get_aule();
$templateParams["lab"] = $dbh->get_lab();

$errore = '';
if (isset($_POST['submit']) && isset($_POST['aula-lab']) && isset($_POST['data']) && isset($_POST['oraInizio']) &&
    isset($_POST['durataPermanenza']) && isset($_POST['nominativo']) && isset($_POST['descrizioneEvento']) && isset($_FILES['locandina'])) {
    
    $aulaLab = $_POST['aula-lab'];
    $data = $_POST['data'];
    $oraInizio = $_POST['oraInizio'];
    $durata = $_POST['durataPermanenza'];
    $nome = $_POST['nominativo'];
    $descrizione = $_POST['descrizioneEvento'];
    $locandina = $_FILES['locandina']['name'];
    move_uploaded_file($_FILES['locandina']['tmp_name'], UPLOAD_DIR . $locandina);
    
    if (empty($aulaLab) || empty($data) || empty($oraInizio) || empty($durata) || empty($nome) || empty($descrizione) || empty($locandina)){
        $errore = "Devi compilare tutti i campi";
    }
    else {
        $insiemeAule = array_column($templateParams["aule"], 'numeroAula');
        if (in_array($aulaLab, $insiemeAule)) {
            $aula = $aulaLab;
            $laboratorio = null;
        } else {
            $aula = null;
            $laboratorio = $aulaLab;
        }
        $parti = explode(':', $durata);
        $ore = (int)$parti[0];
        $minuti = (int)$parti[1];
        $durataMinuti = ($ore * 60) + $minuti;
        $oraInizio.=":00";

        $dbh->insert_evento($nome, $data, $oraInizio, $durataMinuti, $laboratorio, $aula, $locandina, $descrizione);
        header("Location: nuovoEvento_amministratore.php");
        exit();
    }
}

require("template/nuovoEvento_amministratore_base.php");
?>