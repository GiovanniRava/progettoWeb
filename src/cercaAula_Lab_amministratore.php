<!DOCTYPE html>
<html lang="it">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" charset="UTF-8"/>
    <title>Cerca aula/lab - amministrazione</title>
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
        <div class="hamburgerMenu" id="hamburger">
            <span></span>
            <span></span>
            <span></span>
        </div>
    </header>
    <div class="red-bar">
        <div class="spacer"></div>
        <div class="subtitle">
            <h2>CERCA AULA/LABORATORIO</h2>
        </div>
        <div class="spacer"></div>
    </div>

    <main>
        <section class="search-bar">
            <form action="#" method="GET">
                <div class="input-aule">
                    <input type="text" id="search" name="search" placeholder="Search...">
                </div>
            </form>
        </section>
        <section class="tabella-prenotazioni">
            <table>
                <thead>
                    <tr>
                        <th>AULA</th>
                        <th>DATA</th>
                        <th>ORARIO</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="riga-principale">
                        <td>2.12</td>
                        <td>19-09-2026</td>
                        <td>10.00-12.00</td>
                        <td>
                            <button class="toggle-btn">▼</button>
                        </td>
                    </tr>
                    <tr class="riga-dettagliPrenotazione">
                        <td colspan="4">
                            <div class="dettagli">
                                <p>Nome e Cognome: Mario Rossi</p>
                                <p>Motivazione: presentazione progetto Web</p>
                                <button id="button-elimina" class="button-elimina">ELIMINA</button>
                                <dialog id="finestra-elimina">
                                    <h3>ELIMINAZIONE PRENOTAZIONE</h3>
                                    <p>Sei sicuro di voler eliminare la prenotazione?</p>
                                    <button id="conferma-elimina">SI</button><button id="revoca-elimina">NO</button>
                                </dialog>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </section>
    </main>

    <footer>
        <p>Contatti</p>
    </footer>

    <script>
        const finestra = document.getElementById('finestra-elimina');
        const btnApri = document.getElementById('button-elimina');
        const btnNo = document.getElementById('revoca-elimina');
        const btnSi = document.getElementById('conferma-elimina');

        btnApri.addEventListener('click', () => {
            finestra.showModal(); 
        });

        btnNo.addEventListener('click', () => {
            finestra.close();
        });

        btnSi.addEventListener('click', () => {
            console.log("Prenotazione annullata!");
            finestra.close();
            // Qui aggiungerai la logica per cancellare davvero (es. una chiamata al database)
        });
    </script>
    
    <!--
    <script>
        document.querySelectorAll(".toggle-btn").forEach((btn) => {
            btn.addEventListener("click", function () {
                const rigaPrincipale = this.closest("tr");
                const rigaDettagli = rigaPrincipale.nextElementSibling;

                if(rigaDettagli.style.display == "table-row") {
                    rigaDettagli.style.display = "none";
                    this.textContent = "▼";
                } else {
                    rigaDettagli.style.display = "table-row";
                    this.textContent = "▲";
                }
            });
        });
    </script> -->
</body>
</html>