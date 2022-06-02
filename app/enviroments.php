<?php
$enviroments =  [
    "baseUrl" => "/lanchonete/public/",
    "baseHttp" => "http://localhost/lanchonete/api/",
    "authorization" => Auth::credentials()
];

$base64Variables = base64_encode(json_encode($enviroments));

$enviroments =  array_merge([
    "envoriments" => $base64Variables
],$enviroments);

return $enviroments;
