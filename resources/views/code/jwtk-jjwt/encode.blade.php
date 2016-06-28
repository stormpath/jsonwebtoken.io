<?php

$jwt = json_decode($request['jwt']['payload'], true);

$standardClaims = [
        'iss' => 'setIssuer',
        'sub' => 'setSubject',
        'aud' => 'setAudience',
        'exp' => 'setExpiration',
        'nbf' => 'setNotBefore',
        'iat' => 'issuedAt',
        'jti' => 'setId'
    ];

$builder = "Jwts.builder()\n";
$claims = '';

foreach($jwt as $claim => $value) {
    if(is_array($value)) {
        $claims .= "\t.claim(\"$claim\", {$claim}Map)\n";
        continue;
    }
    if(key_exists($claim, $standardClaims)) {
        if($claim == 'sub' || $claim == 'jti') {
            $builder .= "\t.$standardClaims[$claim](\"".$value."\")\n";
            continue;
        }
        $builder .= "\t.$standardClaims[$claim](".$value.")\n";
    } else {
        $claims .= "\t.claim(\"$claim\", \"$value\")\n";
    }
}


$builder .= $claims . "\t.signWith(SignatureAlgorithm.HS256, \"".$request['jwt']['key']."\".getBytes(\"UTF-8\"))\n\t.compact();\n";
?>


import io.jsonwebtoken.Jwts;
import io.jsonwebtoken.SignatureAlgorithm;
import io.jsonwebtoken.impl.crypto.MacProvider;

String s = {{ $builder }}
