<?php

    include '../../class/DB.php';
    include '../../class/VIAGGIO.php';
    include '../../class/RESPONSE.php';

    $classViaggio = new viaggio(null, 'viaggi');
    $response = new RESPONSE(null);

    $nuovoViaggio = $classViaggio->addViaggio($_POST);

    if($nuovoViaggio){
        $_POST['message'] = "Viaggio aggiunto correttamente!";
        $_POST['code'] = 200;
    }
    else{
        $_POST = array();

        $_POST['code'] = 404;
        $_POST['message'] = "Errore generico. Riprovare!";
    }

    $response->setResponse($_POST);

    echo $response->getJsonResponse();
?>
