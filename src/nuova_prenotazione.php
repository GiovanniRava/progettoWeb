<!DOCTYPE html>
<html lang="it">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" charset="UTF-8"/>
    <title>Nuova - Prenotazione - Studente</title>
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
    <nav>
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
            <h2>NUOVA PRENOTAZIONE</h2>
        </div>
        <div class="back-container">
            <a href="prenotazioni_studente.php" class="back-box" title="BackToPrenotazioni">
                <span class="cross-icon">&times;</span>
            </a>
        </div>
    </div>
    
    <div class="form-prenotazione">
        <form action="#" method="POST" class="form-form-prenotazione">
            <ul>
                <li>
                    <div class="col">
                        <label for="Aula/Laboratorio">Seleziona Aula o Lab</label>
                        <input type="text" class="input-medio" id="aula-lab" name="aula-lab" />
                    </div>
                    <div class="col">
                        <label for="data">Data</label>
                        <input type="date" class="input-medio" id="data" name="data" />
                    </div>
                </li>
                <li>
                    <div class="col">
                        <label for="ora">Scegli l'orario:</label>
                        <select class="input-medio" name="oraInizio" id="ora">
                            <option value="09:00">09:00</option>
                            <option value="09:30">09:30</option>
                            <option value="10:00">10:00</option>
                            <option value="10:30">10:30</option>
                            <option value="11:00">11:00</option>
                            <option value="11:30">11:30</option>
                            <option value="12:00">12:00</option>
                            <option value="12:30">12:30</option>
                            <option value="13:00">13:00</option>
                            <option value="13:30">13:30</option>
                            <option value="14:00">14:00</option>
                            <option value="14:30">14:30</option>
                            <option value="15:00">15:00</option>
                            <option value="15:30">15:30</option>
                            <option value="16:00">16:00</option>
                            <option value="16:30">16:30</option>
                            <option value="17:00">17:00</option>
                            <option value="17:30">17:30</option>
                            <option value="18:00">18:00</option>
                        </select>
                    </div>
                    <div class="col">
                    <label for="durata">Durata</label>
                        <select class="input-medio" name="durataPermanenza" id="durata">
                            <option value="00:30">00:30</option>
                            <option value="01:00">01:00</option>
                            <option value="01:30">01:30</option>
                            <option value="02:00">02:00</option>
                            <option value="02:30">02:30</option>
                            <option value="03:00">03:00</option>
                        </select>
                    </div>
                </li>
                <li>
                    <div class="col">
                        <label for="username">Nome e Cognome</label>
                        <input type="text" class="input-pieno" id="nominativo" name="nominativo" />
                    </div>
                </li>
                <li>
                    <div class="col">
                        <label for="motivazione">Motivazione</label>
                        <textarea name="motivazionePrenotazione" rows="7" placeholder="Scrivi..."></textarea>
                    </div>
                </li>
                <li>
                    <input type="submit" name="submit" class="button-nuova-prenotazione" value="INVIA PRENOTAZIONE" />
                </li>
            </ul>  
        </form>
    </div>

    <footer>
        <p>Contatti Per Docenti - Assistenza Didattica tel:0512080302</p>
        <p>Contatti Per Studenti - Help Desk Studenti tel:0512080301</p>
    </footer>
</body>