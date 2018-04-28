// Hi :)
let tid = setInterval(function () {
    if (document.readyState !== 'complete') return;
    clearInterval(tid);
    let app = require('./x0.1.0/app.js').init();
}, 100);