<?php
    // Listar todos países
    $urlall = "https://restcountries.com/v3.1/all";
    $jsonall = json_decode(@file_get_contents($urlall));
    // Consulta
    if(isset ($_POST['pais'])){
    $pais = $_POST['pais'];
    $paisurl = str_replace(" ", "%20", $pais);
    $url = "https://restcountries.com/v3.1/name/{$paisurl}";
    $json = json_decode(@file_get_contents($url));
    }
?>