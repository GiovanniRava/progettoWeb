<?php
if (!isset($_SESSION['utente_loggato'])) {
    // Se non sei loggato, ti rimando al login
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="it">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" charset="UTF-8"/>
    <title>Prenotazioni - Studente</title>
    <link rel="stylesheet" type="text/css" href="./css/style.css" />
</head>
<body>
    <?php require($templateParams["nome"]); ?>
    <div class="red-bar">
        <div class="spacer"></div>
        <div class="subtitle">
            <h2>LE MIE PRENOTAZIONI</h2>
        </div>
        <div class="add-container">
            <a href="nuova_prenotazione.php" class="add-box" title="AggiungiPrenotazione">
                <span class="plus-icon">+</span>
            </a>
        </div>
    </div>
    
    <main>
        <table>
            <tr>
                <th>AULA / LAB</th>
                <th>ORARIO</th>
                <th></th>
            </tr>
            <?php foreach($templateParams["prenotazioni"] as $prenotazione): ?>
            <tr>
                <td><?php echo $prenotazione["num"] ?></td>
                <td><?php echo $prenotazione["oraInizio"] ?> - 
                <?php $date = new DateTime($prenotazione["oraInizio"]);
                    $date->modify("+{$prenotazione["durata"]} minutes");
                    $oraFine = $date->format('H:i:s'); 
                    echo $oraFine;
                ?></td>
                <td>
                    <button id="button-annulla-prenotazione" class="button-annulla-prenotazione">ANNULLA</button>
                    <dialog id="finestra-annulla">
                        <h3>ANNULLAMENTO PRENOTAZIONE</h3>
                        <p>Sei sicuro di voler annullare la prenotazione?</p>
                        <button id="conferma-annulla">SI</button><button id="revoca-annulla">NO</button>
                    </dialog>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
    </main>

    <footer>
        <p>Contatti Per Docenti - Assistenza Didattica tel:0512080302</p>
        <p>Contatti Per Studenti - Help Desk Studenti tel:0512080301</p>
    </footer>

    <script>
        const finestra = document.getElementById('finestra-annulla'); //document + funzione giusto per recuperare elementi
        //funzioni tipo: getElementiById("idElemento"), querySelector("#idElemento"), querySelectorAll(), getElementsByClassName("nomeClasse")[indice numerico]
        const btnApri = document.getElementById('button-annulla-prenotazione');
        //document.querySelector("button")[0] oppure document.querySelector("button:first-chilf")
        const btnNo = document.getElementById('revoca-annulla');
        const btnSi = document.getElementById('conferma-annulla');

        // Funzione per aprire la finestra (trovata su w3school)
        btnApri.addEventListener('click', () => {
            finestra.showModal(); 
        });

        // Funzione per chiudere se clicchi NO
        btnNo.addEventListener("click", function(){
            finestra.close();
        });

        // Azione se clicchi SI
        btnSi.addEventListener('click', () => {
            console.log("Prenotazione annullata!");//stampa in console 
            finestra.close();
            // Qui aggiungerai la logica per cancellare davvero (es. una chiamata al database)
        });
    </script>
    <!--giusto mettere lo script in fondo per essere sicuri che il dom (tutti gli elementi) sia creato e che js trovi tutti gli elementi.-->
    <!-- sarebbe da fare un file a parte .js, e qui usare <script src="file.js"></script> -->
    <!-- fare: let testo = btnSi.innerHTML (o .innerText) assegna a testo il contenuto del tag button con id=conferma-annulla. è possibile fare: btnSi.innerHTML = "qualcosa" per cambiarne il contenuto visibile nella pagina -->
</body>