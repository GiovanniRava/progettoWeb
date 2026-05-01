<?php
if (!isUserLogged() || !isAdmin()) {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Prenotazioni - Admin</title>
    <link rel="stylesheet" type="text/css" href="./css/style.css" />
</head>
<body>
    <?php include($templateParams["header"]); ?>
    
    <div class="red-bar">
        <div class="spacer"></div>
        <div class="subtitle">
            <h2>LISTA PRENOTAZIONI</h2>
        </div>
        <div class="spacer"></div>
    </div>
    
    <main>
        <section class="search-bar">
            <form action="#" method="GET">
                <div class="input-aule">
                    <select name="search" id="search">
                        <option value="">Seleziona Aula o Lab</option>

                        <?php foreach($templateParams["elencoAule"] as $aula): ?>
                            <option value="<?php echo $aula["numeroAula"] ?>"
                                <?php echo ($templateParams["search_selezionata"] == $aula["numeroAula"]) ? "selected" : ""; ?>>
                                <?php echo $aula["numeroAula"]; ?>
                            </option>
                            <?php endforeach; ?>

                            <?php foreach($templateParams["elencoLab"] as $lab): ?>
                            <option value="<?php echo $lab["numeroLab"] ?>"
                                <?php echo ($templateParams["search_selezionata"] == $lab["numeroLab"]) ? "selected" : ""; ?>>
                                <?php echo $lab["numeroLab"]; ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                    <input type="date" id="data-prenotazione" name="data-prenotazione"
                    value="<?php echo isset($_GET['data-prenotazione']) ? htmlspecialchars($_GET['data-prenotazione']) : date('Y-m-d'); ?>">
                    <button type="submit" class="button-search">CERCA</button>
                </div>
            </form>
        </section>
        <table class="table-prenotazioni-admin">
            <thead>
                <tr>
                    <th id="numero-aula-lab">AULA / LAB</th>
                    <th id="data-prenotazione">DATA</th>
                    <th id="ora-prenotazione">ORARIO</th>
                    <th id="nominativo-prenotazione" class="hide-mobile">NOME e COGNOME</th>
                    <th id="motivazione-prenotazione" class="hide-mobile">MOTIVAZIONE</th>
                    <th id="sezione-elimina"></th>
                </tr>
            </thead>
            <tbody>
                <?php if(empty($templateParams["prenotazioni"])): ?>
                    <tr>
                        <td colspan="6">Nessuna prenotazione in programma.</td>
                    </tr>
                <?php else:
                    foreach($templateParams["prenotazioni"] as $prenotazione):
                    $dataFormattata = date("d/m/Y", strtotime($prenotazione["data"])); ?>
                    
                    <tr class="riga-principale">
                        <td headers="numero-aula-lab"><?php echo htmlspecialchars($prenotazione["num"]); ?></td>
                        <td headers="data-prenotazione"><?php echo $dataFormattata; ?></td>
                        <td headers="ora-prenotazione"><?php $oraInizio = date("H:i", strtotime($prenotazione["oraInizio"])); echo $oraInizio; ?> - 
                        <?php $date = new DateTime($prenotazione["oraInizio"]);
                            $date->modify("+{$prenotazione["durata"]} minutes");
                            $oraFine = $date->format('H:i'); 
                            echo $oraFine;
                        ?></td>
                        <td  headers="nominativo-prenotazione" class="hide-mobile"><?php echo htmlspecialchars($prenotazione["nominativo"]); ?></td>
                        <td headers="motivazione-prenotazione" class="hide-mobile"><?php echo htmlspecialchars($prenotazione["motivazione"]); ?></td>
                        
                        <td headers="sezione-elimina" class="colonna-azioni">
                            <div class="hide-mobile">
                                <button class="button-elimina-prenotazione" data-id="<?php echo $prenotazione["codicePre"]; ?>">ELIMINA</button>
                            </div>
                            <button class="toggle-btn show-mobile">&#709;</button>
                        </td>
                    </tr>
                    
                    <tr class="riga-dettagli nascosta">
                        <td colspan="2">
                            <div class="show-mobile">
                                <p class="dettagli-testo"><strong>Nome e Cognome:</strong><br> <?php echo htmlspecialchars($prenotazione["nominativo"]); ?></p>
                            </div>
                        </td>
                        <td colspan="2">
                            <div class="show-mobile">
                                <p class="dettagli-testo"><strong>Motivazione:</strong><br> <?php echo htmlspecialchars($prenotazione["motivazione"]); ?></p>
                            </div>
                        </td>
                    </tr>

                    <tr class="riga-dettagli nascosta">
                        <td colspan="6">
                            <div class="azioni-mobile-stacked show-mobile">
                                <button class="button-elimina-prenotazione" data-id="<?php echo $prenotazione["codicePre"]; ?>">ELIMINA</button>
                            </div>
                        </td>
                    </tr>

                    <?php endforeach;
                endif; ?>
            </tbody>
        </table>
    </main>

    <dialog id="finestra-annulla">
        <h3>ELIMINA PRENOTAZIONE</h3>
        <p>Sei sicuro di voler eliminare la prenotazione?</p>
        <form id="form-elimina-prenotazione" action="listaPrenotazioni_admin.php" method="POST">
            <input type="hidden" name="nome_da_eliminare" id="input-nascosto-elimina" value="">
            <button type="submit" id="conferma-annulla" name="elimina-prenotazione">SI</button>
            <button type="button" id="revoca-annulla" name="revoca-elimina-prenotazione">NO</button>
        </form>
    </dialog>

    <?php include($templateParams["footer"]); ?>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const bottoniToggle = document.querySelectorAll('.toggle-btn');

            bottoniToggle.forEach(bottone => {
                bottone.addEventListener('click', function() {
                    const rigaPrincipale = this.closest('.riga-principale');
                    const rigaDettagli1 = rigaPrincipale.nextElementSibling;
                    const rigaDettagli2 = rigaDettagli1.nextElementSibling;
                    
                    const isNascosta = rigaDettagli1.classList.contains('nascosta');

                    if (isNascosta) {
                        rigaDettagli1.classList.remove('nascosta');
                        rigaDettagli2.classList.remove('nascosta');
                        this.innerHTML = '&#708;'; 
                    } else {
                        rigaDettagli1.classList.add('nascosta');
                        rigaDettagli2.classList.add('nascosta');
                        this.innerHTML = '&#709;'; 
                    }
                });
            });

            const finestra = document.getElementById('finestra-annulla');
            const inputNascosto = document.getElementById('input-nascosto-elimina');
            const bottoniElimina = document.querySelectorAll('.button-elimina-prenotazione');
            const btnNo = document.getElementById('revoca-annulla');
            const btnSi = document.getElementById('conferma-annulla');

            bottoniElimina.forEach(bottone => {
                bottone.addEventListener('click', () => {
                    const idDaEliminare = bottone.getAttribute('data-id');
                    inputNascosto.value = idDaEliminare;
                    finestra.showModal(); 
                });
            });

            btnNo.addEventListener('click', function(){
                finestra.close();
                inputNascosto.value = ''; 
            });
        });
    </script>
</body>
</html>