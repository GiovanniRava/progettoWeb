<?php
/**
 * Funzione che verifica se un utente è loggato, controllando se la variabile di sessione 'utente_loggato' è valorizzata.
 */
function isUserLogged(){
    return !empty($_SESSION['utente_loggato']);
}

/**
 * Funzione che verifica se l'utente loggato è uno studente.
 */
function isStudente(){
    return isset($_SESSION['tipo_utente']) && $_SESSION['tipo_utente'] === "studente";
}

/**
 * Funzione che verifica se l'utente loggato è un amministratore.
 */
function isAdmin(){
    return isset($_SESSION['tipo_utente']) && $_SESSION['tipo_utente'] === "admin";
}

/**
 * Funzione che gestisce il caricamento di un'immagine.
 */
function uploadImage($path, $image){
    $imageName = basename($image["name"]);
    $fullPath = $path.$imageName;
    
    $maxKB = 500;
    $acceptedExtensions = array("jpg", "jpeg", "png", "gif");
    $result = 0;
    $msg = "";
    //Controllo se immagine è veramente un'immagine
    $imageSize = getimagesize($image["tmp_name"]);
    if($imageSize === false) {
        $msg .= "File caricato non è un'immagine! ";
    }
    //Controllo dimensione dell'immagine < 500KB
    if ($image["size"] > $maxKB * 1024) {
        $msg .= "File caricato pesa troppo! Dimensione massima è $maxKB KB. ";
    }

    //Controllo estensione del file
    $imageFileType = strtolower(pathinfo($fullPath,PATHINFO_EXTENSION));
    if(!in_array($imageFileType, $acceptedExtensions)){
        $msg .= "Accettate solo le seguenti estensioni: ".implode(",", $acceptedExtensions);
    }
    //Se non ci sono errori, sposto il file dalla posizione temporanea alla cartella di destinazione
    if(strlen($msg)==0){
        if(!move_uploaded_file($image["tmp_name"], $fullPath)){
            $msg.= "Errore nel caricamento dell'immagine.";
        }
        else{
            $result = 1;
            $msg = $imageName;
        }
    }
    return array($result, $msg);
}
?>