<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Richieste in corso - Amministrazione</title>
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
            <span id="apri-menu">&#9776;</span>
        </div>
    </header>

    <div class="red-bar">
        <div class="spacer"></div>
        <div class="subtitle">
            <h2>RICHIESTE IN CORSO</h2>
        </div>
        <div class="spacer"></div>
    </div>

    <main>
        <section class="tabella-prenotazioni">
            <table>
                <thead>
                    <tr>
                        <th>AULA/LAB</th>
                        <th>DATA</th>
                        <th>ORARIO</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="riga-principale">
                        <td>2.12</td>
                        <td>19-09-2026</td>
                        <td>10:00 - 12:00</td>
                        <td>
                            <button class="toggle-btn">&#708;</button>
                        </td>
                    </tr>
                    <tr class="riga-dettagliPrenotazione">
                        <td>
                            <span class="etichetta-dettaglio">NOME e COGNOME</span><br>
                            Riccardo Cornacchia
                        </td>
                        <td>
                            <span class="etichetta-dettaglio">MOTIVAZIONE</span><br>
                            Presentazione progetto Web
                        </td>
                        <td colspan="2">
                            <div class="container-bottoni">
                                <button class="btn-accetta">Accetta</button>
                                <button class="btn-rifiuta">Rifiuta</button>
                            </div>
                        </td>
                    </tr>

                    <tr class="riga-principale">
                        <td>Lab. Info</td>
                        <td>21-10-2026</td>
                        <td>14:00 - 16:00</td>
                        <td>
                            <button class="toggle-btn">&#709;</button>
                        </td>
                    </tr>
                    <tr class="riga-dettagliPrenotazione nascosta">
                        <td>
                            <span class="etichetta-dettaglio">NOME e COGNOME</span><br>
                            Francesca Gatti
                        </td>
                        <td>
                            <span class="etichetta-dettaglio">MOTIVAZIONE</span><br>
                            Esercitazione Reti
                        </td>
                        <td colspan="2">
                            <div class="container-bottoni">
                                <button class="btn-accetta">Accetta</button>
                                <button class="btn-rifiuta">Rifiuta</button>
                            </div>
                        </td>
                    </tr>

                    <tr class="riga-principale">
                        <td>2.13</td>
                        <td>22-10-2026</td>
                        <td>09:00 - 11:00</td>
                        <td>
                            <button class="toggle-btn">&#709;</button>
                        </td>
                    </tr>
                    <tr class="riga-dettagliPrenotazione nascosta">
                        <td>
                            <span class="etichetta-dettaglio">NOME e COGNOME</span><br>
                            <strong>Giovanni MAria Rava</strong>
                        </td>
                        <td>
                            <span class="etichetta-dettaglio">MOTIVAZIONE</span><br>
                            <strong>Recupero lezione</strong>
                        </td>
                        <td colspan="2">
                            <div class="container-bottoni">
                                <button class="btn-accetta">Accetta</button>
                                <button class="btn-rifiuta">Rifiuta</button>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </section>
    </main>

    <footer>
        <p>Contatti Per Docenti - Assistenza Didattica tel:0512080302</p>
        <p>Contatti Per Studenti - Help Desk Studenti tel:0512080301</p>
    </footer>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const bottoniToggle = document.querySelectorAll('.toggle-btn');

            bottoniToggle.forEach(bottone => {
                bottone.addEventListener('click', function() {
                    const rigaPrincipale = this.closest('.riga-principale');
                    const rigaDettagli = rigaPrincipale.nextElementSibling;
                    const isNascosta = rigaDettagli.classList.contains('nascosta');

                    if (isNascosta) {
                        rigaDettagli.classList.remove('nascosta');
                        this.innerHTML = '&#708;';
                    } else {
                        rigaDettagli.classList.add('nascosta');
                        this.innerHTML = '&#709;';
                    }
                });
            });
        });
    </script>
</body>
</html>