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
        <table>
            <thead>
                <tr>
                    <th>EVENTO</th>
                    <th>AULA</th>
                </tr>
            </thead>
            <tbody>
                <?php if(empty($templateParams["lezioni"])): ?>
                    <tr>
                        <td colspan="2">Nessuna lezione in corso.</td>
                    </tr>
                <?php else: ?>
                    <?php foreach($templateParams["lezioni"] as $lezione): ?>
                    <tr>
                        <td>
                            <?php echo $lezione["nomeEvento"]; ?>
                        </td>
                        <td>
                            <?php echo !empty($lezione["numeroAula"]) ?
                            "Aula".$lezione["numeroAula"] :
                            "Lab".$lezione["numeroLab"]; ?>
                        </td>
                    </tr> 
                    <?php endforeach; ?>
                <?php endif; ?>   
            </tbody>
        </table>
    </main>

    <?php require($templateParams["footer"]); ?>
</body>
</html>