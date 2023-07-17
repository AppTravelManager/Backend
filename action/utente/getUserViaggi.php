<?php

    include '../../class/DB.php';
    include '../../class/VIAGGIO.php';
    include '../../class/RESPONSE.php';

    $classViaggio = new viaggio(null, 'viaggi');
    $response = new RESPONSE(null);

    $uid = 1;

    $viaggi = $classViaggio->getUserViaggi($uid);

    $response->setResponse($viaggi);

    echo $response->getJsonResponse();

?>

