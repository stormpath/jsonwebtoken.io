use \Firebase\JWT\JWT;

$token = {{ var_export(json_decode($request['jwt']['payload'],true)) }};

$jwt = JWT::encode($token, "{{ $request['jwt']['key'] }}");