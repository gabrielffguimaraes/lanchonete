<?php
$enviroments =  [
    "url" => "http://localhost/lanchonete/",
    "baseUrl" => "/lanchonete/",
    "baseHttp" => "http://localhost/lanchonete/api/",
    "authorization" => Auth::credentials(),
    "name" => $_SESSION["name"] ?? ""
];

$base64Variables = base64_encode(json_encode($enviroments));

$enviroments =  array_merge([
    "envoriments" => $base64Variables,
],$enviroments,[
    "userLogged" =>Auth::loggedUser()
]);

return $enviroments;
