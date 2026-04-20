<?php
require_once("bootstrap.php");
$templateParams["header"] = "header_pagine.php";
$templateParams["richieste_in_corso"] = $dbh->getRichiesteInCorso();

if (isset($_POST['richiesta_da_eliminare'])) {
    $codiceRichiesta = $_POST['richiesta_da_eliminare'];
    $dbh->deleteRichiesta($codiceRichiesta);
    header("Location: richieste_admin.php");
    exit();
}

if (isset($_POST['richiesta_da_accettare'])) {
    $codiceRichiesta = $_POST['richiesta_da_accettare'];
    $dbh->accettaRichiesta($codiceRichiesta);
    header("Location: richieste_admin.php");
    exit();
}

require("template/richieste_admin_base.php");
?>