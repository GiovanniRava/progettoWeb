<?php
$templateParams["aule"] = $dbh->get_aule();
$templateParams["lab"] = $dbh->get_lab();

$formatoNome = "/^[A-Z][a-zA-Z0-9]+ [A-Z][a-zA-Z0-9]+$/";
$errore = "";
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

        $dbh->insert_prenotazione($nome, $data, $oraInizio, $durataMinuti, $motivazione, $laboratorio, $aula);
        header("Location: prenotazioni_studente.php?inviato=1");
        exit();
    }
    else {
        $errore = "Nominativo non valido. Prova col formato \"Mario Rossi\"";
    }
}

// require("template/nuova_prenotazione_base.php");
?>