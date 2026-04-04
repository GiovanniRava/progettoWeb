<?php
require_once("bootstrap.php");
$templateParams["nome"] = "header_pagine.php";  

$templateParams["voci_menu"] = [
    ["nome" => "PRENOTAZIONI", "url" => "listaPrenotazioni_admin.php"],
    ["nome" => "RICHIESTE IN CORSO", "url" => "richieste_admin.php"],
    ["nome" => "EVENTI", "url" => "eventi_admin.php"]
];
require("template/menu_base.php");
?>