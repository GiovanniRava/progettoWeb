<?php
$templateParams["eventi"] = $dbh->get_eventi();

if (!empty($_POST['nome_da_eliminare'])) {
    $codice = $_POST['nome_da_eliminare'];
    $dbh->delete_evento($codice);
    header("Location: eventi_admin.php");
    exit();
}
?>
