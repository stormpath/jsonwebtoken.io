<!DOCTYPE html>
<html lang="en">
<head>
    <title>JSON Web Token (JWT)</title>
    <meta charset="utf-8">
    <meta name="description" content="With JSONwebtoken.io, you can easily encode, decode, and validate JWTs.">
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no, maximum-scale=1, width=device-width">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta property="og:title" content="Gain control over your JWTs">
    <meta property="og:description" content="With JSONwebtoken.io, you can easily encode, decode, and validate JWTs.">
    <meta property="og:image" content="http://www.jwtinspector.io/img/screenshots/jwt-inspector-promo-large.png">
    <meta property="og:image:secure_url" content="https://www.jwtinspector.io/img/screenshots/jwt-inspector-promo-large.png">

    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    <link rel="shortcut icon" type="image/png" href="img/icons/icon-32.png">

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:400,100,300,500">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato:400,100,300,700">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Code+Pro:300,400,500">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Francois+One">

    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
<div id="app">

    <header>
        <div class="container">
            <div class="logo">
                <div class="icon">
                    <a href="/" class="text">JSON Web Token</a>
                </div>
                <div class="credits">
                    by
                    <a href="https://stormpath.com/" target="_blank">
                        <img src="img/stormpath-logo-white.png">
                    </a>
                </div>
            </div>

            <div class="share">
                <a href="https://twitter.com/intent/tweet?text=Easily%20decode,%20encode,%20and%20validate%20your%20JWTs%20https%3A%2F%2Fjsonwebtoken.io%20%23jwt" target="_blank" rel="nofollow" class="btn btn-share">
                    <i class="fa fa-twitter" aria-hidden="true"></i>
                    Share on Twitter
                </a>
            </div>

            <h1>Decode or Encode JWTs</h1>

            <p class="description">
                Paste a JWT and decode its header, payload, and signature,
                <br/>
                or provide header, payload, and signature information to generate a JWT.
            </p>
        </div>

            <div class="row text-center">
                <div class="col-sm-8 col-sm-offset-2">
                    <textarea name="jwt" rows="6" v-model="jwt.token" style="width:100%; font-size: 30px" v-on:keyup="decode" v-on:change="decode"></textarea>
                </div>
            </div>
            <div class="row text-center">
                <div class="col-sm-4 col-sm-offset-2">
                    <h3>Header</h3>
                    <textarea id="jwtHeader" rows="10" v-model="jwt.header" style="width:100%; font-size: 30px" disabled></textarea>
                </div>
                <div class="col-sm-4">
                    <h3>Payload</h3>
                    <textarea id="jwtPayload" rows="10" v-model="jwt.payload" style="width:100%; font-size: 30px" v-on:keyup="encode"></textarea>
                </div>
            </div>
        <div class="row text-center">
            <div class="col-sm-8 col-sm-offset-2">
                <h3>Signature (signing key)</h3>
                <div class="form-group">
                    <input name="jwtKey" class="form-control" v-model="jwt.key" v-on:keyup="verifyKey" style="width:100%; font-size: 30px"/>
                </div>
                <span> @{{ jwt.signature }}</span>
            </div>
        </div>
    </header>




<section id="section-1" class="container">
        <h2> Code for @{{ jwtLibrary }} </h2>
        <span class="btn btn-sm btn-default" v-on:click="generateCode('jwtk/nJwt')">jwtk/nJwt</span>
        <span class="btn btn-sm btn-default" v-on:click="generateCode('firebase/php-jwt')">firebase/php-jwt</span>
        <div class="row">
            <div class="col-sm-6">
                <textarea  style="width:100%; font-size: 30px" rows="10" id="jwtCodeEncode" >@{{ jwt.codeEncode }}</textarea>
            </div>
            <div class="col-sm-6">
                <textarea style="width:100%; font-size: 30px" rows="10" id="jwtCodeDecode" >@{{ jwt.codeDecode }}</textarea>
            </div>
        </div>


        </p>
</section>
<section id="section-2" class="section-bg">
    <div class="container feature">
        <h2>What is a JWT?</h2>
        <p class="text-center">
            In its simplest form, a JWT has 3 distinct components which are base64 encoded for transport:
        <div class="kelsey-special">
            1. Header: contains the token metadata and the type of hashing algorithm used
            <br/>
            2. Payload: contains any information (claims) that you want signed
            <br/>
            3. Signature: headers and claims digitally signed using the algorithm specified in the header
        </div>
        </p>
    </div>
</section>
<section id="section-3">

</section>
<footer>
    <div class="container">
        <div class="copyright">
            &copy; 2016 Stormpath
        </div>
        <div class="social">
            <a href="https://github.com/kelseychayes/jsonwebtoken" target="_blank" rel="nofollow" class="btn btn-alt">
                <i class="fa fa-github" aria-hidden="true"></i>
                Have a Suggestion?
            </a>
        </div>
        <div class="love">
            <a href="https://stormpath.com" target="_blank">
                <span>Made with</span><i class="fa fa-heart heart" aria-hidden="true"></i><span>by Stormpath</span>
            </a>
        </div>
    </div>
</footer>
</div>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/vue/1.0.24/vue.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/vue-resource/0.8.0/vue-resource.js"></script>
<script type="text/javascript" src="/js/home.js"></script>

<script>
    function animateSection(nr) {
        var sectionId = 'section-' + nr;
        var animation = nr % 2 ? 'slideInLeft' : 'slideInRight';

        var h2 = document.querySelector('#' + sectionId + ' > .feature > h2');
        var p = document.querySelector('#' + sectionId + ' > .feature > p');
        var devtools = document.querySelector('#' + sectionId + ' > .feature > .devtools');

        if (h2.className.indexOf('animated') === -1) {
            h2.className = h2.className + ' animated delay-200 ' + animation;
            p.className = p.className + ' animated delay-100 ' + animation;
            devtools.className = devtools.className + ' animated ' + animation;
        }
    }

    function scrollHandler() {
        var buttons = document.querySelectorAll('.btn-install');

        if (document.body.scrollTop > 630 || document.documentElement.scrollTop > 630) {
            for (var i = 0; i < buttons.length; ++i) {
                buttons[i].classList.remove('hidden');
                buttons[i].classList.add('visible');
            }
        } else {
            for (var i = 0; i < buttons.length; ++i) {
                buttons[i].classList.remove('visible');
                buttons[i].classList.add('hidden');
            }
        }

        if (document.body.scrollTop + window.innerHeight > 1070 || document.documentElement.scrollTop + window.innerHeight > 1070) {
            setTimeout(animateSection.bind(null, 1), 100);
        }

        if (document.body.scrollTop + window.innerHeight > 1500 || document.documentElement.scrollTop + window.innerHeight > 1500) {
            setTimeout(animateSection.bind(null, 2), 100);
        }

        if (document.body.scrollTop + window.innerHeight > 2110 || document.documentElement.scrollTop + window.innerHeight > 2110) {
            setTimeout(animateSection.bind(null, 3), 100);
        }
    }

    window.onscroll = scrollHandler;
    window.onresize = scrollHandler;

    window.onload = function () {
        setTimeout(scrollHandler, 100);
    };
</script>

</body>
</html>
