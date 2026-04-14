<?php
require_once("bootstrap.php");
$templateParams["footer"] = "footer.php";
$templateParams["login"] = "login_base.php";

$dominio_studente = "/^[a-zA-Z0-9]+\.[a-zA-Z0-9]+@studio\.unibo\.it$/";
$dominio_admin = "/^[a-zA-Z0-9]+\.[a-zA-Z0-9]+@unibo\.it$/";
$pass_admin_corretta = "abcdef";
$pass_studente_corretta = "123456";

//aggiungere controllo su admin esistenti nel database? quindi aggiungere la tabella admin nel database in cui salvare i nomi e le
//rispettive password di chi può entrare come admin.

if (isset($_POST['submit']) && isset($_POST['email']) && isset($_POST['password'])) {

    $email = trim($_POST['email']);
    $password = $_POST['password'];

    if (empty($email) || empty($password)) {
        $templateParams["errore"] = "Devi compilare tutti i campi";
    } else if (preg_match($dominio_studente, $email)) {
        $studente = $dbh->getStudente($email);
        if ($studente === null) {
            $templateParams["errore"] = "Studente Non Trovato";
        } else if ($studente['password'] === $password) {
            $_SESSION['utente_loggato'] = true;
            $_SESSION['email_utente'] = $email;
            $_SESSION['tipo_utente'] = "studente";

            header("Location: paginaPrincipale_studente.php");
            exit();
        } else {
            $templateParams["errore"] = "password non valida";
        }
    } else if (preg_match($dominio_admin, $email)) {
        $admin = $dbh->getAmministratore($email);
        if ($admin === null) {
            $templateParams["errore"] = "Amministratore Non Trovato";
        } else if ($admin['password'] === $password) {
            $_SESSION['utente_loggato'] = true;
            $_SESSION['email_utente'] = $email;
            $_SESSION['tipo_utente'] = "admin";

            header("Location: paginaPrincipale_amministratore.php");
            exit();
        } else {
            $templateParams["errore"] = "password non valida";
        }
    } else {
        $templateParams["errore"] = "Email non valida. Usa un formato come nome.cognome@unibo.it oppure nome.cognome@studio.unibo.it";
    }


    // if (empty($email) || empty($password)) {
    //     $templateParams["errore"] = "Devi compilare tutti i campi";
    // }
    // else if (preg_match($dominio_studente, $email)) {
    //     if ($password === $pass_studente_corretta) {
    //         $_SESSION['utente_loggato'] = true;
    //         $_SESSION['email_utente'] = $email;
    //         $_SESSION['tipo_utente'] = "studente";

    //         header("Location: paginaPrincipale_studente.php");
    //         exit();
    //     } else {
    //         $templateParams["errore"] = "password non valida";
    //     }
    // }
    // else if (preg_match($dominio_admin, $email)) {
    //     if ($password === $pass_admin_corretta) {
    //         $_SESSION['utente_loggato'] = true;
    //         $_SESSION['email_utente'] = $email;
    //         $_SESSION['tipo_utente'] = "admin";

    //         header("Location: paginaPrincipale_amministratore.php");
    //         exit();
    //     } else {
    //         $templateParams["errore"] = "password non valida";
    //     }
    // }
    // else {
    //     $templateParams["errore"] = "Email non valida. Usa un formato come nome.cognome@unibo.it oppure nome.cognome@studio.unibo.it";
    // }
}
require("template/index_base.php");
