<?php
class DatabaseHelper {
    private $db;

    public function __construct($servername, $username, $password, $dbname, $port){
        $this->db = new mysqli($servername, $username, $password, $dbname, $port);
        if($this->db->connect_error){
            die("Connesione fallita al db");
        }
    }
    
    //ho provato ad impostare la funzione con il controllo degli errori e la chiusura del stmt.
    //probabilmente è più completo, ma da valutare.
    public function get_prenotazioni_studente($nome){
        $stmt = $this->db->prepare("SELECT codicePre, nominativo, data, COALESCE(numeroLab, numeroAula) AS num, oraInizio, durata, motivazione
        FROM prenotazione WHERE nominativo = ?
        AND ((data > CURRENT_DATE) OR (data = CURRENT_DATE AND oraInizio > CURRENT_TIME))");
        $stmt->bind_param("s", $nome);
        if(!$stmt->execute()) {
            echo "errore query";
            $stmt->close();
            return [];
        }
        $result = $stmt->get_result();
        $dati =  $result->fetch_all(MYSQLI_ASSOC);
        $stmt->close();
        return $dati;
    }

    public function get_prenotazioni_admin(){
        $stmt = $this->db->prepare("SELECT codicePre, nominativo, data, COALESCE(numeroLab, numeroAula) AS num, oraInizio, durata, motivazione
        FROM prenotazione
        WHERE ((data > CURRENT_DATE) OR (data = CURRENT_DATE AND oraInizio > CURRENT_TIME))");
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function delete_prenotazione($cod){
        $stmt = $this->db->prepare("DELETE FROM prenotazione WHERE codicePre = ?");
        $stmt->bind_param('i', $cod);
        return $stmt->execute();
    }

    public function delete_evento($cod){
        $stmt = $this->db->prepare("DELETE FROM evento WHERE titolo = ?");
        $stmt->bind_param('s', $cod);
        return $stmt->execute();
    }
    
    public function get_statistiche_polivalente() {
    $stmt = $this->db->prepare("SELECT postiTotali, postiDisponibili, computerTotali, computerDisponibili, dataInizioChiusura, dataFineChiusura, motivoChiusura
              FROM POLIVALENTE 
              WHERE nome = 'Polivalente'");
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->fetch_assoc();
    }

    public function get_eventi() {
        $stmt = $this->db->prepare("SELECT titolo, data, oraInizio, durata, numeroLab, numeroAula, locandina, descrizione 
                  FROM EVENTO 
                  ORDER BY data ASC, oraInizio ASC");
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function get_evento_by_title($titolo) {
        $stmt = $this->db->prepare("SELECT titolo, data, oraInizio, durata, numeroLab, numeroAula, locandina, descrizione 
                  FROM EVENTO 
                  WHERE titolo = ?");
        $stmt->bind_param("s", $titolo);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }
    
    public function insert_richiesta_prenotazione($nominativo, $data, $oraInizio, $durata, $motivazione, $lab, $aula){
        $stmt = $this->db->prepare("INSERT INTO richiesta_in_corso (nominativo, data, oraInizio, durata, motivazione, numeroLab, numeroAula) 
                    VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param('sssisss', $nominativo, $data, $oraInizio, $durata, $motivazione, $lab, $aula);
        return $stmt->execute();
    }

    public function insert_evento($titolo, $data, $oraInizio, $durata, $numeroLab, $numeroAula, $locandina, $descrizione){
        $stmt = $this->db->prepare("INSERT INTO evento (titolo, data, oraInizio, durata, numeroLab, numeroAula, locandina, descrizione) 
                    VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param('sssissss', $titolo, $data, $oraInizio, $durata, $numeroLab, $numeroAula, $locandina, $descrizione);
        return $stmt->execute();
    }

    public function update_evento($titolo, $data, $oraInizio, $durata, $numeroLab, $numeroAula, $locandina, $descrizione, $id){
        $stmt = $this->db->prepare("UPDATE evento SET titolo = ?, data = ?, oraInizio = ?, durata = ?, numeroLab = ?, numeroAula = ?, locandina = ?, descrizione = ? WHERE titolo = ?");
        $stmt->bind_param('sssisssss', $titolo, $data, $oraInizio, $durata, $numeroLab, $numeroAula, $locandina, $descrizione, $id);
        return $stmt->execute();
    }

    public function get_aule(){
        $stmt = $this->db->prepare("SELECT numeroAula FROM aula");
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function get_lab(){
        $stmt = $this->db->prepare("SELECT numeroLab FROM laboratorio");
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }
    
    public function get_lezioni_in_corso() {
       $data = '2026-09-21';
       $stmt = $this->db->prepare("SELECT I.nomeIns AS nomeEvento, L.numeroAula, L.numeroLab, L.oraInizio, 
                    ADDTIME(L.oraInizio, SEC_TO_TIME(L.durata*60)) AS oraFine
              FROM LEZIONE L 
              JOIN INSEGNAMENTO I ON L.codiceIns = I.codiceIns 
              WHERE L.data = ? AND CURRENT_TIME BETWEEN L.oraInizio AND ADDTIME(L.oraInizio, SEC_TO_TIME(L.durata * 60))");
        $stmt->bind_param("s", $data);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function get_aula_cercata($search, $data) {
        $stmt = $this->db->prepare("SELECT numeroAula AS nomeAula, nomeAttivita AS nomeEvento, oraInizio AS orarioInizio, oraFine
            FROM (
            SELECT L.numeroAula, I.nomeIns as nomeAttivita, L.data, L.oraInizio,
                ADDTIME(L.oraInizio, SEC_TO_TIME(L.durata * 60)) AS oraFine
            FROM LEZIONE L
            JOIN INSEGNAMENTO I ON L.codiceIns = I.codiceIns
            WHERE L.numeroLab IS NULL

            UNION ALL

            SELECT E.numeroAula, CONCAT('ESAME: ', I.nomeIns) AS nomeAttivita, E.data, E.oraInizio,
                ADDTIME(E.oraInizio, SEC_TO_TIME(E.durata * 60)) AS oraFine
            FROM ESAME E
            JOIN INSEGNAMENTO I ON E.codiceIns = I.codiceIns
            WHERE E.numeroLab IS NULL

            UNION ALL
            
            SELECT LA.numeroAula, CONCAT('LAUREE: ', LA.corso) AS nomeAttivita, LA.data, LA.oraInizio,
                ADDTIME(LA.oraInizio, SEC_TO_TIME(LA.durata * 60)) AS oraFine
            FROM LAUREA LA

            UNION ALL

            SELECT EV.numeroAula, EV.titolo AS nomeAttivita, EV.data, EV.oraInizio,
                ADDTIME(EV.oraInizio, SEC_TO_TIME(EV.durata * 60)) AS oraFine
            FROM EVENTO EV
            WHERE EV.numeroLab IS NULL
            ) AS eventiAulaCercata
            WHERE data = ?
            AND (? = '' OR numeroAula = ?)
            ORDER BY oraInizio ASC
            ");

        $stmt->bind_param('sss', $data, $search, $search);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function get_laboratorio_cercato($search, $data) {
        $stmt = $this->db->prepare("SELECT numeroLab AS nomeLab, nomeAttivita AS nomeEvento, oraInizio AS orarioInizio, oraFine
            FROM (
            SELECT L.numeroLab, I.nomeIns as nomeAttivita, L.data, L.oraInizio,
                ADDTIME(L.oraInizio, SEC_TO_TIME(L.durata * 60)) AS oraFine
            FROM LEZIONE L
            JOIN INSEGNAMENTO I ON L.codiceIns = I.codiceIns
            WHERE L.numeroAula IS NULL

            UNION ALL

            SELECT E.numeroLab, CONCAT('ESAME: ', I.nomeIns) AS nomeAttivita, E.data, E.oraInizio,
                ADDTIME(E.oraInizio, SEC_TO_TIME(E.durata * 60)) AS oraFine
            FROM ESAME E
            JOIN INSEGNAMENTO I ON E.codiceIns = I.codiceIns
            WHERE E.numeroAula IS NULL

            UNION ALL

            SELECT EV.numeroLab, EV.titolo AS nomeAttivita, EV.data, EV.oraInizio,
                ADDTIME(EV.oraInizio, SEC_TO_TIME(EV.durata * 60)) AS oraFine
            FROM EVENTO EV
            WHERE EV.numeroAula IS NULL
            ) AS eventiLaboratorioCercato
            WHERE data = ?
            AND (? = '' OR numeroLab = ?)
            ORDER BY oraInizio ASC
            ");
        $stmt->bind_param('sss', $data, $search, $search);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getNumeroAuleOccupate() {
        $dataTest = '2026-09-22';
        $stmt = $this->db->prepare("SELECT COUNT(DISTINCT numeroAula) as conteggio FROM (
            SELECT numeroAula FROM LEZIONE 
            WHERE data = ? 
            AND CURRENT_TIME BETWEEN oraInizio AND ADDTIME(oraInizio, SEC_TO_TIME(durata * 60))
            UNION 
            SELECT numeroAula FROM ESAME 
            WHERE data = ? 
            AND CURRENT_TIME BETWEEN oraInizio AND ADDTIME(oraInizio, SEC_TO_TIME(durata * 60))
            UNION 
            SELECT numeroAula FROM EVENTO 
            WHERE data = ? 
            AND CURRENT_TIME BETWEEN oraInizio AND ADDTIME(oraInizio, SEC_TO_TIME(durata * 60))
            UNION 
            SELECT numeroAula FROM LAUREA 
            WHERE data = ? 
            AND CURRENT_TIME BETWEEN oraInizio AND ADDTIME(oraInizio, SEC_TO_TIME(durata * 60))
        ) AS t WHERE numeroAula IS NOT NULL");

        $stmt->bind_param("ssss", $dataTest, $dataTest, $dataTest, $dataTest);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc()["conteggio"];
    }

    public function getNumeroLabOccupati() {
        $dataTest = '2026-09-22';
        $stmt = $this->db->prepare("SELECT COUNT(DISTINCT numeroLab) as conteggio FROM (
            SELECT numeroLab FROM LEZIONE 
            WHERE data = ? 
            AND CURRENT_TIME BETWEEN oraInizio AND ADDTIME(oraInizio, SEC_TO_TIME(durata * 60))
            UNION 
            SELECT numeroLab FROM ESAME 
            WHERE data = ? 
            AND CURRENT_TIME BETWEEN oraInizio AND ADDTIME(oraInizio, SEC_TO_TIME(durata * 60))
            UNION 
            SELECT numeroLab FROM EVENTO 
            WHERE data = ? 
            AND CURRENT_TIME BETWEEN oraInizio AND ADDTIME(oraInizio, SEC_TO_TIME(durata * 60))
        ) AS t WHERE numeroLab IS NOT NULL");

        $stmt->bind_param("sss", $dataTest, $dataTest, $dataTest);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc()["conteggio"];
    }

    public function getEventiInProgramma() {
    $dataTest = '2026-09-21';
    $stmt = $this->db->prepare("SELECT COUNT(*) as conteggio FROM EVENTO 
              WHERE data > ? 
              OR (data = ? AND oraInizio > CURRENT_TIME)");
              
    $stmt->bind_param("ss", $dataTest, $dataTest);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->fetch_assoc()["conteggio"];
    }

    public function getTotaleAule() {
        $stmt = $this->db->prepare("SELECT COUNT(*) as totale FROM AULA");
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc()["totale"];
    }

    public function getTotaleLab() {
        $stmt = $this->db->prepare("SELECT COUNT(*) as totale FROM LABORATORIO");
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc()["totale"];
    }

    public function getRichiesteInCorso() {        
        $stmt = $this->db->prepare("SELECT codiceRichiesta, nominativo, data, oraInizio, durata, motivazione, numeroLab, numeroAula 
                  FROM RICHIESTA_IN_CORSO 
                  ORDER BY data ASC, oraInizio ASC");
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function get_richiesta_by_name($nome) {        
        $stmt = $this->db->prepare("SELECT codiceRichiesta, nominativo, data, oraInizio, durata, motivazione, COALESCE(numeroLab, numeroAula) AS num
        FROM richiesta_in_corso WHERE nominativo = ?");
        $stmt->bind_param("s", $nome);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function get_richiesta_by_cod($cod) {        
        $stmt = $this->db->prepare("SELECT codiceRichiesta, nominativo, data, oraInizio, durata, motivazione, numeroLab, numeroAula
        FROM richiesta_in_corso WHERE codiceRichiesta = ?");
        $stmt->bind_param("i", $cod);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    public function update_richiesta($nominativo, $data, $oraInizio, $durata, $motivazione, $lab, $aula, $id){
        $stmt = $this->db->prepare("UPDATE richiesta_in_corso SET nominativo = ?, data = ?, oraInizio = ?, durata = ?, motivazione = ?, numeroLab = ?, numeroAula = ? WHERE codiceRichiesta = ?");
        $stmt->bind_param('sssisssi', $nominativo, $data, $oraInizio, $durata, $motivazione, $lab, $aula, $id);
        return $stmt->execute();
    }

    public function delete_richiesta($cod){
        $stmt = $this->db->prepare("DELETE FROM richiesta_in_corso WHERE codiceRichiesta = ?");
        $stmt->bind_param('i', $cod);
        return $stmt->execute();
    }

    public function accettaRichiesta($cod) {
        $stmt_select = $this->db->prepare("SELECT * FROM richiesta_in_corso WHERE codiceRichiesta = ?");
        $stmt_select->bind_param('i', $cod);
        $stmt_select->execute();
        $result = $stmt_select->get_result();
        $richiesta = $result->fetch_assoc();

        if (!$richiesta) {
            throw new Exception("Richiesta non trovata.");
        }

        $inserita = $this-> insert_prenotazione($richiesta['nominativo'], $richiesta['data'], $richiesta['oraInizio'],
                                                $richiesta['durata'], $richiesta['motivazione'], $richiesta['numeroLab'], 
                                                $richiesta['numeroAula']);
        
        if (!$inserita) {
            throw new Exception("Errore nell'inserimento della nuova prenotazione");
        }                                    

        $eliminato = $this->delete_richiesta($cod);

        if(!$eliminato){
            throw new Exception("Errore nell'eliminazione della richiesa");
        }

    }  

    public function insert_prenotazione($nominativo, $data, $oraInizio, $durata, $motivazione, $lab, $aula){
        $stmt = $this->db->prepare("INSERT INTO prenotazione (nominativo, data, oraInizio, durata, motivazione, numeroLab, numeroAula) 
                    VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param('sssisss', $nominativo, $data, $oraInizio, $durata, $motivazione, $lab, $aula);
        return $stmt->execute();
    }

    public function countRichieste($nominativo){
        $stmt = $this->db->prepare("SELECT COUNT(*) AS richiestePendenti FROM RICHIESTA_IN_CORSO WHERE nominativo = ?");
        $stmt->bind_param('s', $nominativo);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($row = $result->fetch_assoc()) {
            return $row['richiestePendenti']; 
        }

        return 0;
    }

    public function getStudente($email){
        $stmt = $this->db->prepare("SELECT * FROM studente WHERE email = ?");
        $stmt_select->bind_param('s', $email);
        $stmt_select->execute();
        $result = $stmt_select->get_result();
        return $result->fetch_assoc();
    }
    
    public function getAmministratore($email){
        $stmt = $this->db->prepare("SELECT * FROM amministratore WHERE email = ?");
        $stmt_select->bind_param('s', $email);
        $stmt_select->execute();
        $result = $stmt_select->get_result();
        return $result->fetch_assoc();
    }

    public function get_prenotazioni_filtrate_admin($search, $data) {
        $stmt = $this->db->prepare("SELECT codicePre, nominativo, data, COALESCE(numeroLab, numeroAula) AS num, oraInizio, durata, motivazione
                FROM prenotazione
                WHERE ((data > CURRENT_DATE) OR (data = CURRENT_DATE AND oraInizio > CURRENT_TIME))
                AND COALESCE(numeroLab, numeroAula) = ? 
                AND data = ?");

        $stmt->bind_param("ss", $search, $data);
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }
}

?>