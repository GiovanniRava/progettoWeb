<?php
class DatabaseHelper {
    private $db;

    public function __construct($servername, $username, $password, $dbname, $port){
        $this->db = new mysqli($servername, $username, $password, $dbname, $port);
        if($this->db->connect_error){
            die("Connesione fallita al db");
        }
    }
    
    public function get_prenotazioni_studente($nome){
        $stmt = $this->db->prepare("SELECT codicePre, nominativo, data, COALESCE(numeroLab, numeroAula) AS num, oraInizio, durata, motivazione
        FROM prenotazione WHERE nominativo = ?");
        $stmt->bind_param("s", $nome);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function get_prenotazioni_admin(){
        $stmt = $this->db->prepare("SELECT codicePre, nominativo, data, COALESCE(numeroLab, numeroAula) AS num, oraInizio, durata, motivazione
        FROM prenotazione");
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
    $stmt = $this->db->prepare("SELECT postiTotali, postiDisponibili, computerTotali, computerDisponibili 
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
        $query = "INSERT INTO richiesta_in_corso (nominativo, data, oraInizio, durata, motivazione, numeroLab, numeroAula) 
                    VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('sssisss', $nominativo, $data, $oraInizio, $durata, $motivazione, $lab, $aula);
        return $stmt->execute();
    }

    public function insert_evento($titolo, $data, $oraInizio, $durata, $numeroLab, $numeroAula, $locandina, $descrizione){
        $query = "INSERT INTO evento (titolo, data, oraInizio, durata, numeroLab, numeroAula, locandina, descrizione) 
                    VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('sssissss', $titolo, $data, $oraInizio, $durata, $numeroLab, $numeroAula, $locandina, $descrizione);
        return $stmt->execute();
    }

    public function update_evento($titolo, $data, $oraInizio, $durata, $numeroLab, $numeroAula, $locandina, $descrizione, $id){
        $query = "UPDATE evento SET titolo = ?, data = ?, oraInizio = ?, durata = ?, numeroLab = ?, numeroAula = ?, locandina = ?, descrizione = ? WHERE titolo = ?";
        $stmt = $this->db->prepare($query);
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
       $query = "SELECT I.nomeIns, L.numeroAula, L.numeroLab, L.oraInizio, L.durata
              FROM LEZIONE L 
              JOIN INSEGNAMENTO I ON L.codiceIns = I.codiceIns 
              WHERE L.data = '2026-09-22'
              AND CURRENT_TIME >= L.oraInizio 
              AND CURRENT_TIME <= ADDTIME(L.oraInizio, SEC_TO_TIME(L.durata * 60))";
              $stmt = $this->db->prepare($query);
              $stmt->execute();
    }

    public function get_aula_cercata($search, $data) {
        $query = "
            SELECT numeroAula, nomeAttivita, oraInizio, oraFine
            FROM (
            SELECT L.numeroAula, I.nomeIns as nomeAttivita, L.data, L.oraInizio,
                TIME_FORMAT(ADDTIME(L.oraInizio, SEC_TO_TIME(L.durata * 60)), '%H:%i') AS oraFine
            FROM LEZIONE L
            JOIN INSEGNAMENTO I ON L.codiceInd = I.codiceIns

            UNION ALL

            SELECT E.numeroAula, CONCAT('ESAME: ', I.nomeIns) AS nomeAttivita, E.data, E.oraInizio,
                TIME_FORMAT(ADDTIME(E.oraInizio, SEC_TO_TIME(E.durata * 60)), '%H:%i') AS oraFine
            FROM ESAME E
            JOIN INSEGNAMENTO I ON E.codiceIns = I.codiceIns

            UNION ALL
            
            SELECT LA.numeroAula, CONCAT('LAUREE: ', LA.corso) AS nomeAttivita, LA.data, LA.oraInizio,
                TIME_FORMAT(ADDTIME(LA.oraInizio, SEC_TO_TIME(LA.durata * 60)), '%H:%i') AS oraFine
            FROM LAUREA LA

            UNION ALL

            SELECT EV.numeroAula, EV.titolo AS nomeAttivita, EV.data, EV.oraInizio,
                TIME_FORMAT(ADDTIME(EV.oraInizio, SEC_TO_TIME(EV.durata * 60)), '%H:%i') AS oraFine
            FROM EVENTO EV
            ) AS eventiAulaCercata
            WHERE data = ?
            AND numeroAula = ?
            ORDERED BY oraInizio ASC
            ";

            $stmt = $this->db->prepare($query);
            $searchTerm = '%' . $search . '%';
            $stmt->bind_param('sss', $data, $searchTerm, $searchTerm);
            $stmt->execute();
            $result = $stmt->get_result();

    return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function get_laboratorio_cercato() {

    }

    public function getRichiesteInCorso() {        
        $stmt = $this->db->prepare("SELECT codiceRichiesta, nominativo, data, oraInizio, durata, motivazione, numeroLab, numeroAula, descrizione 
                  FROM RICHIESTA_IN_CORSO 
                  ORDER BY data ASC, oraInizio ASC");
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function deleteRichiesta($cod){
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

        $eliminato = $this->deleteRichiesta($cod);

        if(!$eliminato){
            throw new Exception("Errore nell'eliminazione della richiesa");
        }

    }    
}

?>