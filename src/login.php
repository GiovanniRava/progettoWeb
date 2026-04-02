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
    //ricordarsi di fare anche il logout per poter cambiare persona.
}
?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" charset="UTF-8"/>
    <title>Login Aule - Accesso</title>
    <link rel="stylesheet" type="text/css" href="./css/style.css" />
</head>
<body>
    <header>
        <div class="logo">
            <a href="index.php">
                <img src="upload/uniboLogo.png" alt="Logo Alma Aule">
            </a>
        </div>
        <div class="title">
            <h1>Alma Aule</h1>
        </div>
        <div class="login">
            <a href="login.php">Login</a>
        </div>
    </header>
    
    <main class="main-home">
        <img src="upload/giardinoCampus.jpeg" alt="giardino Campus Cesena, foto di sfondo Home page" class="home-img-login">
            <div class="login-form">
            <form action="login.php" method="POST" class="login-form-form">
                <h2>ACCEDI</h2>
                <?php if(isset($errore)): ?>
                <p class="error-message"><?php echo $errore; ?></p>
                <?php endif; ?>
                <ul>
                    <li>
                        <label for="email">E-mail</label>
                        <input type="text" id="email" name="email" />
                    </li>
                    <li>
                        <label for="password">Password</label>
                        <input type="password" id="password" name="password" />
                    </li>
                    <li>
                        <input type="submit" name="submit" class="conferma-login" value="CONFERMA" />
                    </li>
                </ul>
            </form>
        </div>
    </main>

    <footer class="home-footer">
        <p>Contatti Per Docenti - Assistenza Didattica tel:0512080302</p>
        <p>Contatti Per Studenti - Help Desk Studenti tel:0512080301</p>
    </footer>
</body>