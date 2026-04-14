<?php
if (!isUserLogged() && !isAdmin()) {
    header("Location: login.php");
    exit();
}
$classeBody = "";
$successo = "";

// Se nell'URL c'è "inviato=1" o l'errore, allora mostrare il form
if (!empty($templateParams["errore"]) || (isset($_GET['inviato']) && $_GET['inviato'] == 1) || $templateParams["azione"] == 1) {
    $classeBody = "mostra-form";
}

if (isset($_GET['inviato']) && $_GET['inviato'] == 1) {
    $successo = "Operazione avvenuta con successo!";
}
?>
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eventi - Alma Aule</title>
    <link rel="stylesheet" type="text/css" href="./css/style.css" />
</head>
<body class="<?php echo $classeBody; ?>">
    
    <?php include($templateParams["header"]); ?>

    <div class="red-bar">
        <div class="spacer"></div>
        <div class="subtitle">
            <h2>EVENTI</h2>
        </div>
        <div class="back-container">
            <a href="#" class="back-box" title="TornaAgliEventi">
                <span class="cross-icon">&times;</span>
            </a>
        </div>
        <div class="spacer-prenotazioni"></div>
    </div>
    <div class="section-nuovo-evento-btn">
            <a href="#" class="button-nuovo-evento">AGGIUNGI</a>
    </div>
    <main>
        <div class="container-prenotazioniStudente">
            
            <div class="sezione-listaPrenotazioni">
                <?php include('lista_eventi_admin_base.php'); ?>
            </div>
            
            <aside class="sezione-nuovaPrenotazione">
                <?php include('nuovoEvento_amministratore_base.php'); ?>
            </aside>
            
        </div>
    </main>

    <?php include($templateParams["footer"]); ?>

    <script>
        //Aspetta di aver caricato tutta la struttura HTML, poi esegui queste funzioni
        document.addEventListener('DOMContentLoaded', function() {
        const btnAdd = document.querySelector('.button-nuovo-evento');
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
                window.history.replaceState({}, '', window.location.pathname);
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
</html>