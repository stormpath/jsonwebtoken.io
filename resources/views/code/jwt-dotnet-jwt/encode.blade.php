<?php

    $parts = json_decode($request['jwt']['payload'],true);

    $claims = buildClaims($parts);


    function buildClaims($parts, $claims = '') {
        foreach($parts as $claim => $value) {
            if(is_array($value)) {
                $moreClaims = buildClaims($value);
                $claims .= "\t{ \"$claim\", \n\t$moreClaims \t}\n";
                return $claims;
            }

            $claims .= "\t{ \"$claim\", $value }\n";

        }

        return $claims;
    }

?>
var payload = new Dictionary<string, object>()
{
  {{ $claims }}
};
var secretKey = "{{ $request['jwt']['key'] }}";
string token = JWT.JsonWebToken.Encode(payload, secretKey, JWT.JwtHashAlgorithm.HS256);

