<?php
if (!isset($_SESSION['utente_loggato']) || !isStudente()) {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="it">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" charset="UTF-8"/>
    <title>Lezioni in corso</title>
    <link rel="stylesheet" type="text/css" href="./css/style.css" />
</head>
<body>
    <?php require($templateParams["header"]); ?>
    <div class = "red-bar">
        <div class = "spacer"></div>
        <div class = "subtitle">
            <h2>LEZIONI IN CORSO</h2>
        </div>
        <div class = "spacer"></div>
    </div>
    <main>
        <table class="table-cerca">
            <thead>
                <tr>
                    <th id="titolo-evento">EVENTO</th>
                    <th id="aula">AULA</th>
                    <th id="orario">ORARIO</th>
                </tr>
            </thead>
            <tbody>
                <?php if(empty($templateParams["lezioni"])): ?>
                    <tr>
                        <td colspan="3">Nessuna lezione in corso.</td>
                    </tr>
                <?php else: ?>
                    <?php foreach($templateParams["lezioni"] as $lezione): ?>
                        <?php 
                            $oraInizioFormattata = date("H:i", strtotime($lezione["oraInizio"]));
                            $oraFineFormattata = date("H:i", strtotime($lezione["oraFine"]));
                        ?>
                    <tr>
                        <td headers="titolo-evento">
                            <?php echo $lezione["nomeEvento"]; ?>
                        </td>
                        <td headers="aula">
                            <?php echo !empty($lezione["numeroAula"]) ?
                            "Aula ".$lezione["numeroAula"] :
                            "Lab ".$lezione["numeroLab"]; ?>
                        </td>
                        <td><?php echo $oraInizioFormattata . " - " . $oraFineFormattata; ?></td>
                    </tr> 
                    <?php endforeach; ?>
                <?php endif; ?>   
            </tbody>
        </table>
    </main>

    <?php require($templateParams["footer"]); ?>
</body>
</html>