<?php
$is_included = true;

$classeBody = "";
if (!empty($errore) || (isset($_GET['inviato']) && $_GET['inviato'] == 1)) {
    $classeBody = "mostra-form";
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
    
    <?php require($templateParams["header"]); ?>

    <div class="red-bar">
        <div class="spacer"></div>
        <div class="subtitle">
            <h2>EVENTI</h2>
        </div>
        <section class="add-container">
                <a href="nuovoEvento_amministratore.php" class="button-nuovo-evento">AGGIUNGI</a>
        </section>
        <div class="back-container">
            <a href="#" class="back-box" title="TornaAgliEventi">
                <span class="cross-icon">&times;</span>
            </a>
        </div>
        <div class="spacer-prenotazioni"></div>
    </div>

    <main>
        <div class="container-prenotazioniStudente">
            
            <div class="sezione-listaPrenotazioni">
                <?php include('lista_eventi_admin_base.php'); ?>
            </div>
            
            <div class="sezione-nuovaPrenotazione">
                <?php include('nuovoEvento_amministratore_base.php'); ?>
            </div>   
            
        </div>
    </main>

    <?php require("footer.php"); ?>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const btnAdd = document.querySelector('.add-box');
            const btnBack = document.querySelector('.back-box');
            const body = document.body;

            if (localStorage.getItem('statoFormEventi') === 'aperto' && window.innerWidth < 768) {
                body.classList.add('mostra-form');
            }

            if (window.innerWidth < 768) {
                body.classList.add('mostra-form');
                localStorage.setItem('statoFormEventi', 'aperto');
            }
            
            if (window.innerWidth < 768) {
                body.classList.remove('mostra-form');
                localStorage.removeItem('statoFormEventi');
                window.history.replaceState({}, '', window.location.pathname);
            }

            window.addEventListener('resize', function() {
                if (window.innerWidth >= 768) {
                    body.classList.remove('mostra-form');
                }
            });
        });
    </script>
</body>
</html>