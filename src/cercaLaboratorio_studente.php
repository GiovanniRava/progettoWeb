<!DOCTYPE html>
<html lang="it">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" charset="UTF-8"/>
    <title>Cerca laboratorio</title>
    <link rel="stylesheet" type="text/css" href="./css/style_cercaAulaLab.css" />
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
        <div class = "hamburgerMenu" id = "hamburger">
            <span></span>
            <span></span>
            <span></span>
        </div>
    </header>
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