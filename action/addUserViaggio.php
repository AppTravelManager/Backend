<?php

    include '../class/DB.php';
    include '../class/VIAGGIO.php';
    include '../class/RESPONSE.php';

    $classViaggio = new VIAGGIO(null, 'utenti_viaggi');
    $response = new RESPONSE(null);

    $user = $_POST['toAdd'];
    $viaggio = $_POST['viaggioId'];

    $dati = array('ksUtente' => $user, 'ksViaggio' => $viaggio, 'timeAdded' => strtotime('now'));

    $aggiungi = $classViaggio->addUserToViaggio($dati);

    if($aggiungi){
        $dati['message'] = "Viaggio aggiunto correttamente!";
        $dati['code'] = 200;
    }else{
        $dati = array();

        $dati['code'] = 404;
        $dati['message'] = "Errore generico. Riprovare!";
    }

    $response->setResponse($dati);

    echo $response->getJsonResponse();

?>