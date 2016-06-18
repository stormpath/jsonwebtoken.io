<?php

namespace JWT\Jwt\PHP;

class FirebasePhpJwtEncode
{
    private $token;
    private $secret;

    public function __construct($token, $secret)
    {

        $this->token = $token;
        $this->secret = $secret;
    }

    public function handle()
    {

    }

    protected function setIssuer($issuer)
    {
        return $this->standardClaim('iss', $issuer);
    }

    protected function standardClaim($claim, $value)
    {
        if(is_int($value) == 'integer') {
            $claimValue = $value;
        }
        $claimValue = "'{$claim}'";

        return "'{$claim}' => {$claimValue}\n";
    }
}