<?php
require 'mail/_mail.php';

header("Content-type: application/json; charset=utf-8");
respond('GET', '/theGetti/v1/[:endpoint]?/[:token]?', function ($request, $response) {
    global $daba;
    $res = array();
    $token = $request->token;
    $endpoint = $request->endpoint;
    $params = $request->params();
    if ($token != _AccToken)
        response_error(10501, "Geçersiz Access Token");

    switch ($endpoint) {
        case 'get_User':
            $req['token'] = isset($params['tok']) ? $params['tok'] : '';
            $req['mail'] = isset($params['mail']) ? $params['mail'] : '';
            $req['passw'] = isset($params['passw']) ? $params['passw'] : '';
            $req['position'] = isset($params['position']) ? $params['position'] : '';

            if ($req['token'] != _Tok)
                response_error(10503, "Zorunlu Token Eksik");
            if (empty($req['mail']) || empty($req['passw']))
                response_error(10504, "Zorunlu Parametreler Eksik");

            $res = response_list($daba->_User($req));

            if (empty($res) && (!empty($req['mail']) && !empty($req['passw'])))
                response_error(10506, "E-Mail Adresi veya Şifre Hatalı");

            $res = response_list($daba->_UpdateToken($res[0]['Id'], tokenCreate()));

            if ($res) $res = response_list($daba->_User($req));
            else response_error(10507, "Token Oluşturulurken Hata Oldu");

            response_success($res);
            break;
        case 'get_TokenCheck':
            $req['token'] = isset($params['tok']) ? $params['tok'] : '';
            $req['_token'] = isset($params['_token']) ? $params['_token'] : '';

            if ($req['token'] != _Tok)
                response_error(10503, "Zorunlu Token Eksik");
            if (empty($req['_token']))
                response_error(10504, "Zorunlu Parametreler Eksik");

            $res = response_list($daba->_User($req));

            if (empty($res))
                response_error(10506, "Token Uyuşmuyor");

            response_success($res);
            break;
        case 'userForgotPass':
            $req['token'] = isset($params['tok']) ? $params['tok'] : '';
            $req['mail'] = isset($params['mail']) ? $params['mail'] : '';

            $res = response_list($daba->_User($req));
            if (empty($res))
                response_error(10505, "E-Mail adresi ile ilgili kayıt bulunamamaktadır ");
            else sendMail($res[0], 'TheGettinOut', 'Giriş Şifreniz', 'passw');
            response_success(true);
            break;
        case 'userVerifiedCode':
            $req['token'] = isset($params['tok']) ? $params['tok'] : '';
            $req['mail'] = isset($params['mail']) ? $params['mail'] : '';

            $res = response_list($daba->_User($req));
            if (empty($res))
                response_error(10505, "E-Mail adresi ile ilgili kayıt bulunamamaktadır ");
            else sendMail($res[0], 'TheGettinOut', 'E-mail Onay Kodunuz', 'verifiedCode');

            response_success(true);
            break;
        case 'post_User':
            $req['token'] = isset($params['tok']) ? $params['tok'] : '';
            $req['namePost'] = isset($params['name']) ? $params['name'] : '';
            $req['mail'] = isset($params['mail']) ? $params['mail'] : '';
            $req['passwPost'] = isset($params['passw']) ? $params['passw'] : '';
            $req['notificationPost'] = isset($params['notification']) ? $params['notification'] : '';
            $req['positionPost'] = 'mobile';
            if ($req['token'] != _Tok)
                response_error(10503, "Zorunlu Token Eksik");
            if (empty($req['namePost']) || empty($req['mail']) || empty($req['passwPost']))
                response_error(10504, "Zorunlu Parametreler Eksik");

            $res = response_list($daba->_User($req));

            if (!empty($res))
                response_error(10505, "E-Mail adresi ile ilgili kayıt bulunmaktadır ");

            $res = response_list($daba->_AddUser($req));
            sendMail($res, 'TheGettinOut', 'E-mail Onay Kodunuz', 'verifiedCode');
            response_success($res);
            break;
        case 'post_UserVerified':
            $req['token'] = isset($params['tok']) ? $params['tok'] : '';
            $req['Id'] = isset($params['id']) ? $params['id'] : '';
            $req['verified'] = isset($params['verified']) ? $params['verified'] : '';

            $res = response_list($daba->_User($req));
            if (empty($res))
                response_error(10505, "E-Mail adresi ile ilgili kayıt bulunamamaktadır ");

            if ($res[0]['verifiedCode'] == $req['verified'])
                $res = response_list($daba->_UpdateUserVerified($req));
            else
                response_error(10506, "Onay Kodu Hatalı");

            response_success($res);
            break;
        case 'get_Survey':
            $req['Id'] = isset($params['Id']) ? $params['Id'] : '';
            $res = response_list($daba->_Survey($req));
            response_success($res);
            break;
        case 'get_Settings':
            $req['name'] = isset($params['name']) ? $params['name'] : '';
            $res = response_list($daba->_Settings($req));
            response_success($res);
            break;
        case 'get_Event':
            $req['token'] = isset($params['tok']) ? $params['tok'] : '';
            $req['Id'] = isset($params['Id']) ? $params['Id'] : '';
            $req['categoryId'] = isset($params['categoryId']) ? $params['categoryId'] : '';
            $req['name'] = isset($params['name']) ? $params['name'] : '';
            $req['searchEvent'] = isset($params['searchEvent']) ? $params['searchEvent'] : '';
            $req['page'] = isset($params['page']) ? $params['page'] : '';

            if ($req['token'] != _Tok)
                response_error(10503, "Zorunlu Token Eksik");
            if (empty($req['page']) && $req['page'] != 0)
                response_error(10504, "Zorunlu Parametreler Eksik");
            $res = response_list($daba->_Event($req), 'event');
            $newResponse = array();
            $ii = $req['page'] * 10;
            for ($i = $ii; $i < $ii + 10 && $i < count($res); $i++) {
                $newResponse[$i] = $res[$i];
            }
            response_success($newResponse);
            break;
        case 'get_Comment':
            $req['eventId'] = isset($params['eventId']) ? $params['eventId'] : '';
            $req['userId'] = isset($params['userId']) ? $params['userId'] : '';
            $res = response_list($daba->_Comment($req));
            response_success($res);
            break;
        case 'get_Category':
            $req['Id'] = isset($params['Id']) ? $params['Id'] : '';
            $req['name'] = isset($params['name']) ? $params['name'] : '';
            $res = response_list($daba->_Category($req));
            response_success($res);
            break;
        default:
            response_error(10502, "Geçersiz EndPoint.");
            break;
    }

    die();
});

respond('404', function ($request, $response) {
    response_error(10500, "Geçersiz URL");
});

?>