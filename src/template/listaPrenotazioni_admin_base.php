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
    <title>Prenotazioni - Admin</title>
    <link rel="stylesheet" type="text/css" href="./css/style.css" />
</head>
<body>
    <?php require($templateParams["header"]); ?>
    <div class="red-bar">
        <div class="spacer"></div>
        <div class="subtitle">
            <h2>LISTA PRENOTAZIONI</h2>
        </div>
        <div class="spacer"></div>
    </div>
    <main>
        <table>
            <tr>
                <th>AULA / LAB</th>
                <th>DATA</th>
                <th>ORARIO</th>
                <th>NOME e COGNOME</th>
                <th>MOTIVAZIONE</th>
                <th></th>
            </tr>
            <?php foreach($templateParams["prenotazioni"] as $prenotazione): ?>
            <tr>
                <td><?php echo $prenotazione["num"] ?></td>
                <td><?php echo $prenotazione["data"] ?></td>
                <td><?php echo $prenotazione["oraInizio"] ?> - 
                <?php $date = new DateTime($prenotazione["oraInizio"]);
                    $date->modify("+{$prenotazione["durata"]} minutes");
                    $oraFine = $date->format('H:i:s'); 
                    echo $oraFine;
                ?></td>
                <td><?php echo $prenotazione["nominativo"] ?></td>
                <td><?php echo $prenotazione["motivazione"] ?></td>
                <td>
                    <button id="button-annulla-prenotazione" class="button-annulla-prenotazione" data-id="<?php echo $prenotazione["codicePre"]; ?>">ELIMINA</button>
                </td>
            </tr>
            <?php endforeach; ?>
            <dialog id="finestra-annulla">
                <h3>ELIMINA PRENOTAZIONE</h3>
                <p>Sei sicuro di voler eliminare la prenotazione?</p>
                <form id="form-elimina-prenotazione" action="prenotazioni_studente.php" method="POST">
                    <input type="hidden" name="nome_da_eliminare" id="input-nascosto-elimina" value="">
                    <button type="submit" id="conferma-annulla" name="elimina-prenotazione">SI</button>
                    <button type="button" id="revoca-annulla" name="revoca-elimina-prenotazione">NO</button>
                </form>
            </dialog>
        </table>
    </main>

    <footer>
        <p>Contatti Per Docenti - Assistenza Didattica tel:0512080302</p>
        <p>Contatti Per Studenti - Help Desk Studenti tel:0512080301</p>
    </footer>

    <script>
        const finestra = document.getElementById('finestra-annulla');
        const inputNascosto = document.getElementById('input-nascosto-elimina');
        const bottoniAnnulla = document.querySelectorAll('.button-annulla-prenotazione');
        const btnNo = document.getElementById('revoca-annulla');
        const btnSi = document.getElementById('conferma-annulla');

        bottoniAnnulla.forEach(bottone => {
            bottone.addEventListener('click', () => {
                const idDaEliminare = bottone.getAttribute('data-id');
                inputNascosto.value = idDaEliminare;
                finestra.showModal(); 
            });
        });

        btnNo.addEventListener('click', function(){
            finestra.close();
        });

        btnSi.addEventListener('click', () => {
            console.log("Prenotazione annullata!");
            finestra.close();
        });
    </script>
</body>