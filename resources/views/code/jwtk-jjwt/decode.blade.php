<?php
$builder = "Jwts.parser()\n";
$builder .= "\t.setSigningKey(\"".$request['jwt']['key']."\".getBytes(\"UTF-8\"))\n";
$builder .= "\t.parseClaimsJws(\"\n".$request['jwt']['token']."\n\t\");\n";
?>

import io.jsonwebtoken.Jwts;
import io.jsonwebtoken.SignatureAlgorithm;
import io.jsonwebtoken.impl.crypto.MacProvider;
import java.security.Key;

try {

    {{ $builder }}

    //OK, we can trust this JWT

} catch (SignatureException e) {

    //don't trust the JWT!
}