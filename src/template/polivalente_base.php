<!DOCTYPE html>
<html lang="it">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="UTF-8">
    <title>Polivalente - Alma Aule</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>        
    <?php require($templateParams["nome"]); ?>
    
    <div class="red-bar">
        <div class="spacer"></div>
        <div class="subtitle">
            <h2>POLIVALENTE</h2>
        </div>
        <div class="spacer"></div>
    </div>

    <main class="contenuto-aula">
        
        <div class="orario-badge">
            <span class="icona-orologio">⏰</span> ORARIO: 8:30 - 18:30
        </div>

        <div class="griglia-statistiche">
            <?php 
            $stat = $templateParams["statistiche"]; 
            ?>
            <div class="stat-box">
                <div class="stat-numero"><?php echo isset($stat['postiDisponibili']) ? $stat['postiDisponibili'] : '-'; ?></div>
                <div class="stat-testo">POSTI DISPONIBILI</div>
            </div>
            <div class="stat-box">
                <div class="stat-numero"><?php echo isset($stat['postiTotali']) ? $stat['postiTotali'] : '-'; ?></div>
                <div class="stat-testo">POSTI TOTALI</div>
            </div>
            <div class="stat-box">
                <div class="stat-numero"><?php echo isset($stat['computerTotali']) ? $stat['computerTotali'] : '-'; ?></div>
                <div class="stat-testo">COMPUTER<br>TOTALI</div>
            </div>
            <div class="stat-box">
                <div class="stat-numero"><?php echo isset($stat['computerDisponibili']) ? $stat['computerDisponibili'] : '-'; ?></div>
                <div class="stat-testo">COMPUTER<br>DISPONIBILI</div>
            </div>
        </div>

        <div class="banner-avviso">
            <p>CHIUSURA POLIVALENTE<br>DAL 6/07 AL 10/07<br>PER DISCUSSIONE LAUREA</p>
        </div>

    </main>

    <footer>
        <p>Contatti Per Docenti - Assistenza Didattica tel:0512080302</p>
        <p>Contatti Per Studenti - Help Desk Studenti tel:0512080301</p>
    </footer>

</body>
</html>