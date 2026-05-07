<?php
if (!isUserLogged() || !isStudente()) {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="it">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="UTF-8">
    <title>Eventi - Alma Aule</title>
    <link rel="stylesheet" type="text/css" href="./css/style.css" />
</head>

<body>
    <?php include($templateParams["header"]); ?>

    <div class="red-bar">
        <div class="spacer"></div>
        <div class="subtitle">
            <h2>EVENTI</h2>
        </div>
        <div class="spacer"></div>
    </div>

    <main class="container-eventi">
        <section class="griglia-eventi">

            <?php foreach ($templateParams["eventi"] as $evento): ?>
                <button type="button" 
                        class="card-evento" 
                        onclick="toggleEspansione(this)" 
                        aria-expanded="false">
                    <img src="<?php echo UPLOAD_DIR . $evento['locandina']; ?>"
                        alt="Locandina <?php echo htmlspecialchars($evento['titolo']); ?>"
                        class="img-evento">

                    <div class="info-evento">
                        <?php
                        $luogo = !empty($evento['numeroAula']) ? $evento['numeroAula'] : (!empty($evento['numeroLab']) ? $evento['numeroLab'] : '');
                        $titoloDisplay = !empty($luogo) ? $evento['titolo'] . ' - ' . $luogo : $evento['titolo'];
                        $dataFormattata = date("d/m/Y", strtotime($evento['data']));
                        $oraFormattata = date("H:i", strtotime($evento['oraInizio']));
                        ?>
                        <h3><?php echo htmlspecialchars($titoloDisplay); ?></h3>
                        <span class="data-evento"><?php echo $dataFormattata; ?> - Ore <?php echo $oraFormattata; ?></span></br>
                        <span class="testo-espansione">Clicca per Maggiori Informazioni</span>
                        <div class="descrizione-evento" aria-hidden="true">
                            <p><?php echo nl2br(htmlspecialchars($evento['descrizione'] ?? 'Nessuna descrizione disponibile')); ?></p>
                        </div>
                    </div>
                </button>
            <?php endforeach; ?>


        </section>
    </main>

    <?php include("footer.php"); ?>
    <script src="script/eventi_studente_script.js"
    type="text/javascript"></script>
</body>

</html>