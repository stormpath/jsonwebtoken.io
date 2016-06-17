var uuid = require('uuid');
var nJwt = require('njwt');

var CodeMirror = require('codemirror');

require('codemirror/mode/javascript/javascript.js');

var codeMirrorOptions = {
    readOnly: true,
    lineNumbers: true,
    theme: 'yeti'
};

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
        jwtLibrary: "jwtk/nJwt",
        signature: "invalid",
        headerTextArea: "",
        payloadTextArea: "",
        decodeTextArea: "",
        encodeTextArea: ""

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

    },

    ready() {
        this.headerTextArea = CodeMirror.fromTextArea(document.getElementById('jwtHeader'), {
            readOnly: true,
            lineNumbers: false,
            lineWrapping: true,
            mode: {
                name: 'javascript', json: true
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
            theme: 'neo'
        });

        this.decodeTextArea = CodeMirror.fromTextArea(document.getElementById('jwtCodeDecode'), {
            readOnly: true,
            lineNumbers: true,
            lineWrapping: true,
            mode: {
                name: 'javascript', json: true
            },
            theme: 'neo'
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

            } catch(err) {
                console.error('==================');
                console.error('Decode Error: ');
                console.error(err);
                console.error('==================');
            }
        },

        encode: function() {
            try {
                var token = nJwt.create(JSON.parse(this.jwt.payload),this.jwt.key);
                this.jwt.token = token.compact();

                this.generateCode();
            } catch(err) {
                console.error('==================');
                console.error('Decode Error: ');
                console.error(err);
                console.error('==================');
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
                console.error('==================');
                console.error('Decode Error: ');
                console.error(err);
                console.error('==================');
            }

            this.generateCode();
        },


        generateJwt: function() {
            var jwt = nJwt.create(JSON.parse("{\"sub\": 1234567890, \"name\":\"John Doe\", \"admin\":true}"), this.jwt.key);
            this.jwt.token = jwt.compact();
            this.decode();
        },

        generateCode: function(jwtPackage) {
            if(jwtPackage == null) {
                jwtPackage = this.jwtLibrary;
            } else {
                this.jwtLibrary = jwtPackage;
            }

            console.log(jwtPackage);
            this.jwt.codeEncode = 'Loading...';
            this.jwt.codeDecode = 'Loading...';

            this.$http.post('generatedCode', {jwt: this.jwt, jwtPackage: this.jwtLibrary}).then((response) => {
                this.jwt.codeEncode = response.data.encode.replace(/&quot;/g, '"').replace(/&gt;/g, '>');
                this.encodeTextArea.setValue(this.jwt.codeEncode);
                this.jwt.codeDecode = response.data.decode.replace(/&quot;/g, '"').replace(/&gt;/g, '>');
                this.decodeTextArea.setValue(this.jwt.codeDecode);
            }, (response) => {
                console.log(response);
            });
        }
    }
});






