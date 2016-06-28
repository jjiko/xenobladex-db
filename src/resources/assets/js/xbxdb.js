// Hi :)
var tid = setInterval( function () {
    if ( document.readyState !== 'complete' ) return;
    clearInterval( tid );
    var app = require('./x0.1.0/app.js').init();
    console.log(window.location);
}, 100 );