<?php
require_once("bootstrap.php");
//$templateParams["nome"] = "header_pagine.php";  

$templateParams["voci_menu"] = [
    ["nome" => "AULE", "url" => "cercaAula_studente.php"],
    ["nome" => "LABORATORI", "url" => "cercaLaboratorio_studente.php"],
    ["nome" => "POLIVALENTE", "url" => "polivalente.php"],
    ["nome" => "EVENTI", "url" => "eventi_studente.php"],
    ["nome" => "PRENOTAZIONI", "url" => "prenotazioni_studente.php"]
];
require("template/menu_base.php");
?>