<?php

    include '../../class/DB.php';
    include '../../class/VIAGGIO.php';
    include '../../class/RESPONSE.php';

    $classViaggio = new viaggio(null, 'viaggi');
    $response = new RESPONSE(null);

    //Uso direttamente $_POST che va strutturato
    // $_POST['titolo'] = 'Barcellona'...
    //$dati = array('titolo' => 'Barcellona', "descrizione" => "pdsiviofvjidvfpijv", 'timecreated' => strtotime('now'), 'createdBy' => 1);
    $idViaggio = $_POST['idViaggio'];

    $modifica = $classViaggio->modificaViaggio($_POST, $idViaggio);

    if ($modifica) {
        $_POST['message'] = "Viaggio modificato correttamente!";
        $_POST['code'] = 200;
    } else {
        $_POST = array();

        $_POST['code'] = 404;
        $_POST['message'] = "Errore generico. Riprovare!";
    }

    $response->setResponse($_POST);

    echo $response->getJsonResponse();

?>