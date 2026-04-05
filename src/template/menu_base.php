<!DOCTYPE html>
<html lang="it">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu - Alma Aule</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>

<body>
    <header class="header-menu">
        <a href="javascript:history.back()" class="btn-indietro-menu">&gt;</a>
        <img src="upload/uniboLogo.png" alt="Logo Università" class="logo-menu">
    </header>

    <div class="red-bar">
        <div class="spacer"></div>
        <div class="subtitle">
            <h2>MENU</h2>
        </div>
        <div class="spacer"></div>
    </div>

    <nav class="menu-navigazione">
        <ul>
            <?php foreach ($templateParams["voci_menu"] as $voce): ?>
                <li>
                    <a href="<?php echo $voce['url']; ?>">
                        <?php echo htmlspecialchars($voce['nome']); ?>
                    </a>
                </li>
            <?php endforeach; ?>
        </ul>
    </nav>

    <div class="sezione-logout">
        <a href="index.php" class="btn-logout">LOGOUT</a>
    </div>

    <?php require("footer.php"); ?>
</body>

</html>