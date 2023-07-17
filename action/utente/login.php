<?php
    include '../../class/DB.php';
    include '../../class/USER.php';
    include '../../class/RESPONSE.php';

    $user = new USER(null, 'utenti');
    $response = new RESPONSE(null);

    $responseArray = array();

    $email = $_POST['email'];
    $pwd = md5($_POST['password']);

    //0 --> Login
    //1 --> Registrazione
    $routing = $_POST['routing'];

    //Login
    if(!$routing)
    {
        $uid = $user->login($email,$pwd);

        //Login eseguito con successo
        if($uid != 0){
            $user->setUid($uid);

            $userInfo = $user->getUserInfo();

            $responseArray['userInfo'] = $userInfo;
            $responseArray['loginTime'] = strtotime('now');
            $responseArray['code'] = 200;
            $responseArray['message'] = "Login eseguito con successo!";

        }else{

            $responseArray['code'] = 404;
            $responseArray['message'] = "Email/Password errati. Riprovare!";
        }
    }else{
        $uid = $user->registra($_POST);

        if($uid > 0){
            $user->setUid($uid);

            $userInfo = $user->getUserInfo();

            $responseArray['userInfo'] = $userInfo;
            $responseArray['loginTime'] = strtotime('now');
            $responseArray['code'] = 200;
            $responseArray['message'] = "Registrazione eseguita con successo!";

        }elseif($uid == -1){
            $responseArray['code'] = 404;
            $responseArray['message'] = "Email già esistente. Riprovare!";
        }else{
            $responseArray['code'] = 404;
            $responseArray['message'] = "Errore generico. Riprovare!";
        }
    }


    $response->setResponse($responseArray);

    echo $response->getJsonResponse();
?>