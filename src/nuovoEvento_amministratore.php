<?php
//require_once("bootstrap.php");
$templateParams["aule"] = $dbh->get_aule();
$templateParams["lab"] = $dbh->get_lab();

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
            $dbh->insert_evento($nome, $data, $oraInizio, $durataMinuti, $laboratorio, $aula, $locandina, $descrizione);
            header("Location: eventi_admin.php?inviato=1");
            exit();
        }
        else {
            $templateParams["errore"] = $msg;
        }
    }
    //da aggiungere anche la modifica di un evento esistente? citato da Delnevo, dicendo che si dovrebbe fare
}

//require("template/nuovoEvento_amministratore_base.php");
?>