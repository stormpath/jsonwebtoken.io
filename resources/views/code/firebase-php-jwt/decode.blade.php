use \Firebase\JWT\JWT;

$decoded = JWT::decode("{{$request['jwt']['token']}}","{{$request['jwt']['key']}}", ['HS256']);