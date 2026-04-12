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
    <title>Cerca laboratorio</title>
    <link rel="stylesheet" type="text/css" href="./css/style.css" />
</head>
<body>
    <?php require($templateParams["header"]); ?>
    <div class = "red-bar">
        <div class = "spacer"></div>
        <div class = "subtitle">
            <h2>CERCA LABORATORIO</h2>
        </div>
        <div class = "spacer"></div>
    </div>

    <main>
        <section class="search-bar">
            <form action="#" method="GET">
                <div class="input-lab">
                    <input type="text" id="search" name="search" placeholder="Cerca..."
                    value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>">
                    <input type="date" id="data-lezione" name="data-lezione" 
                    value="<?php echo isset($_GET ['data-lezione']) ? htmlspecialchars($_GET['data-lezione']) : date('Y-m-d'); ?>">
                </div>
                <button type="submit" class = "button-prenota">PRENOTA</button>
            </form>
        </section>
        <section class = "table-lab">
            <table class="table-cerca">
                <thead>
                    <tr>
                        <th>LABORATORIO</th>
                        <th>EVENTO</th>
                        <th>ORARIO</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(empty($templateParams["laboratori"])) : ?>
                        <tr>
                            <td>Nessun laboratorio trovato.</td>
                        </tr>
                    <?php else: ?>
                        <?php foreach($templateParams["laboratori"] as $lab): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($lab["nomeLab"]); ?></td>
                                <td><?php echo htmlspecialchars($lab["nomeEvento"]); ?></td>
                                <td><?php echo htmlspecialchars(substr($lab["orarioInizio"], 0, 5)) . " - " . htmlspecialchars(substr($lab["oraFine"], 0, 5)); ?></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </section>
    </main>
    <?php require($templateParams["footer"]); ?>
</body>

</html> 