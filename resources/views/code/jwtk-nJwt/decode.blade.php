var nJwt = require('njwt');

nJwt.verify("{{$request['jwt']['token']}}","{{$request['jwt']['key']}}", 'HS512');