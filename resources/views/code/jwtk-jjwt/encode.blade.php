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
    if(key_exists($claim, $standardClaims)) {
        $builder .= ".$standardClaims[$claim](".$value.")\n";
    } else {
        $claims .= ".claim(\"$claim\", \"$value\")\n";
    }
}


$builder .= $claims . ".signWith(SignatureAlgorithm.HS512, ".$request['jwt']['key'].")\n.compact();\n";
?>


import io.jsonwebtoken.Jwts;
import io.jsonwebtoken.SignatureAlgorithm;
import io.jsonwebtoken.impl.crypto.MacProvider;
import java.security.Key;

// We need a signing key, so we'll create one just for this example. Usually
// the key would be read from your application configuration instead.
Key key = MacProvider.generateKey();

String s = {{ $builder }}
