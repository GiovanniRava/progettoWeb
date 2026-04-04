<?php
require_once("bootstrap.php");
$templateParams["nome"] = "header_pagine.php";  

$templateParams["voci_menu"] = [
    ["nome" => "AULE", "url" => "cercaAula_studente.php"],
    ["nome" => "LABORATORI", "url" => "cercaLab_studente.php"],
    ["nome" => "POLIVALENTE", "url" => "polivalente.php"],
    ["nome" => "EVENTI", "url" => "eventi_studente.php"]
];
require("template/menu_base.php");
?>