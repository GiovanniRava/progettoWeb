<!DOCTYPE html>
<html lang="it">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="UTF-8">
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
    
    <main class="container-eventi">
        <section class="griglia-eventi">
            
            <?php foreach($templateParams["eventi"] as $evento): ?>
                <article class="card-evento">
                    <img src="upload/<?php echo htmlspecialchars($evento['locandina']); ?>" 
                         alt="Locandina <?php echo htmlspecialchars($evento['titolo']); ?>" 
                         class="img-evento">
                    
                    <div class="info-evento">
                        <?php 
                            $luogo = !empty($evento['numeroAula']) ? $evento['numeroAula'] : 
                                     (!empty($evento['numeroLab']) ? $evento['numeroLab'] : '');
                            $titoloDisplay = !empty($luogo) ? $evento['titolo'] . ' - ' . $luogo : $evento['titolo'];
                            $dataFormattata = date("d/m/Y", strtotime($evento['data']));
                            $oraFormattata = date("H:i", strtotime($evento['oraInizio']));
                        ?>
                        <h3><?php echo htmlspecialchars($titoloDisplay); ?></h3>
                        <span class="data-evento"><?php echo $dataFormattata; ?> - Ore <?php echo $oraFormattata; ?></span>
                    </div>
                </article>
            <?php endforeach; ?>

        </section>
    </main>
    
    <footer>
        <p>Contatti Per Docenti - Assistenza Didattica tel:0512080302</p>
        <p>Contatti Per Studenti - Help Desk Studenti tel:0512080301</p>
    </footer>
</body>
</html>