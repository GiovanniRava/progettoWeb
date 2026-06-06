<?php
$templateParams["aule"] = $dbh->get_aule();
$templateParams["lab"] = $dbh->get_lab();
$templateParams["azione"] = 0;
$templateParams["id"] = "";
$formatoNome = "/^[A-Z][a-zA-Z0-9]+ [A-Z][a-zA-Z0-9]+$/";

if(isset($_GET["action"]) && isset($_GET["id"])){
    $templateParams["azione"] = intval($_GET["action"]);
    $templateParams["id"] = intval($_GET["id"]);
}

if(isset($templateParams["azione"]) && $templateParams["azione"]==1) {
    $dati = $dbh->get_richiesta_by_cod($templateParams["id"]);
    $templateParams["nominativo"] = $dati["nominativo"];
    $templateParams["data"] = $dati["data"];
    $templateParams["oraInizio"] = date("H:i", strtotime($dati["oraInizio"]));
    $templateParams["durata"] = gmdate("H:i", $dati["durata"]*60);
    $templateParams["motivazione"] = $dati["motivazione"];
    if(isset($dati["numeroLab"])) {
        $templateParams["aula"] = $dati["numeroLab"];
    }
    else {
        $templateParams["aula"] = $dati["numeroAula"];
    }
    $templateParams["form"] = "MODIFICA RICHIESTA PRENOTAZIONE";
    $templateParams["button"] = "MODIFICA RICHIESTA";
}

if (isset($_POST['submit']) && isset($_POST['aula-lab']) && isset($_POST['data']) && isset($_POST['oraInizio']) &&
    isset($_POST['durataPermanenza']) && isset($_POST['nominativo']) && isset($_POST['motivazionePrenotazione'])) {
    
    $aulaLab = $_POST['aula-lab'];
    $data = $_POST['data'];
    $oraInizio = $_POST['oraInizio'];
    $durata = $_POST['durataPermanenza'];
    $nome = $_POST['nominativo'];
    $motivazione = $_POST['motivazionePrenotazione'];
    
    if (empty($aulaLab) || empty($data) || empty($oraInizio) || empty($durata) || empty($nome) || empty($motivazione)){
        $templateParams["errore"] = "Devi compilare tutti i campi";
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

        if(($templateParams["azione"]==1)){
            $dbh->update_richiesta($nome, $data, $oraInizio, $durataMinuti, $motivazione, $laboratorio, $aula, $templateParams["id"]);
            $templateParams["azione"] = 0;
            header("Location: prenotazioni_studente.php?inviato=1");
            exit();
        }
        else {
            $dbh->insert_richiesta_prenotazione($nome, $data, $oraInizio, $durataMinuti, $motivazione, $laboratorio, $aula);
            header("Location: prenotazioni_studente.php?inviato=1");
            exit();
        }
    }
    else {
        $templateParams["errore"] = "Nominativo non valido. Prova col formato \"Mario Rossi\"";
    }
}
?>