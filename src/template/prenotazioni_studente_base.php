<?php
if (!isset($_SESSION['utente_loggato'])) {
    header("Location: login.php");
    exit();
}
$classeBody = "";
$successo = "";

// Se nell'URL c'è "inviato=1" o l'errore, allora mostrare il form
if (!empty($errore) || (isset($_GET['inviato']) && $_GET['inviato'] == 1)) {
    $classeBody = "mostra-form";
}

if (isset($_GET['inviato']) && $_GET['inviato'] == 1) {
    $successo = "Richiesta inviata con successo!";
}
?>
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Prenotazioni - Studente</title>
    <link rel="stylesheet" type="text/css" href="./css/style.css" />
</head>
<body class="<?php echo $classeBody; ?>">
    <?php require($templateParams["header"]); ?>
    <div class="red-bar">
        <div class="spacer"></div>
        <div class="subtitle">
            <h2>LE MIE PRENOTAZIONI</h2>
        </div>
        <div class="add-container">
            <a href="#" class="add-box" title="RichiediNuovaPrenotazione">
                <span class="plus-icon">+</span>
            </a>
        </div>
        <div class="back-container">
            <a href="#" class="back-box" title="BackToPrenotazioni">
                <span class="cross-icon">&times;</span>
            </a>
        </div>
        <div class="spacer-prenotazioni"></div>
    </div>
    <main>
        <div class="container-prenotazioniStudente">
            <div class="sezione-listaPrenotazioni">
                <?php include('listaPrenotazioni_studente_base.php'); ?>
            </div>
            <div class="sezione-nuovaPrenotazione">
                <?php include('nuova_prenotazione_base.php'); ?>
            </div>   
        </div>
    </main>
    <footer>
        <p>Contatti Per Docenti - Assistenza Didattica tel:0512080302</p>
        <p>Contatti Per Studenti - Help Desk Studenti tel:0512080301</p>
    </footer>

    <script>
        //Aspetta di aver caricato tutta la struttura HTML, poi esegui queste funzioni
        document.addEventListener('DOMContentLoaded', function() {
        const btnAdd = document.querySelector('.add-box');
        const btnBack = document.querySelector('.back-box');
        const body = document.body;

        if (localStorage.getItem('statoForm') === 'aperto' && window.innerWidth < 768) {
            body.classList.add('mostra-form');
        }

        btnAdd.addEventListener('click', function(e) {
            if (window.innerWidth < 768) {
                e.preventDefault();
                body.classList.add('mostra-form');
                localStorage.setItem('statoForm', 'aperto');
            }
        });

        btnBack.addEventListener('click', function(e) {
            if (window.innerWidth < 768) {
                e.preventDefault();
                body.classList.remove('mostra-form');
                localStorage.removeItem('statoForm');
                window.history.replaceState({}, '', window.location.pathname);// Questa riga pulisce l'URL (toglie ?inviato=1) al refresh
            }
        });

        window.addEventListener('resize', function() {
            if (window.innerWidth >= 768) {
                body.classList.remove('mostra-form');
            }
        });
    });
    </script>
</body>