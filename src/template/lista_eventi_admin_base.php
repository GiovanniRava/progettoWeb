<!DOCTYPE html>
<html lang="it">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" charset="UTF-8">
    <title>Eventi - Alma Aule</title>
    <link rel="stylesheet" type="text/css" href="./css/style.css" />
</head>
<body>
    <?php require($templateParams["nome"]); ?>

    <div class="red-bar">
        <div class="spacer"></div>
        <div class="subtitle">
            <h2>EVENTI</h2>
        </div>
        <div class="spacer"></div>
    </div>

    <main>
        <section class="section-nuovo-evento-btn">
                <a href="nuovoEvento_amministratore.php" class="button-nuovo-evento">AGGIUNGI</a>
        </section>
        
        <section class="table-aule">
            <table>
                <thead>
                    <tr>
                        <th>TITOLO</th>
                        <th>AULA</th>
                        <th>DATA</th>
                        <th>ORARIO</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(empty($templateParams["eventi"])): ?>
                        <tr>
                            <td colspan="4" style="text-align: center;">Nessun evento in programma.</td>
                        </tr>
                    <?php else: ?>
                        <?php foreach($templateParams["eventi"] as $evento): ?>
                            <?php 
                                // Gestione luogo: priorità all'aula, altrimenti lab, altrimenti trattino
                                $luogo = !empty($evento['numeroAula']) ? $evento['numeroAula'] : 
                                         (!empty($evento['numeroLab']) ? $evento['numeroLab'] : '-');
                                
                                // Formattazione data e ora
                                $dataFormattata = date("d/m/Y", strtotime($evento['data']));
                                $oraFormattata = date("H:i", strtotime($evento['oraInizio']));
                            ?>
                            <tr>
                                <td><?php echo htmlspecialchars($evento['titolo']); ?></td>
                                <td><?php echo htmlspecialchars($luogo); ?></td>
                                <td><?php echo $dataFormattata; ?></td>
                                <td><?php echo $oraFormattata; ?></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </section>
    </main>
    <?php require("footer.php"); ?>
</body>
</html>