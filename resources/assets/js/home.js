var uuid = require('uuid');
var nJwt = require('njwt');

var CodeMirror = require('codemirror');

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
        jwtLibrary: "jwtk/nJwt"

    },

    ready() {
        //CodeMirror.fromTextArea(document.getElementById('jwtHeader'), {
        //    readOnly: true,
        //    lineNumbers: true,
        //    theme: 'yeti'
        //});
        //CodeMirror.fromTextArea(document.getElementById('jwtPayload'), {
        //    readOnly: false,
        //    lineNumbers: true,
        //    theme: 'yeti'
        //});
        this.generateJwt();
    },


    methods: {
        decode: function() {
            try {
                var result = nJwt.verify(this.jwt.token, this.jwt.key);
                this.jwt.header = JSON.stringify(result.header, null, ' ');
                this.jwt.payload = JSON.stringify(result.body, null, ' ');
                this.jwt.signature = 'VERIFIED!';
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
            } catch(err) {
                this.jwt.signature = err.userMessage;
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
                this.jwt.codeDecode = response.data.decode.replace(/&quot;/g, '"').replace(/&gt;/g, '>');
            }, (response) => {
                console.log(response);
            });
        }
    }
});






