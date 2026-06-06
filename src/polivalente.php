<?php
require_once("bootstrap.php");
$templateParams["header"] = "header_pagine.php";
$stat = $dbh->get_statistiche_polivalente();
$templateParams["statistiche"] = $stat;

$templateParams["chiusura"] = ["attiva" => false];
if (!empty($stat["dataInizioChiusura"]) && !empty($stat["dataFineChiusura"])) {
    $oggi = date("Y-m-d");
    if ($oggi <= $stat["dataFineChiusura"]) {
        $templateParams["chiusura"] = [
            "attiva" => true,
            "inizio" => date("j/m", strtotime($stat["dataInizioChiusura"])),
            "fine" => date("j/m", strtotime($stat["dataFineChiusura"])),
            "motivo" => $stat["motivoChiusura"]
        ];
    }
}

require("template/polivalente_base.php");
?>