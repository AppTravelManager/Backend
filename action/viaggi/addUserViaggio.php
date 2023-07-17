<?php

    include '../../class/DB.php';
    include '../../class/VIAGGIO.php';
    include '../../class/RESPONSE.php';

    $classViaggio = new VIAGGIO(null, 'utenti_viaggi');
    $response = new RESPONSE(null);

    $user = $_POST['toAdd'];
    $viaggio = $_POST['viaggioId'];

    $aggiungi = $classViaggio->addUserToViaggio($_POST);

    if($aggiungi){
        $_POST['message'] = "Viaggio aggiunto correttamente!";
        $_POST['code'] = 200;
    }else{
        $_POST = array();

        $_POST['code'] = 404;
        $_POST['message'] = "Errore generico. Riprovare!";
    }

    $response->setResponse($_POST);

    echo $response->getJsonResponse();

?>