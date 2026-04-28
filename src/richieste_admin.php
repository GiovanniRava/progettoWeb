<?php
require_once("bootstrap.php");
$templateParams["header"] = "header_pagine.php";
$templateParams["richieste_in_corso"] = $dbh->getRichiesteInCorso();

$redirect_url = isset($_POST['return_url']) ? $_POST['return_url'] : "richieste_admin.php";

if (isset($_POST['richiesta_da_eliminare'])) {
    $codiceRichiesta = $_POST['richiesta_da_eliminare'];
    $dbh->delete_richiesta($codiceRichiesta);
    header("Location: " . $redirect_url);
    exit();
}

if (isset($_POST['richiesta_da_accettare'])) {
    $codiceRichiesta = $_POST['richiesta_da_accettare'];
    $dbh->accettaRichiesta($codiceRichiesta);
    header("Location: " . $redirect_url);
    exit();
}

require("template/richieste_admin_base.php");
?>