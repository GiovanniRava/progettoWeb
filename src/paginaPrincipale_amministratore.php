<!DOCTYPE html>
<html lang="it">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" charset="UTF-8"/>
    <title>Pagina Principale - admin</title>
    <link rel="stylesheet" type="text/css" href="./css/style.css" />
</head>
<body>
    <header>
        <div class="logo">
            <a href="index.php">
                <img src="upload/uniboLogo.png" alt="Logo Alma Aule">
            </a>
        </div>
        <div class="title">
            <h1>Alma Aule</h1>
        </div>
        <div class="menu-container">
            <a href="menu.php" style="text-decoration: none; font-size: 35px; color: #333333; line-height: 1;">
                &#9776;
            </a>
        </div>
    </header>
    <nav class="navbar-desktop">
        <ul>
            <li><a href="">PRENOTAZIONI</a></li>
            <li><a href="richieste_admin.php">RICHIESTE IN CORSO</a></li>
            <li><a href="eventi_admin.php">EVENTI</a></li>
        </ul>
    </nav>
    <div class="red-bar">
        <div class="spacer"></div>
        <div class="subtitle">
            <h2>INFORMAZIONI GENERALI</h2>
        </div>
        <div class="spacer"></div>
    </div>
    <div class="container-pagPrincAdmin">
        <section class="sezione-numeri">
            <?php include('infoGenerali_amministratore.php'); ?>
        </section>
        <section class="sezione-richiesteInCorso">
            <?php include('richieste_admin.php'); ?>
        </section>   
    </div>
    <footer>
        <p>Contatti Per Docenti - Assistenza Didattica tel:0512080302</p>
        <p>Contatti Per Studenti - Help Desk Studenti tel:0512080301</p>
    </footer>
</body>
</html> 
