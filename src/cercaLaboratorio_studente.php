<!DOCTYPE html>
<html lang="it">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" charset="UTF-8"/>
    <title>Cerca laboratorio</title>
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
    <div class = "red-bar">
        <div class = "spacer"></div>
        <div class = "subtitle">
            <h2>CERCA LABORATORIO</h2>
        </div>
        <div class = "spacer"></div>
    </div>

    <main>
        <section class="search-bar">
            <form action="#" method="GET">
                <div class="input-lab">
                    <input type="text" id="search" name="search" placeholder="Search...">
                    <input type="date" id="data-lezione" name="data-lezione">
                </div>
                <button type="submit" class = "button-prenota">PRENOTA</button>
            </form>
        </section>
        <section class = "table-lab">
            <table>
                <thead>
                    <tr>
                        <th>LABORATORIO</th>
                        <th>EVENTO</th>
                        <th>ORARIO</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>2.2</td>
                        <td>Tecnologie Web</td>
                        <td>09:00-11-00</td>
                    </tr>
                </tbody>
            </table>
        </section>
    </main>
     <footer>
        <p>Contatti</p>
    </footer>
</body>

</html> 