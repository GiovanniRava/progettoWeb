<?php
require_once("bootstrap.php");

$dominio_studente = "/^[a-zA-Z0-9]+\.[a-zA-Z0-9]+@studio\.unibo\.it$/";
$dominio_admin = "/^[a-zA-Z0-9]+\.[a-zA-Z0-9]+@unibo\.it$/";
$pass_admin_corretta = "abcdef";      
$pass_studente_corretta = "123456";
$errore = '';

if (isset($_POST['submit']) && isset($_POST['email']) && isset($_POST['password'])) {
    
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    
    if (empty($email) || empty($password)) {
        $errore = "Devi compilare tutti i campi";
    }
    else if (preg_match($dominio_studente, $email)) {
        if ($password === $pass_studente_corretta) {
            $_SESSION['utente_loggato'] = true;
            $_SESSION['email_utente'] = $email;
            $_SESSION['tipo_utente'] = "studente";
            
            header("Location: paginaPrincipale_studente.php");
            exit();
        } else {
            $errore = "password non valida";
        }
    }
    else if (preg_match($dominio_admin, $email)) {
        if ($password === $pass_admin_corretta) {
            $_SESSION['utente_loggato'] = true;
            $_SESSION['email_utente'] = $email;
            $_SESSION['tipo_utente'] = "admin";
            
            header("Location: infoGenerali_amministratore.php");
            exit();
        } else {
            $errore = "password non valida";
        }
    }
    else {
        $errore = "Email non valida. Usa un formato come nome.cognome@unibo.it oppure nome.cognome@studio.unibo.it";
    }
}
require("template/login_base.php");
?>