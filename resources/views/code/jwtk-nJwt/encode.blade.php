var uuid = require('uuid');
var nJwt = require('njwt');

var claims = {{ $request['jwt']['payload'] }}

var jwt = nJwt.create(claims,"{{ $request['jwt']['key'] }}","HS256");
var token = jwt.compact();