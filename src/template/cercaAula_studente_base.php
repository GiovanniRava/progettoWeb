<?php
if (!isUserLogged() || !isStudente() ) {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="it">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" charset="UTF-8"/>
    <title>Cerca aula</title>
    <link rel="stylesheet" type="text/css" href="./css/style.css" />
</head>
<body>
    <?php require($templateParams["header"]); ?>
    <div class="red-bar">
        <div class="spacer"></div>
        <div class="subtitle">
            <h2>CERCA AULA</h2>
        </div>
        <div class="spacer"></div>
    </div>

    <main>
        <section class="search-bar">
            <form action="#" method="GET">
                <div class="input-aule">
                    <select name="search" id="search">
                        <option value="">Seleziona Aula</option>
                        <?php foreach($templateParams["elencoAule"] as $aula): ?>
                            <option value="<?php echo htmlspecialchars($aula["numeroAula"]); ?>" 
                            <?php echo ($search == $aula["numeroAula"]) ? "selected" : ""; ?>>
                            <?php echo htmlspecialchars($aula["numeroAula"]); ?>
                        </option>
                        <?php endforeach; ?>
                    </select>
                    <input type="date" id="data-lezione" name="data-lezione"
                    value="<?php echo isset($_GET['data-lezione']) ? htmlspecialchars($_GET['data-lezione']) : date('Y-m-d'); ?>">
                    <button type="submit" class="button-search">CERCA</button>
                </div>
                <a href="prenotazioni_studente.php" class="button-prenota">PRENOTA</a>
            </form>
        </section>
        <section class = "table-aule">
            <table class="table-cerca">
                <thead>
                    <tr>
                        <th>AULA</th>
                        <th>EVENTO</th>
                        <th>ORARIO</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(empty($templateParams["aule"])): ?>
                        <tr>
                            <td>Nessuna aula trovata.</td>
                        </tr>
                    <?php else: ?>
                        <?php foreach($templateParams["aule"] as $aula): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($aula["nomeAula"]); ?></td>
                                <td><?php echo htmlspecialchars($aula["nomeEvento"]); ?></td>
                                <td><?php echo htmlspecialchars(substr($aula["orarioInizio"], 0, 5)) . " - " . htmlspecialchars(substr($aula["oraFine"], 0, 5)); ?></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </section>
    </main>
    <?php require("footer.php"); ?>
</body>

</html> 