// Kopirovani souboru
// ------------------


'use strict';

module.exports = {

   bootstrap_js: {
        files: [
            {
                src: 'node_modules/bootstrap/dist/js/bootstrap.js',
                dest: 'puclic/assets/js/bootstrap/bootstrap.js'
            }
        ]
    },

    bootstrap_css: {
        files: [
            {
                src: 'node_modules/bootstrap/dist/css/bootstrap.css',
                dest: 'public/assets/css/bootstrap/bootstrap.css'
            }
        ]
    }
};
