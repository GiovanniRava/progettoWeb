<?php
//require_once("bootstrap.php");
$templateParams["aule"] = $dbh->get_aule();
$templateParams["lab"] = $dbh->get_lab();
$templateParams["azione"] = 0;

if(isset($_GET["action"])){
    $templateParams["azione"] = $_GET["action"];
}

if(isset($templateParams["azione"]) && $templateParams["azione"]==1) {
    $dati = $dbh->get_evento_by_title($_GET["id"]);
    $templateParams["titolo"] = $dati["titolo"];
    $templateParams["data"] = $dati["data"];
    $templateParams["oraInizio"] = date("H:i", strtotime($dati["oraInizio"]));
    $templateParams["durata"] = gmdate("H:i", $dati["durata"]*60);
    $templateParams["descrizione"] = $dati["descrizione"];
    if(isset($dati["numeroLab"])) {
        $templateParams["aula"] = $dati["numeroLab"];
    }
    else {
        $templateParams["aula"] = $dati["numeroAula"];
    }
    $templateParams["form"] = "MODIFICA EVENTO";
    $templateParams["button"] = "MODIFICA EVENTO";
}

if (isset($_POST['submit']) && isset($_POST['aula-lab']) && isset($_POST['data']) && isset($_POST['oraInizio']) &&
    isset($_POST['durataPermanenza']) && isset($_POST['nominativo']) && isset($_POST['descrizioneEvento']) && isset($_FILES['locandina'])) {
    
    $aulaLab = $_POST['aula-lab'];
    $data = $_POST['data'];
    $oraInizio = $_POST['oraInizio'];
    $durata = $_POST['durataPermanenza'];
    $nome = $_POST['nominativo'];
    $descrizione = $_POST['descrizioneEvento'];
    $image = $_FILES['locandina']['tmp_name'];

    if (empty($aulaLab) || empty($data) || empty($oraInizio) || empty($durata) || empty($nome) || empty($descrizione) || empty($image)){
        $templateParams["errore"] = "Devi compilare tutti i campi";
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

        list($result, $msg) = uploadImage(UPLOAD_DIR, $_FILES['locandina']);
        if($result != 0){
            $locandina = $msg;
            if(($templateParams["azione"]==1)){
                $dbh->update_evento($nome, $data, $oraInizio, $durataMinuti, $laboratorio, $aula, $locandina, $descrizione, $_GET["id"]);
                $templateParams["azione"] = 0;
                header("Location: eventi_admin.php?inviato=1");
                exit();
            }
            else {
                $dbh->insert_evento($nome, $data, $oraInizio, $durataMinuti, $laboratorio, $aula, $locandina, $descrizione);
                header("Location: eventi_admin.php?inviato=1");
                exit();
            }
        }
        else {
            $templateParams["errore"] = $msg;
        }
    }
    //da aggiungere anche la modifica di un evento esistente? citato da Delnevo, dicendo che si dovrebbe fare, pena penalizzazione
}

//require("template/nuovoEvento_amministratore_base.php");
?>