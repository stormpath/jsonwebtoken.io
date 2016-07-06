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
    <meta property="og:image" content="https://www.jsonwebtoken.io/img/screenshots/promo-large.png">
    <meta property="og:image:secure_url" content="https://www.jsonwebtoken.io/img/screenshots/promo-large.png">

    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    <link rel="shortcut icon" type="image/png" href="img/icons/icon-32.png">

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:400,100,300,500">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato:400,100,300,700">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Code+Pro:300,400,500">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Francois+One">

    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="stylesheet" href="css/codemirror.css">
    <link rel="stylesheet" href="css/markdown.css">
    <link rel="stylesheet" href="css/styles.css">


</head>
<body>
<div class="headerColor"></div>

<div id="app" >
    <div class="json-@{{ signupFields.statusType }}" v-if="signupFields.status">
        @{{ signupFields.successMessage }}
    </div>
    <header>

        @include('_partials/nav')

        <div class="container  well well-lg">

            <div class="row">

                <div class="col-sm-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title">JWT String  <span class="label label-danger" v-show="jsonErrorMessage">@{{ jsonErrorMessage }}</span></h3>
                        </div>
                        <div class="panel-body">
                            <textarea id="jwtInput" class="form-control" v-bind:class="{ 'json-error-textarea': jsonError }" style="width:100%;height:150px;" placeholder="Paste JWT here" v-model="jwt.token" v-on:change="decode"></textarea>
                        </div>
                    </div>
                </div>

            </div>

            <div class="row">

                <div class="col-sm-4">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title pull-left">Header</h3>
                            <div class="pull-right">

                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="panel-body">
                            <textarea id="jwtHeader" rows="5" v-model="jwt.header" style="width:100%; font-size: 30px"></textarea>
                        </div>
                    </div>
                </div>

                <div class="col-sm-8">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title">Payload</h3>
                        </div>
                        <div class="panel-body">
                            <textarea id="jwtPayload" rows="5" v-model="jwt.payload" style="width:100%; font-size: 30px" v-on:keyup="encode"></textarea>
                        </div>
                    </div>
                </div>

            </div>

            <div class="row text-center">

                <div class="col-sm-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title">Signing Key &nbsp;&nbsp;
                                @{{{ verified }}}
                            </h3>
                        </div>
                        <div class="panel-body">
                            <input name="jwtKey" class="form-control" v-model="jwt.key" v-on:keyup="verifyKey"/>
                        </div>
                    </div>
                </div>

            </div>
        </div>

    </header>




<section id="section-1">
    <div class="container feature">
        <h2> Code for @{{ jwtLibrary }} </h2>
        <p class="description">
            We have generated code samples based on the input above for different languages.  <br/>
            Select the library you use to switch the generated code samples, copy and paste, and that is all.
            <div class="row libraryButtons">
                <span class="btn btn-sm btn-default" v-bind:class="{ 'active': jwtLibrary=='jwtk/nJwt'}" v-on:click="generateCode('jwtk/nJwt')">jwtk/nJwt</span>
                <span class="btn btn-sm btn-default" v-bind:class="{ 'active': jwtLibrary=='firebase/php-jwt'}" v-on:click="generateCode('firebase/php-jwt')">firebase/php-jwt</span>
                <span class="btn btn-sm btn-default" v-bind:class="{ 'active': jwtLibrary=='jwtk/jjwt'}" v-on:click="generateCode('jwtk/jjwt')">jwtk/jjwt</span>
                <span class="btn btn-sm btn-default" v-bind:class="{ 'active': jwtLibrary=='jwt-dotnet/jwt'}" v-on:click="generateCode('jwt-dotnet/jwt')">jwt-dotnet/jwt</span>
            </div>
            <div class="row code-block">
                <div class="col-sm-6">
                    <h3>Encode</h3>
                    <textarea  style="width:100%; font-size: 30px" rows="10" id="jwtCodeEncode" >@{{ jwt.codeEncode }}</textarea>
                </div>
                <div class="col-sm-6">
                    <h3>Decode</h3>
                    <textarea style="width:100%; font-size: 30px" rows="10" id="jwtCodeDecode" >@{{ jwt.codeDecode }}</textarea>
                </div>
            </div>


        </p>
    </div>
</section>
    <section class="signup-bar">
        <div class="container">
            <div class="row"><h2>Sign Up for Stormpath</h2></div>
            <div class="row">

                <div class="col-sm-2">
                    <div class="form-group">
                        <label class="sr-only">First Name</label>
                        <input type="text" class="form-control" placeholder="First Name" v-model="signupFields.fname">
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="form-group">
                        <label class="sr-only">Last Name</label>
                        <input type="text" class="form-control" placeholder="Last Name" v-model="signupFields.lname">
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <label class="sr-only">Email address</label>
                        <input type="email" class="form-control" placeholder="Email" v-model="signupFields.email">
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="form-group">
                        <label class="sr-only">Password</label>
                        <input type="password" class="form-control" placeholder="password" v-model="signupFields.password">
                    </div>
                </div>

                <div class="col-xs-1">
                    <div v-on:click="signup" class="btn btn-default btn-lg">Sign Up For Free</div>
                </div>
            </div>

        </div>

    </section>
<section id="section-2" class="section-bg">
    <div class="container feature markdown-body">
        <h2>Readme</h2>
        <p class="description">
            <a href="@{{ codeLibrary.href }}" target="_blank"><i class="fa-github fa"></i> View Library On Github</a>

            <div class="readme">@{{{ codeLibrary.readme }}}</div>
        </p>
    </div>
</section>


@include('_partials/footer')

<script>
    function animateSection(nr) {
        var sectionId = 'section-' + nr;
        var animation = nr % 2 ? 'slideInLeft' : 'slideInRight';

        var h2 = document.querySelector('#' + sectionId + ' > .feature > h2');
        var p = document.querySelector('#' + sectionId + ' > .feature > p');
//        var devtools = document.querySelector('#' + sectionId + ' > .feature > p > div');

        if (h2.className.indexOf('animated') === -1) {
            h2.className = h2.className + ' animated delay-200 ' + animation;
            p.className = p.className + ' animated delay-100 ' + animation;
//            devtools.className = devtools.className + ' animated ' + animation;
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

        if (document.body.scrollTop + window.innerHeight > 1000 || document.documentElement.scrollTop + window.innerHeight > 1000) {
            setTimeout(animateSection.bind(null, 1), 100);
        }

        if (document.body.scrollTop + window.innerHeight > 1500 || document.documentElement.scrollTop + window.innerHeight > 1500) {
            setTimeout(animateSection.bind(null, 2), 100);
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
