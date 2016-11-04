var gulp = require('gulp');
var del = require('del');
var concat = require('gulp-concat');
var srcmaps = require('gulp-sourcemaps');
var ts = require('gulp-typescript');
var tsconfig = require('./tsconfig.json');
var SystemjsBuilder = require('systemjs-builder');

gulp.task('clean:css:lib', function () {
    return del('public/css/lib/*');
});

gulp.task('clean:js:lib', function () {
    return del('public/js/lib/*');
});

gulp.task('clean:js', function () {
    return del([ 'public/js/*', '!public/js/lib' ]);
});

gulp.task('compile:ts', function () {
    return gulp.src('src/app/**/*.ts')
        .pipe(srcmaps.init())
        .pipe(ts(tsconfig.compilerOptions))
        .pipe(srcmaps.write('.'))
        .pipe(gulp.dest('public/js'));
});

gulp.task('bundle:app', [ 'compile:ts' ], function () {
    var builder = new SystemjsBuilder('public', './src/systemjs.config.js');
    return builder.buildStatic('app', 'public/js/index.js');
});

gulp.task('bundle:vendor', [ 'copy:vendor' ], function () {
    return gulp.src([
        'node_modules/jquery/dist/jquery.slim.min.js',
        'node_modules/bootstrap/dist/js/bootstrap.min.js',
        'node_modules/core-js/client/shim.min.js',
        'node_modules/zone.js/dist/zone.js',
        'node_modules/reflect-metadata/Reflect.js',
        'node_modules/systemjs/dist/system.src.js',
        'src/systemjs.config.js'
    ])
    .pipe(concat('vendors.js'))
    .pipe(gulp.dest('public/js/lib'));
});

gulp.task('copy:vendor', function () {
    gulp.src('node_modules/@angular/**/*')
    .pipe(gulp.dest('public/js/lib/@angular/'));
    
    gulp.src('node_modules/rxjs/**/*')
    .pipe(gulp.dest('public/js/lib/rxjs'));
    
    return gulp.src('node_modules/angular-in-memory-web-api/bundles/*')
    .pipe(gulp.dest('public/js/lib/angular-in-memory-web-api/bundles'));
});

gulp.task('bundle:css:vendor', function () {
    return gulp.src([
        'node_modules/bootstrap/dist/css/bootstrap.min.css',
        'node_modules/bootstrap/dist/css/bootstrap-theme.min.css'
    ])
        .pipe(concat('vendors.css'))
        .pipe(gulp.dest('public/css/lib'));
});

gulp.task('clean', [ 'clean:js:lib', 'clean:js' ]);

gulp.task('vendor', [ 'copy:vendor', 'bundle:vendor' ]);
gulp.task('app', [ 'compile:ts', 'bundle:app' ]);

gulp.task('default', [ 'vendor', 'app' ]);