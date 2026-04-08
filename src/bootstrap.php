<?php
require("db/database.php");
session_start();
$dbh = new DatabaseHelper("127.0.0.1", "root", "", "Alma_aule_DB", 3306);
define("UPLOAD_DIR", "./upload/");
?>