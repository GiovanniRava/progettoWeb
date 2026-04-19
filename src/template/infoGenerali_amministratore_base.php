<!DOCTYPE html>
<html lang="it">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" charset="UTF-8"/>
    <title>Cerca aula</title>
    <link rel="stylesheet" type="text/css" href="./css/style.css" />
</head>
<div class="container-infoGen">
    <div class="stato-aule">
        <div class="stato">
            <h2><?php echo $templateParams["auleOccupate"]; ?></h2>
            <p>AULE OCCUPATE</p>
        </div>
        <div class="stato">
            <h2><?php echo $templateParams["totaleAule"]; ?></h2>
            <p>AULE TOTALI</p>
        </div>
        <div class="stato">
            <h2><?php echo $templateParams["labOccupati"]; ?></h2>
            <p>LABORATORI OCCUPATI</p>
        </div>
        <div class="stato">
            <h2><?php echo $templateParams["totaleLab"]; ?></h2>
            <p>LABORATORI TOTALI</p>
        </div>
    </div>
    <div class="eventi">
        <h2><?php echo $templateParams["eventiInCorso"]; ?></h2>
        <p>EVENTI IN PROGRAMMA</p>
    </div>
</div>
</html>
