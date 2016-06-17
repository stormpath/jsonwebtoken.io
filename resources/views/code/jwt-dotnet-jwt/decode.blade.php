var token = "{{$request['jwt']['token']}}";
var secretKey = "{{$request['jwt']['key']}}";

try {
  string jsonPayload = JWT.JsonWebToken.Decode(token, secretKey);
  Console.WriteLine(jsonPayload);
} catch (JWT.SignatureVerificationException) {
  Console.WriteLine("Invalid token!");
}