<!DOCTYPE html>
<html lang="en">
<head>
    <title>JJWT - JSON Web Token for Java and Android</title>
    <meta charset="utf-8"/>
    <meta name="description"
          content="JJWT is an open source json web token library that enables any java application to create and verify access and refresh tokens. Learn more and see it in action here."/>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no, maximum-scale=1, width=device-width"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>

    <meta property="og:title" content="JJWT - JSON Web Token for Java and Android"/>
    <meta property="og:description"
          content="JJWT is an open source json web token library that enables any java application to create and verify access and refresh tokens. Learn more and see it in action here."/>
    <meta property="og:image" content=""/>
    <meta property="og:image:secure_url"
          content=""/>

    <link rel="shortcut icon" type="image/png" href="img/icons/icon-32.png"/>

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:400,100,300,500"/>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato:400,100,300,700"/>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Code+Pro:300,400,500"/>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Francois+One"/>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous"/>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous"/>

    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="stylesheet" href="css/codemirror.css">
    <link rel="stylesheet" href="css/styles.css">

</head>
<body>
<div class="headerColor"></div>
<header>
    @include('_partials/nav')

    <div class="container  well well-lg">
        <h2>Why Are JWTs Important?</h2>
        <p>They handle some of the problems with information passed from a client to a server. JWT allows the server to
            verify the information contained in the JWT without necessarily storing state on the server. As a trend, we
            are seeing more and more SaaS products include JWT integrations as a feature or using JWT in their product directly.
            Stormpath has always followed secure best practices for JWTs, in several parts of our stack, so we want to share some
            best practices for using JWT the right way.</p>
        <p><span id="more-2505"></span></p>
        <h2>What Is A JWT?</h2>
        <p>Before we get started, let’s quickly look at what a JWT contains so we can clearly understand why these best practices
            are important. In its most simple form, JWT has three distinct parts that are URL encoded for transport:</p>
        <ul>
            <li><strong>Header:</strong> The header contains the metadata for the token and at a minimal contains the type of the signature and/or encryption algorithm</li>
            <li><strong>Claims:</strong> The claims contains any information that you want signed</li>
            <li><strong>JSON Web Signature (JWS):</strong> The headers and claims digitally signed using the algorithm in the specified in the header</li>
        </ul>
        <p>The header and claims are JSON that are base64 encoded for transport. The header, claims, and signature are appended together with a period character <code>.</code><br />
            For example, if the header and claims are:</p>
    </div>
</header>

@include('_partials/footer')
</body>
</html>