<?php
if (!isUserLogged()) {
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
    <?php include($templateParams["header"]); ?>
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
            <aside class="sezione-nuovaPrenotazione">
                <?php include('nuova_prenotazione_base.php'); ?>
            </aside>
        </div>
    </main>
    <?php include($templateParams["footer"]); ?>

    <script src="script/prenotazioni_studente_script.js"
    type="text/javascript"
    data-class="add-box"></script>
</body>
</html>