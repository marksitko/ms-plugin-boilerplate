var gulp = require('gulp');
var sass = require('gulp-sass');
var postcss = require('gulp-postcss');
var cssnano = require('cssnano')
var autoprefixer = require('autoprefixer');
var uglify = require('gulp-uglify');
var rename = require('gulp-rename');
var concat = require('gulp-concat-util');
var copy = require('gulp-copy');
var clean = require('gulp-clean');
var replace = require('gulp-replace');
var gulpSequence = require('gulp-sequence');
var runSequence = require('run-sequence');
var merge = require('merge-stream');
var defaultConfig = require('./config/config.default');
var buildConfig = require('./config/config.build');
var directoriesConfig = require('./config/config.directories');
var settingsConfig = require('./config/config.settings');

function capitalize(str) {
    return str.charAt(0).toUpperCase().concat(str.slice(1));
}

var config = {
    'default': {
        ...defaultConfig
    },
    'build': {
        ...buildConfig
    },
    'directories': {
        ...directoriesConfig
    },
    'settings': {
        ...settingsConfig
    }
};

var plugins = [
    autoprefixer({ browsers: ['> 1%', 'last 3 versions', 'iOS >= 8'] }),
    cssnano()
];

gulp.task('sass', () => {
    return gulp.src(config.directories.sass + 'style.scss')
        .pipe(sass().on('error', sass.logError))
        .pipe(postcss(plugins))
        .pipe(rename({prefix: config.default.prefix}))
        .pipe(gulp.dest(config.directories.css))
});

gulp.task('scripts', () => {
    return gulp.src([config.directories.jsSrc + '_variables.js', config.directories.jsSrc + '_functions.js', config.directories.jsSrc + '_scripts.js'])
        .pipe(concat('build.js'))
        .pipe(concat.header(config.settings.jsHeader))
        .pipe(concat.footer(config.settings.jsFooter))
        .pipe(gulp.dest(config.directories.jsSrc))
});

gulp.task('uglify', () => {
    return gulp.src(config.directories.jsSrc + 'build.js')
        .pipe(uglify())
        .pipe(rename({ basename: config.default.prefix + 'script', suffix: '.min' }))
        .pipe(gulp.dest(config.directories.js))
});


gulp.task('copy', () => {
    return gulp.src([
        './package.json',
        './*.php',
        './*src/**',
        './*assets/**',
    ])
        .pipe(gulp.dest(config.build.dest))
});

gulp.task('rename', () => {
    var pluginFile = gulp.src(config.build.dest + config.default.pluginFile)
        .pipe(clean())
        .pipe(rename({ basename: config.build.pluginName}))
        .pipe(gulp.dest(config.build.dest));

    var pluginName = gulp.src(config.build.dest + 'src/' + config.default.pluginName + '.php')
        .pipe(clean())
        .pipe(rename({ basename: capitalize(config.build.pluginName) }))
        .pipe(gulp.dest(config.build.dest + 'src/'));
    
    var css = gulp.src(config.build.dest + config.directories.css + 'wpps_style.css')
        .pipe(clean())
        .pipe(rename({ basename: config.build.prefix + 'style' }))
        .pipe(gulp.dest(config.build.dest + config.directories.css));
    
    var scripts = gulp.src(config.build.dest + config.directories.js + 'wpps_script.min.js')
        .pipe(clean())
        .pipe(rename({ basename: config.build.prefix + 'script', suffix: '.min' }))
        .pipe(gulp.dest(config.build.dest + config.directories.js));
    
    return merge(pluginFile, pluginName, css, scripts);
});

gulp.task('replace', () => {
    return gulp.src(config.build.dest + '**/')
        .pipe(replace(config.default.plainPrefix, config.build.plainPrefix))
        .pipe(replace(config.default.pluginName, capitalize(config.build.pluginName)))
        .pipe(gulp.dest(config.build.dest))
});

gulp.task('build-plugin', () => {
    runSequence(
        'sass',
        'scripts',
        'uglify',
        'copy',
        'rename',
        'replace'
    );
});
