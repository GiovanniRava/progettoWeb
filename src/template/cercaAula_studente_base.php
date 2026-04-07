<!DOCTYPE html>
<html lang="it">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" charset="UTF-8"/>
    <title>Cerca aula</title>
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
            <li><a href="cercaAula_studente.php">AULE</a></li>
            <li><a href="cercaLaboratorio_studente.php">LABORATORI</a></li>
            <li><a href="polivalente.php">POLIVALENTE</a></li>
            <li><a href="eventi_studente.php">EVENTI</a></li>
            <li><a href="prenotazioni_studente.php">PRENOTAZIONI</a></li>
        </ul>
    </nav>
    <div class="red-bar">
        <div class="spacer"></div>
        <div class="subtitle">
            <h2>CERCA AULA</h2>
        </div>
        <div class="spacer"></div>
    </div>

    <main>
        <section class="search-bar">
            <form action="#" method="GET">
                <div class="input-aule">
                    <input type="text" id="search" name="search" placeholder="Cerca..."
                    value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>">
                    <input type="date" id="data-lezione" name="data-lezione"
                    value="<?php echo isset($_GET['data-lezione']) ? htmlspecialchars($_GET['data-lezione']) : date('Y-m-d'); ?>">
                </div>
                <button type="submit" class="button-prenota">PRENOTA</button>
            </form>
        </section>
        <section class = "table-aule">
            <table>
                <thead>
                    <tr>
                        <th>AULA</th>
                        <th>EVENTO</th>
                        <th>ORARIO</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(empty($templateParams["aule"])): ?>
                        <tr>
                            <td>Nessuna aula trovata.</td>
                        </tr>
                    <?php else: ?>
                        <?php foreach($templateParams["aule"] as $aula): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($aula["nomeAula"]); ?></td>
                                <td><?php echo htmlspecialchars($aula["nomeEvento"]); ?></td>
                                <td><?php echo htmlspecialchars($aula["orarioInizio"]); ?></td>
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