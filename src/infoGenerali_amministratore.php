<?php 
require_once("bootstrap.php");

$templateParams["auleOccupate"] = $dbh->getNumeroAuleOccupate();
$templateParams["labOccupati"] = $dbh->getNumeroLabOccupati();
$templateParams["eventiInCorso"] = $dbh->getEventiInProgramma();

$templateParams["totaleAule"] = $dbh->getTotaleAule();
$templateParams["totaleLab"] = $dbh->getTotaleLab();

require("template/infoGenerali_amministratore_base.php");

?>