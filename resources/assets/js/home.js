var uuid = require('uuid');
var nJwt = require('njwt');
var marked = require('marked');

var CodeMirror = require('codemirror');

require('codemirror/mode/javascript/javascript.js');
require('codemirror/mode/xml/xml.js');
require('codemirror/mode/markdown/markdown.js');

var libs = {
    'jwtk-nJwt': {
        'readme': 'https://raw.githubusercontent.com/jwtk/njwt/master/README.md',
        'repo': 'https://github.com/jwtk/njwt'
    },
    'firebase-php-jwt': {
        'readme': 'https://raw.githubusercontent.com/firebase/php-jwt/master/README.md',
        'repo': 'https://github.com/firebase/php-jwt'
    },
    'jwtk-jjwt': {
        'readme': 'https://raw.githubusercontent.com/jwtk/jjwt/master/README.md',
        'repo': 'https://github.com/jwtk/jjwt'
    },
    'jwt-dotnet-jwt': {
        'readme': 'https://raw.githubusercontent.com/jwt-dotnet/jwt/master/README.md',
        'repo': 'https://github.com/jwt-dotnet/jwt'
    }

}

var codeMirrorOptions = {
    readOnly: true,
    lineNumbers: true,
    theme: 'yeti'
};

marked.setOptions({
    renderer: new marked.Renderer(),
    gfm: true,
    tables: true,
    breaks: false,
    pedantic: false,
    sanitize: true,
    smartLists: true,
    smartypants: false,
    highlight: function (code) {
        return require('highlight.js').highlightAuto(code).value;
    }
});

new Vue({
    el: '#app',

    data: {
        jwt: {
            token: "",
            header: "",
            payload: "",
            signature: "",
            key: "secret",
            codeEncode: "",
            codeDecode: ""
        },
        codeLibrary: {
            readme: "",
            href: ""
        },
        signupFields: {
            fname: "",
            lname: "",
            email: "",
            password: "",
            status: false,
            statusType: "",
            successMessage: ""
        },
        changedFromEncode: false,
        jwtLibrary: "jwtk/nJwt",
        signature: "invalid",
        headerTextArea: "",
        payloadTextArea: "",
        decodeTextArea: "",
        encodeTextArea: "",
        jsonError: false,
        jsonErrorMessage: ""

    },

    computed: {
        verified: function() {
            switch(this.signature) {
                case 'unverified':
                    return '<span id="signatureUnverified" class="label label-warning">Unverified</span>';
                case 'verified':
                    return '<span id="signatureVerified" class="label label-success">Verified</span>';
                case 'invalid':
                    return '<span id="signatureInvalid" class="label label-danger">Invalid - Token Signature has failed</span>';
            }
        }
    },

    watch: {
        "jwt.token": function(token) {
            if(this.changedFromEncode) {
                this.changedFromEncode = false;
                return;
            }
            this.decode();
        }
    },

    ready() {
        var vm = this;
        this.headerTextArea = CodeMirror.fromTextArea(document.getElementById('jwtHeader'), {
            readOnly: true,
            lineNumbers: false,
            lineWrapping: true,
            mode: {
                name: 'javascript', json: true
            },
            setSize: {
                height: "50px"
            },
            theme: 'neo'
        });
        this.payloadTextArea = CodeMirror.fromTextArea(document.getElementById('jwtPayload'), {
            readOnly: false,
            lineNumbers: false,
            lineWrapping: true,
            mode: {
                name: 'javascript', json: true
            },
            theme: 'neo'
        });

        this.encodeTextArea = CodeMirror.fromTextArea(document.getElementById('jwtCodeEncode'), {
            readOnly: true,
            lineNumbers: true,
            lineWrapping: true,
            mode: {
                name: 'javascript', json: true
            },
            theme: 'mdn-like'
        });

        this.decodeTextArea = CodeMirror.fromTextArea(document.getElementById('jwtCodeDecode'), {
            readOnly: true,
            lineNumbers: true,
            lineWrapping: true,
            mode: {
                name: 'javascript', json: true
            },
            theme: 'mdn-like'
        });

        this.payloadTextArea.on("change", function(instance, obj) {
           vm.jwt.payload = instance.getValue();
            vm.encode();
        });

        this.generateJwt();
    },


    methods: {
        decode: function() {
            try {
                var result = nJwt.verify(this.jwt.token, this.jwt.key);
                this.jwt.header = JSON.stringify(result.header, null, ' ');
                this.headerTextArea.setValue(this.jwt.header);
                this.jwt.payload = JSON.stringify(result.body, null, ' ');
                this.payloadTextArea.setValue(this.jwt.payload);
                this.jwt.signature = 'VERIFIED!';
                this.signature = 'verified';
                this.generateCode();
                this.verifyKey();

            } catch(err) {
                this.jwt.header = JSON.stringify(err.parsedHeader, null, ' ');
                this.headerTextArea.setValue(this.jwt.header);
                this.jwt.payload = JSON.stringify(err.parsedBody, null, ' ');
                this.payloadTextArea.setValue(this.jwt.payload);
                this.signature = 'invalid';
            }
        },

        encode: function() {
            this.changedFromEncode = true;
            try {
                var token = nJwt.create(JSON.parse(this.jwt.payload),this.jwt.key);
                this.jwt.token = token.compact();
                this.jsonError = false;
                this.jsonErrorMessage = "";
                this.generateCode();
                this.verifyKey();
            } catch(err) {
                this.jwt.token = '';
                this.jsonError = true;
                this.jsonErrorMessage = err.toString();
            }
        },

        verifyKey: function() {
            try {
                var result = nJwt.verify(this.jwt.token, this.jwt.key);
                this.jwt.signature = 'VERIFIED!';
                this.signature = 'verified';
            } catch(err) {
                this.jwt.signature = err.userMessage;
                this.signature = 'invalid';
            }

        },


        generateJwt: function() {
            var jwt = nJwt.create(JSON.parse("{\"sub\": \"1234567890\", \"name\":\"John Doe\", \"admin\":true}"), this.jwt.key);
            this.jwt.token = jwt.compact();
            this.decode();
        },

        generateCode: function(jwtPackage) {
            if(jwtPackage == null) {
                jwtPackage = this.jwtLibrary;
            } else {
                this.jwtLibrary = jwtPackage;
            }

            this.jwt.codeEncode = 'Loading...';
            this.encodeTextArea.setValue(this.jwt.codeEncode);
            this.jwt.codeDecode = 'Loading...';
            this.decodeTextArea.setValue(this.jwt.codeDecode);

            this.$http.post('generatedCode', {jwt: this.jwt, jwtPackage: this.jwtLibrary}).then((response) => {

                this.jwt.codeEncode = response.data.encode.replace(/&quot;/g, '"').replace(/&gt;/g, '>');
                this.encodeTextArea.setValue(this.jwt.codeEncode);

                this.jwt.codeDecode = response.data.decode.replace(/&quot;/g, '"').replace(/&gt;/g, '>');
                this.decodeTextArea.setValue(this.jwt.codeDecode);


            }, (response) => {
                console.log(response);
            });

            this.$http.get(libs[this.jwtLibrary.replace('/','-')]['readme']).then((response) => {
                this.codeLibrary.href = libs[this.jwtLibrary.replace('/','-')]['repo']
                this.codeLibrary.readme = marked(response.data);

            }, (response) => {
                console.log(response);
            });
        },

        signup: function() {
            this.signupFields.successMessage = "Please wait. Registering your account.";
            this.signupFields.statusType = "registering";
            this.signupFields.status = true;

            var vm = this;

            this.$http.post('/register', {data: this.signupFields}).then((response) => {

            vm.signupFields.successMessage = "Please check your email to finish registration";
            vm.signupFields.statusType = "success";
            vm.signupFields.status = true;

                setTimeout(function(){
                    vm.signupFields.successMessage = "";
                    vm.signupFields.statusType = "";
                    vm.signupFields.status = false;
                }, 8000);


        }, (response) => {

                vm.signupFields.successMessage = "There was an error during registration. Please visit Stormpath to finish registration";
                vm.signupFields.statusType = "error";
                vm.signupFields.status = true;

                setTimeout(function(){
                    vm.signupFields.successMessage = "";
                    vm.signupFields.statusType = "";
                    vm.signupFields.status = false;
                }, 8000);
            });
        }


    }
});






