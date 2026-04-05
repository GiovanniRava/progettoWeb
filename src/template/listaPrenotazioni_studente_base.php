<!-- <!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Prenotazioni - Studente</title>
    <link rel="stylesheet" type="text/css" href="./css/style.css" />
</head> -->
<body>
    <!-- php
    <div class="red-bar">
        <div class="spacer"></div>
        <div class="subtitle">
            <h2>LE MIE PRENOTAZIONI</h2>
        </div>
        <div class="add-container">
            <a href="nuova_prenotazione.php" class="add-box" title="RichiediNuovaPrenotazione">
                <span class="plus-icon">+</span>
            </a>
        </div>
    </div> -->
    
    <main>
        <table class="table-prenotazioni-studente">
            <tr>
                <th id="numero-aula-lab">AULA / LAB</th>
                <th id="data-prenotazione">DATA</th>
                <th id="ora-prenotazione">ORARIO</th>
                <th id="sezione-annulla"></th>
            </tr>
            <?php foreach($templateParams["prenotazioni"] as $prenotazione): ?>
            <tr>
                <td headers="numero-aula-lab"><?php echo $prenotazione["num"] ?></td>
                <td headers="data-prenotazione"><?php echo $prenotazione["data"] ?></td>
                <td headers="ora-prenotazione"><?php echo $prenotazione["oraInizio"] ?> - 
                <?php $date = new DateTime($prenotazione["oraInizio"]);
                    $date->modify("+{$prenotazione["durata"]} minutes");
                    $oraFine = $date->format('H:i:s'); 
                    echo $oraFine;
                ?></td>
                <td headers="sezione-annulla">
                    <button id="button-annulla-prenotazione" class="button-annulla-prenotazione" data-id="<?php echo $prenotazione["codicePre"]; ?>">ANNULLA</button>
                </td>
            </tr>
            <?php endforeach; ?>
            <dialog id="finestra-annulla">
                <h3>ANNULLAMENTO PRENOTAZIONE</h3>
                <p>Sei sicuro di voler annullare la prenotazione?</p>
                <form id="form-elimina-prenotazione" action="prenotazioni_studente.php" method="POST">
                    <input type="hidden" name="nome_da_eliminare" id="input-nascosto-elimina" value="">
                    <button type="submit" id="conferma-annulla">SI</button>
                    <button type="button" id="revoca-annulla">NO</button>
                </form>
            </dialog>
        </table>
    </main>

    <!-- <footer>
        <p>Contatti Per Docenti - Assistenza Didattica tel:0512080302</p>
        <p>Contatti Per Studenti - Help Desk Studenti tel:0512080301</p>
    </footer> -->

    <script>
        const finestra = document.getElementById('finestra-annulla');
        const inputNascosto = document.getElementById('input-nascosto-elimina');
        const bottoniAnnulla = document.querySelectorAll('.button-annulla-prenotazione');
        const btnNo = document.getElementById('revoca-annulla');
        const btnSi = document.getElementById('conferma-annulla');

        // Funzione per aprire la finestra (trovata su w3school)
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