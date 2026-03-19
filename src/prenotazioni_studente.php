<!DOCTYPE html>
<html lang="it">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" charset="UTF-8"/>
    <title>Prenotazioni-Studente</title>
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
        <div class="hamburgerMenu" id="hamburger">
            <span></span>
            <span></span>
            <span></span>
        </div>
    </header>
    <div class="red-bar">
        <div class="spacer"></div>
        <div class="subtitle">
            <h2>LE MIE PRENOTAZIONI</h2>
        </div>
        <div class="add-container">
            <a href="nuova_prenotazione.php" class="add-box" title="AggiungiPrenotazione">
                <span class="plus-icon">+</span>
            </a>
        </div>
    </div>
    
    <main>
        <table>
            <tr>
                <th>AULA / LAB</th>
                <th>ORARIO</th>
                <th></th>
            </tr>
            <tr>
                <td>2.12</td>
                <td>10.00 - 12.00</td>
                <td>
                    <button id="button-annulla-prenotazione" class="button-annulla-prenotazione">ANNULLA</button>
                    <dialog id="finestra-annulla">
                        <h3>ANNULLAMENTO PRENOTAZIONE</h3>
                        <p>Sei sicuro di voler annullare la prenotazione?</p>
                        <button id="conferma-annulla">SI</button><button id="revoca-annulla">NO</button>
                    </dialog>
                </td>
            </tr>
        </table>
    </main>

    <footer>
        <p>Contatti Per Docenti - Assistenza Didattica tel:0512080302</p>
        <p>Contatti Per Studenti - Help Desk Studenti tel:0512080301</p>
    </footer>

    <script>
        const finestra = document.getElementById('finestra-annulla');
        const btnApri = document.getElementById('button-annulla-prenotazione');
        const btnNo = document.getElementById('revoca-annulla');
        const btnSi = document.getElementById('conferma-annulla');

        // Funzione per aprire la finestra
        btnApri.addEventListener('click', () => {
            finestra.showModal(); 
        });

        // Funzione per chiudere se clicchi NO
        btnNo.addEventListener('click', () => {
            finestra.close();
        });

        // Azione se clicchi SI
        btnSi.addEventListener('click', () => {
            console.log("Prenotazione annullata!");
            finestra.close();
            // Qui aggiungerai la logica per cancellare davvero (es. una chiamata al database)
        });
    </script>
</body>