<!DOCTYPE html>
<html lang="it">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" charset="UTF-8"/>
    <title>Lezioni in corso</title>
    <link rel="stylesheet" type="text/css" href="./css/style.css" />
</head>
<body>
    <header>
        <div class="logo">
            <a href="paginaPrincipale_studente.php">
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
    <div class = "red-bar">
        <div class = "spacer"></div>
        <div class = "subtitle">
            <h2>LEZIONI IN CORSO</h2>
        </div>
        <div class = "spacer"></div>
    </div>
    <main>
        <table>
            <thead>
                <tr>
                    <th>EVENTO</th>
                    <th>AULA</th>
                </tr>
            </thead>
            <tbody>
                <?php if(empty($templateParams["lezioni"])): ?>
                    <tr>
                        <td colspan="2">Nessuna lezione in corso.</td>
                    </tr>
                <?php else: ?>
                    <?php foreach($templateParams["lezioni"] as $lezione): ?>
                    <tr>
                        <td>
                            <?php echo $lezione["nomeEvento"]; ?>
                        </td>
                        <td>
                            <?php echo !empty($lezione["numeroAula"]) ?
                            "Aula".$lezione["numeroAula"] :
                            "Lab".$lezione["numeroLab"]; ?>
                        </td>
                    </tr> 
                    <?php endforeach; ?>
                <?php endif; ?>   
            </tbody>
        </table>
    </main>

     <footer>
        <p>Contatti</p>
    </footer>
</body>
</html>