<?php

    $example = str_replace("{","[", $request['jwt']['payload']);
    $example = str_replace("}","]", $example);
    $example = str_replace(":","=>", $example);

//    $example = var_export(json_decode($request['jwt']['payload'],true), true);
//    $example = htmlspecialchars_decode($example);

?>

use \Firebase\JWT\JWT;

$key = "example_key";
$token = {{ $example }};

$jwt = JWT::encode($token, "{{ $request['jwt']['key'] }}");