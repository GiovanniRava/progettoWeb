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
        $stmt = $this->db->prepare("SELECT COALESCE(numeroLab, numeroAula) AS num, oraInizio, durata
        FROM prenotazione WHERE nominativo = ?");
        $stmt->bind_param("s", $nome);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
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
    
}

?>