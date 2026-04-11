<?php 
if (!isset($_SESSION['utente_loggato'])) {
    header("Location: login.php");
    exit();
} 

/**
 * LOGICA DI INCLUSIONE:
 * Se la pagina è caricata dalla Dashboard, $is_included_in_main sarà TRUE.
 * Se clicchi dal MENU, la variabile NON esiste, quindi siamo in "Standalone".
 */
$is_standalone = !isset($is_included_in_main) || $is_included_in_main !== true;

?>
<?php if ($is_standalone): ?>
<!DOCTYPE html>
<html lang="it">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" charset="UTF-8"/>
    <title>Richieste In Corso - Admin</title>
    <link rel="stylesheet" type="text/css" href="./css/style.css" />
</head>
<body>
    <?php require($templateParams["nome"]); ?>
<?php endif; ?>
    <div class="red-bar">
        <div class="spacer"></div>
        <div class="subtitle">
            <h2>RICHIESTE IN CORSO</h2>
        </div>
        <div class="spacer"></div>
    </div>
    
    <main>
        <table>
            <thead>
                <tr>
                    <th>AULA / LAB</th>
                    <th>DATA</th>
                    <th>ORARIO</th>
                    <th class="hide-mobile">NOME e COGNOME</th>
                    <th class="hide-mobile">MOTIVAZIONE</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($templateParams["richieste_in_corso"] as $richiesta): ?>
                
                <tr class="riga-principale">
                    <td>
                        <?php 
                            if (!empty($richiesta["numeroAula"])) {
                                echo "Aula " . htmlspecialchars($richiesta["numeroAula"]);
                            } elseif (!empty($richiesta["numeroLab"])) {
                                echo "Lab " . htmlspecialchars($richiesta["numeroLab"]);
                            } else {
                                echo "N/D";
                            }
                        ?>
                    </td>
                    <td><?php echo htmlspecialchars($richiesta["data"]); ?></td>
                    <td>
                        <?php 
                            $oraInizio = $richiesta["oraInizio"];
                            $date = new DateTime($oraInizio);
                            $date->modify("+{$richiesta['durata']} minutes");
                            $oraFine = $date->format('H:i'); 
                            echo htmlspecialchars(substr($oraInizio, 0, 5)) . " - " . $oraFine;
                        ?>
                    </td>
                    
                    <td class="hide-mobile"><?php echo htmlspecialchars($richiesta["nominativo"]); ?></td>
                    <td class="hide-mobile"><?php echo htmlspecialchars($richiesta["motivazione"]); ?></td>
                    
                    <td class="colonna-azioni">
                        <div class="hide-mobile">
                            <button class="btn-accetta" data-id="<?php echo $richiesta["codiceRichiesta"]; ?>">Accetta</button>
                            <button class="btn-rifiuta" data-id="<?php echo $richiesta["codiceRichiesta"]; ?>">Rifiuta</button>
                        </div>
                        <button class="toggle-btn show-mobile">&#709;</button>
                    </td>
                </tr>
                
                <tr class="riga-dettagli nascosta">
                    <td>
                        <div class="show-mobile">
                            <p class="dettagli-testo"><strong>Nome e Cognome:</strong><br> <?php echo htmlspecialchars($richiesta["nominativo"]); ?></p>
                        </div>
                    </td>
                    
                    <td>
                        <div class="show-mobile">
                            <p class="dettagli-testo"><strong>Motivazione:</strong><br> <?php echo htmlspecialchars($richiesta["motivazione"]); ?></p>
                        </div>
                    </td>

                    <td colspan="2">
                        <div class="show-mobile">
                            <?php if(!empty($richiesta["descrizione"])): ?>
                                <p class="dettagli-testo"><strong>Descrizione:</strong><br> <?php echo htmlspecialchars($richiesta["descrizione"]); ?></p>
                            <?php else: ?>
                                <p class="dettagli-testo"><em>Nessuna descrizione fornita.</em></p>
                            <?php endif; ?>
                        </div>
                    </td>
                </tr>

                <tr class="riga-dettagli nascosta">
                    <td colspan="4">
                        <div class="azioni-mobile-stacked show-mobile">
                            <button class="btn-accetta" data-id="<?php echo $richiesta["codiceRichiesta"]; ?>">Accetta</button>
                            <button class="btn-rifiuta" data-id="<?php echo $richiesta["codiceRichiesta"]; ?>">Rifiuta</button>
                        </div>
                    </td>
                </tr>
                
                <?php endforeach; ?>
            </tbody>
        </table>
    </main>

    <dialog id="finestra-rifiuta">
        <h3>RIFIUTA RICHIESTA</h3>
        <p>Sei sicuro di voler rifiutare questa richiesta di prenotazione?</p>
        <form id="form-rifiuta-richiesta" action="richieste_admin.php" method="POST">
            <input type="hidden" name="richiesta_da_eliminare" id="input-nascosto-rifiuta" value="">
            
            <button type="submit" id="conferma-rifiuta">SI</button>
            <button type="button" id="annulla-rifiuto">NO</button>
        </form>
    </dialog>

    <form id="form-accetta-richiesta" action="richieste_admin.php" method="POST" style="display: none;">
        <input type="hidden" name="richiesta_da_accettare" id="input-nascosto-accetta" value="">
    </form>
    <?php if ($is_standalone): ?>
        <?php require("footer.php"); ?>

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
                        this.innerHTML = '&#708;'; // Freccia in su
                    } else {
                        rigaDettagli1.classList.add('nascosta');
                        rigaDettagli2.classList.add('nascosta');
                        this.innerHTML = '&#709;'; // Freccia in giù
                    }
                });
            });

            // --- LOGICA RIFIUTA (Con Dialog) ---
            const dialogRifiuta = document.getElementById('finestra-rifiuta');
            const inputNascostoRifiuta = document.getElementById('input-nascosto-rifiuta');
            const btnAnnullaRifiuto = document.getElementById('annulla-rifiuto');
            const bottoniRifiuta = document.querySelectorAll('.btn-rifiuta');

            bottoniRifiuta.forEach(bottone => {
                bottone.addEventListener('click', function() {
                    const idRichiesta = this.getAttribute('data-id');
                    inputNascostoRifiuta.value = idRichiesta;
                    dialogRifiuta.showModal();
                });
            });

            btnAnnullaRifiuto.addEventListener('click', function() {
                dialogRifiuta.close();
                inputNascostoRifiuta.value = ''; // Pulizia
            });

            // --- LOGICA ACCETTA (Senza Dialog) ---
            const formAccetta = document.getElementById('form-accetta-richiesta');
            const inputNascostoAccetta = document.getElementById('input-nascosto-accetta');
            const bottoniAccetta = document.querySelectorAll('.btn-accetta');

            bottoniAccetta.forEach(bottone => {
                bottone.addEventListener('click', function() {
                    const idRichiesta = this.getAttribute('data-id');
                    inputNascostoAccetta.value = idRichiesta;
                    formAccetta.submit(); 
                });
            });
        });
    </script>
</body>
</html>
<?php endif; ?>