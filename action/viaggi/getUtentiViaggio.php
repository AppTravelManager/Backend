<?php

    include '../../class/DB.php';
    include '../../class/VIAGGIO.php';
    include '../../class/RESPONSE.php';

    $classViaggio = new viaggio(null, 'utenti_viaggi');
    $response = new RESPONSE(null);

    $idViaggio = $_POST['idViaggio'];

    $utenti = $classViaggio->getViaggioMembers($idViaggio);

    $response->setResponse($utenti);

    echo $response->getJsonResponse();

?>

