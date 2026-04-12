<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Pagina Iniziale Accesso</title>
    <link rel="stylesheet" type="text/css" href="./css/style.css" />
</head>
<body>
    <header>
        <div class="logo">
            <a href="index.php">
                <figure>
                    <img src="upload/uniboLogo.png" alt="Logo Alma Aule">
                </figure>
            </a>
        </div>
        <div class="title">
            <h1>Alma Aule</h1>
        </div>
        <div class="login">
            <a href="login.php">Login</a>
        </div>
    </header>
    
    <main class="main-home">
        <?php if(isset($templateParams["login"])):
            include($templateParams["login"]);
        else: ?>
            <figure>
                <img src="upload/giardinoCampus.jpeg" alt="giardino Campus di Cesena, foto sfondo Home page" class="home-img">
            </figure>
        <?php endif; ?>
    </main>
    <?php include($templateParams["footer"]); ?>
</body>