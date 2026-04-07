<?php 
if (!isset($_SESSION['utente_loggato'])) {
    header("Location: login.php");
    exit();
} 
?>
<!DOCTYPE html>
<html lang="it">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" charset="UTF-8"/>
    <title>Pagina Principale - admin</title>
    <link rel="stylesheet" type="text/css" href="./css/style.css" />
</head>
<body>
    <?php require ($templateParams["header"]); ?>
    <div class="red-bar">
        <div class="spacer"></div>
        <div class="subtitle">
            <h2>INFORMAZIONI GENERALI</h2>
        </div>
        <div class="spacer"></div>
    </div>
    <div class="container-pagPrincAdmin">
        <section class="sezione-numeri">
            <?php include('infoGenerali_amministratore.php');?>
        </section>
        <section class="sezione-richiesteInCorso">
            <?php
            $is_included_in_main = true;
            include('richieste_admin.php'); 
            ?>
        </section>   
    </div>
    <?php require ($templateParams["footer"]); ?>
</body>
</html> 
