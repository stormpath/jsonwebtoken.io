<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>JSON WEB TOKEN DEBUGGER</title>

    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
</head>
<body>

    <div id="app">
        <div class="col-sm-6">  
            <div class="row">
                <div class="col-sm-12">
                    <textarea name="jwt" rows="6" v-model="jwt.token" style="width:100%; font-size: 30px" v-on:keyup="decode" v-on:change="decode"></textarea>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-4">
                    <h3>Header</h3>
                    <textarea id="jwtHeader" rows="10" v-model="jwt.header" style="width:100%; font-size: 30px" disabled></textarea>
                </div>
                <div class="col-sm-4">
                    <h3>Payload</h3>
                    <textarea id="jwtPayload" rows="10" v-model="jwt.payload" style="width:100%; font-size: 30px" v-on:keyup="encode"></textarea>
                </div>
                <div class="col-sm-4">
                    <h3>Signature (signing key)</h3>
                    <input name="jwtKey" v-model="jwt.key" v-on:keyup="verifyKey" style="width:100%; font-size: 30px"/>
                    <span> @{{ jwt.signature }}</span>
                </div>
            </div>
        </div>

        <div class="col-sm-6">
            <h1> Code for @{{ jwtLibrary }} </h1>
            <span class="btn btn-sm btn-default" v-on:click="generateCode('jwtk/nJwt')">jwtk/nJwt</span>
            <span class="btn btn-sm btn-default" v-on:click="generateCode('firebase/php-jwt')">firebase/php-jwt</span>
            <p>
                <textarea id="jwtCodeEncode" rows="20" cols="100">@{{ jwt.codeEncode }}</textarea>
                <textarea id="jwtCodeDecode" rows="20" cols="100">@{{ jwt.codeDecode }}</textarea>
            </p>
        </div>
    </div>

    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/vue/1.0.24/vue.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/vue-resource/0.8.0/vue-resource.js"></script>
    <script type="text/javascript" src="/js/home.js"></script>
</body>
</html>