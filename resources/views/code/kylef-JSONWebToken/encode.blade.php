<?php

$jwt = json_decode($request['jwt']['payload'], true);

$standardClaims = [
        'iss' => 'issuer',
        'aud' => 'audience',
        'exp' => 'expirationTime',
        'nbf' => 'notBefore',
        'iat' => 'issuedAt'
];

$builder = "Jwts.builder()\n";
$claims = '';

foreach($jwt as $claim => $value) {
    if(is_array($value)) {
        $claims .= "builder[\"$claim\"] = {$claim}Data)\n";
        continue;
    }
    if(key_exists($claim, $standardClaims)) {
        $builder .= ".$standardClaims[$claim](".$value.")\n";
    } else {
        $claims .= ".claim(\"$claim\", \"$value\")\n";
    }
}


$builder .= $claims . ".signWith(SignatureAlgorithm.HS512, ".$request['jwt']['key'].")\n.compact();\n";

?>

JWT.encode(.HS256("{{ $request['jwt']['key'] }}")) { builder in
builder.issuer = "fuller.li"
builder.issuedAt = NSDate()
builder["custom"] = "Hi"
}