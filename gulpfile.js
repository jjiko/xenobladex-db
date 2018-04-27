'use strict';

var gulp = require('gulp');
var autoprefixer = require('gulp-autoprefixer');
var browserify = require('gulp-browserify');
var rename = require('gulp-rename');
var sass = require('gulp-sass');

// XBXDB
gulp.task('css', function () {
    gulp.src(__dirname + '/src/resources/assets/sass/xbxdb.scss')
        .pipe(sass({errLogToConsole: true}))
        .pipe(autoprefixer('last 10 version'))
        .pipe(gulp.dest(__dirname + '/public/dist/css'));
});
gulp.task('js', function () {
    gulp.src(__dirname + '/src/resources/assets/js/xbxdb.js')
        .pipe(browserify({
            debug: true,
            insertGlobals: true,
        }))
        .pipe(rename(__dirname + '/public/dist/js/app-xbxdb.js'))
        .pipe(gulp.dest('./'));
});
gulp.task('watch', function () {
    gulp.watch(__dirname + '/src/resources/assets/sass/**/*.scss', ['css']);
    gulp.watch(__dirname + '/src/resources/assets/js/**/*.js', ['js']);
});