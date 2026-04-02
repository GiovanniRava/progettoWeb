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
    <title>Richieste In Corso - Admin</title>
    <link rel="stylesheet" type="text/css" href="./css/style.css" />
</head>
<body>
    <?php require($templateParams["nome"]); ?>
    
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
                        <div class="azioni-mobile-stacked show-mobile">
                            <button class="btn-accetta" data-id="<?php echo $richiesta["codiceRichiesta"]; ?>">Accetta</button>
                            <button class="btn-rifiuta" data-id="<?php echo $richiesta["codiceRichiesta"]; ?>">Rifiuta</button>
                        </div>
                    </td>
                </tr>

                <tr class="riga-dettagli nascosta">
                    <td colspan="4">
                        <div class="show-mobile">
                            <?php if(!empty($richiesta["descrizione"])): ?>
                                <p class="dettagli-testo"><strong>Descrizione:</strong><br> <?php echo htmlspecialchars($richiesta["descrizione"]); ?></p>
                            <?php else: ?>
                                <p class="dettagli-testo"><em>Nessuna descrizione fornita.</em></p>
                            <?php endif; ?>
                        </div>
                    </td>
                </tr>
                
                <?php endforeach; ?>
            </tbody>
        </table>
    </main>

    <?php require("footer.php"); ?>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const bottoniToggle = document.querySelectorAll('.toggle-btn');

            bottoniToggle.forEach(bottone => {
                bottone.addEventListener('click', function() {
                    const rigaPrincipale = this.closest('.riga-principale');
                    
                    // Selezioniamo entrambe le righe dei dettagli successive
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
        });
    </script>
</body>
</html>