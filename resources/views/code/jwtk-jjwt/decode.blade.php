import io.jsonwebtoken.Jwts;
import io.jsonwebtoken.SignatureAlgorithm;
import io.jsonwebtoken.impl.crypto.MacProvider;
import java.security.Key;

try {

Jwts.parser()
.setSigningKey({{$request['jwt']['key']}})
.parseClaimsJws({{$request['jwt']['token']}});

//OK, we can trust this JWT

} catch (SignatureException e) {

//don't trust the JWT!
}