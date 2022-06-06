<?php


function getAuthorizationCredentials($req) {
    $params = $req->getServerParams();
    $authorization = base64_decode(explode(" ",$params['HTTP_AUTHORIZATION'])[1]);
    return explode(":",$authorization)[0];
 }
