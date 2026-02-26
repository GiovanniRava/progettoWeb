<?php
session_start();
define("UPLOAD_DIR", "./upload/");
require_once("db/database.php");
$dbh = new DatabaseHelper("127.0.0.1", "root", "", "aule_db", 3306);
?>