<?php 
if (!isUserLogged() || !isAdmin()) {
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
    <?php require($templateParams["header"]); ?>
    <?php endif; ?>
    <div class="red-bar">
        <div class="spacer"></div>
        <div class="subtitle">
            <h2>RICHIESTE IN CORSO</h2>
        </div>
        <div class="spacer"></div>
    </div>
    
    <main>
        <table class="table-richieste-admin">
            <thead>
                <tr>
                    <th id="numero-aula-lab">AULA / LAB</th>
                    <th id="data-richiesta">DATA</th>
                    <th id="ora-richiesta">ORARIO</th>
                    <th class="hide-mobile">NOME e COGNOME</th>
                    <th class="hide-mobile">MOTIVAZIONE</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php if(empty($templateParams["richieste_in_corso"])): ?>
                    <tr>
                        <td colspan="6" >Nessuna richiesta in corso</td>
                    </tr>
                <?php endif; ?>
                <?php foreach($templateParams["richieste_in_corso"] as $richiesta): ?>
                
                <tr class="riga-principale">
                    <td headers="numero-aula-lab">
                        <?php 
                            if (!empty($richiesta["numeroAula"])) {
                                echo htmlspecialchars($richiesta["numeroAula"]);
                            } elseif (!empty($richiesta["numeroLab"])) {
                                echo htmlspecialchars($richiesta["numeroLab"]);
                            }
                        ?>
                    </td>
                    <td headers="data-richiesta"><?php echo htmlspecialchars($richiesta["data"]); ?></td>
                    <td headers="ora-richiesta">
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
                            <button class="btn-accetta" data-id="<?php echo $richiesta["codiceRichiesta"]; ?>">ACCETTA</button>
                            <button class="btn-rifiuta" data-id="<?php echo $richiesta["codiceRichiesta"]; ?>">RIFIUTA</button>
                        </div>
                        <button class="toggle-btn show-mobile">&#709;</button>
                    </td>
                </tr>
                
                <tr class="riga-dettagli nascosta">
                    <td colspan="2">
                        <div class="show-mobile">
                            <p class="dettagli-testo"><strong>Nome e Cognome:</strong><br> <?php echo htmlspecialchars($richiesta["nominativo"]); ?></p>
                        </div>
                    </td>
                    
                    <td colspan="2">
                        <div class="show-mobile">
                            <p class="dettagli-testo"><strong>Motivazione:</strong><br> <?php echo htmlspecialchars($richiesta["motivazione"]); ?></p>
                        </div>
                    </td>
                </tr>

                <tr class="riga-dettagli nascosta">
                    <td colspan="4">
                        <div class="azioni-mobile-stacked show-mobile">
                            <button class="btn-accetta" data-id="<?php echo $richiesta["codiceRichiesta"]; ?>">ACCETTA</button>
                            <button class="btn-rifiuta" data-id="<?php echo $richiesta["codiceRichiesta"]; ?>">RIFIUTA</button>
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
            <input type="hidden" name="return_url" value="<?php echo $_SERVER['REQUEST_URI']; ?>">
            
            <button type="submit" id="conferma-rifiuta">SI</button>
            <button type="button" id="annulla-rifiuto">NO</button>
        </form>
    </dialog>

    <form id="form-accetta-richiesta" action="richieste_admin.php" method="POST" style="display: none;">
        <input type="hidden" name="richiesta_da_accettare" id="input-nascosto-accetta" value="">
        <input type="hidden" name="return_url" value="<?php echo $_SERVER['REQUEST_URI']; ?>">
    </form>
    
    <script src="script/richieste_admin_script.js"
    type="text/javascript"></script>
    
    <?php if ($is_standalone): ?>
        <?php require("footer.php"); ?>
    
</body>
</html>
<?php endif; ?>