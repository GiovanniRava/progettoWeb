<?php
session_start();
define("UPLOAD_DIR", "./upload/");
require_once("db/database.php");
$dbh = new DatabaseHelper("127.0.0.1", "root", "", "Alma_aule_DB", 3306);
?>