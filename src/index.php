<?php

require 'config/config.php'; 

$pass_admin_corretta = "admin123";      
$pass_studente_corretta = "aule2024";     

$errore = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $password_inserita = $_POST['password'];

    if ($password_inserita === $pass_admin_corretta) {
        $_SESSION['ruolo'] = 'admin';
        $_SESSION['login_time'] = time(); 
        header("Location: admin_dashboard.php");
        exit;
    } elseif ($password_inserita === $pass_studente_corretta) {
        $_SESSION['ruolo'] = 'visitatore';
        header("Location: studenti_home.php");
        exit;

    } else {
        
        $errore = "Password non riconosciuta. Riprova.";
    }
}
?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Login Aule - Accesso</title>
</head>
<body>
    
</body>