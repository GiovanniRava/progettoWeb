# progettoWeb
# Progetto Tecnologie Web -  ALMA AULE
## Gestione Aule e Laboratori Universitari

Questo progetto è un'applicazione web sviluppata per la gestione delle aule, dei laboratori e degli eventi all'interno di un polo universitario. Permette agli studenti di visualizzare l'occupazione degli spazi e prenotare aule per lo studio, e agli amministratori di gestire le richieste e inserire o modificare nuovi eventi.

## 🚀 Funzionalità Principali

* **Gestione Spazi:** Visualizzazione e gestione di Aule, Laboratori e dell'aula Polivalente.
* **Orario Universitario:** Integrazione con i dati relativi agli insegnamenti, lezioni quotidiane, appelli d'esame e sedute di laurea.
* **Sistema di Prenotazione:**
  * Gli utenti possono cercare spazi liberi ed effettuare richieste di prenotazione per lo studio o per progetti.
  * Gli amministratori possono approvare o rifiutare le richieste di prenotazioni tramite l'apposito pannello.
* **Gestione Eventi (Area Admin):** Creazione, modifica e cancellazione di eventi personalizzati (es. seminari, workshop, presentazioni) con sistema di upload per le locandine.
* **Design Responsivo:** L'interfaccia utente è adattata sia per dispositivi desktop che mobile, offrendo viste specifiche a seconda del device utilizzato.

## 🛠️ Tecnologie Utilizzate

* **Front-end:** HTML5, CSS, Javascript (layout responsivo tramite Flexbox, CSS Grid e Media Queries).
* **Back-end:** PHP (gestione logica applicativa, upload file, autenticazione utente e interazione al database).
* **Database:** SQL (MySQL) per la persistenza e il retrieval dei dati.

## ⚙️ Installazione e Configurazione

1. Clonare il repository all'interno della propria "Document Root" del web server locale (es. cartella `htdocs` per XAMPP o `www` per MAMP/WAMP).
2. Avviare il server Apache e il database MySQL.
3. Creare un nuovo database nel proprio server tramite `db/ProjectWeb.sql`.
4. Importare i dati fittizi eseguendo gli script SQL presenti in `src/db/insert_data.sql`.
5. Assicurarsi che la cartella dedicata all'upload delle immagini (definita come costante in `bootstrap.php`) abbia i permessi di lettura/scrittura adeguati.
6. Configurare le credenziali di accesso al database nei file di connessione (`bootstrap.php`).
7. Aprire il browser e navigare all'indirizzo locale del progetto (es. `http://localhost/progettoWeb/src/`).