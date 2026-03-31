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
        $stmt = $this->db->prepare("SELECT codicePre, COALESCE(numeroLab, numeroAula) AS num, oraInizio, durata
        FROM prenotazione WHERE nominativo = ?");
        $stmt->bind_param("s", $nome);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function delete_prenotazione($cod){
        $stmt = $this->db->prepare("DELETE FROM prenotazione WHERE codicePre = ?");
        $stmt->bind_param('i', $cod);
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
        $stmt = $this->db->prepare("SELECT titolo, data, oraInizio, durata, numeroLab, numeroAula, locandina 
                  FROM EVENTO 
                  ORDER BY data ASC, oraInizio ASC");
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }
    
    public function insert_prenotazione($nominativo, $data, $oraInizio, $durata, $motivazione, $lab, $aula){
        $query = "INSERT INTO richiesta_in_corso (nominativo, data, oraInizio, durata, motivazione, numeroLab, numeroAula) 
                    VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('sssisss', $nominativo, $data, $oraInizio, $durata, $motivazione, $lab, $aula);
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
}

?>