<?php
require_once("bootstrap.php");
$templateParams["footer"] = "footer.php";

//Lato client
//AJAX-PHP: Nel lab ha fatto un'esercitazione in cui: si parte dai file php come questo e fa $templateParams["js"] = array("script/index.js").
//nel template in fondo chiama un foreach su $templateParams["js"] as $script, poi echo $script, tutto dentro i tag <script>, quindi come
//se si dovesse includere un file js. Dentro index.js crea una funzione per recuperare una parte del sito (articoli), questa funzione
//richiama un altro file, facendo fetch dell'url api-articoli.php, che crea la variabile $articoli usando la funzione di database.php, poi fa
//echo json_encode($articoli) come se dovesse passare la variabile una volta che viene chiamato. Infine index.js richiama a fine file
//la funzione che ha chiamato api-articoli.php.
require("template/index_base.php")
?>