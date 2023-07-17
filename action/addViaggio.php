<?php

    include '../includes/dbConn.php';
    include '../class/DB.php';
    include '../class/VIAGGIO.php';
    include '../class/RESPONSE.php';

    $classViaggio = new viaggio(null, 'viaggi');
    $response = new RESPONSE(null);

    $dati = array('titolo' => 'Barcellona', "descrizione" => "pdsiviofvjidvfpijv", 'timecreated' => strtotime('now'), 'createdBy' => 1);

    $nuovoViaggio = $classViaggio->addViaggio($dati);

    if($nuovoViaggio){
        $dati['message'] = "Viaggio aggiunto correttamente!";
        $dati['code'] = 200;
    }
    else{
        $dati = array();

        $dati['code'] = 404;
        $dati['message'] = "Errore generico. Riprovare!";
    }

    $response->setResponse($dati);

    echo $response->getJsonResponse();
?>
