var gulp = require('gulp');
var sass = require('gulp-sass');
var postcss = require('gulp-postcss');
var cssnano = require('cssnano')
var autoprefixer = require('autoprefixer');
var uglify = require('gulp-uglify');
var rename = require('gulp-rename');
var concat = require('gulp-concat-util');
var runSequence = require('run-sequence');
/* start-dev-block */
var clean = require('gulp-clean');
var replace = require('gulp-replace');
var merge = require('merge-stream');
var stripCode = require('gulp-strip-code');
var deleteLines = require('gulp-delete-lines');
/* end-dev-block */
var config = require('./config/config');
var plugins = [
    autoprefixer({ browsers: ['> 1%', 'last 3 versions', 'iOS >= 8'] }),
    cssnano()
];

/* start-dev-block */
function capitalize(str) {
    return str.charAt(0).toUpperCase().concat(str.slice(1));
}
/* end-dev-block */

gulp.task('sass', () => {
    return gulp.src(config.directories.sass + 'style.scss')
        .pipe(sass().on('error', sass.logError))
        .pipe(postcss(plugins))
        .pipe(rename({prefix: config.default.prefix}))
        .pipe(gulp.dest(config.directories.css))
});

gulp.task('scripts', () => {
    return gulp.src([
            config.directories.jsSrc + '_variables.js', 
            config.directories.jsSrc + '_functions.js', 
            config.directories.jsSrc + '_scripts.js'
        ])
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

gulp.task('watch', () => {
    gulp.watch([
        config.directories.jsSrc + '**', 
        config.directories.sass + '**'
    ], ['default'])
});

/* start-dev-block */
gulp.task('copy', () => {
    return gulp.src([
        './package.json',
        './Gulpfile.js',
        './*config/**',
        './*.php',
        './*src/**',
        './*assets/**',
    ])
        .pipe(gulp.dest(config.build.dest))
});

gulp.task('rename', () => {
    var bootstrapFile = gulp.src(config.build.dest + config.default.bootstrapFile)
        .pipe(clean())
        .pipe(rename({ basename: config.build.pluginName}))
        .pipe(gulp.dest(config.build.dest));

    var pluginName = gulp.src(config.build.dest + 'src/' + config.default.pluginName + '.php')
        .pipe(clean())
        .pipe(rename({ basename: capitalize(config.build.pluginName) }))
        .pipe(gulp.dest(config.build.dest + 'src/'));

    var pluginFunctions = gulp.src(config.build.dest + 'src/plugin-functions/' + config.default.plainPrefix + '-functions.php')
        .pipe(clean())
        .pipe(rename({ basename: config.build.plainPrefix + '-functions' }))
        .pipe(gulp.dest(config.build.dest + 'src/plugin-functions/'));
    
    var css = gulp.src(config.build.dest + config.directories.css + config.default.prefix + 'style.css')
        .pipe(clean())
        .pipe(rename({ basename: config.build.prefix + 'style' }))
        .pipe(gulp.dest(config.build.dest + config.directories.css));
    
    var scripts = gulp.src(config.build.dest + config.directories.js + config.default.prefix + 'script.min.js')
        .pipe(clean())
        .pipe(rename({ basename: config.build.prefix + 'script', suffix: '.min' }))
        .pipe(gulp.dest(config.build.dest + config.directories.js));
    
    return merge(bootstrapFile, pluginName, pluginFunctions, css, scripts);
});

gulp.task('replace', () => {
    return gulp.src(config.build.dest + '**/')
        .pipe(replace(config.default.plainPrefix, config.build.plainPrefix))
        .pipe(replace(config.default.plainPrefix.toUpperCase(), config.build.plainPrefix.toUpperCase()))
        .pipe(replace(config.default.pluginName, capitalize(config.build.pluginName)))
        .pipe(replace(config.default.bootstrapFile, config.build.pluginName + '.php'))
        .pipe(gulp.dest(config.build.dest))
});

gulp.task('cleanupDevelopmentFiles', () => {
    var cleanupGulpfile = gulp.src(config.build.dest + 'Gulpfile.js')
        .pipe(stripCode(config.settings.stripCode))
        .pipe(gulp.dest(config.build.dest));
    
    var cleanupConfig = gulp.src(config.build.dest + 'config/config.js')
        .pipe(stripCode(config.settings.stripCode))
        .pipe(gulp.dest(config.build.dest + 'config/'));
    
    var removeBuildConfig = gulp.src(config.build.dest + 'config/config.build.js')
        .pipe(clean());

    return merge(cleanupGulpfile, cleanupConfig, removeBuildConfig);
})

gulp.task('cleanupPackageJson', () => {
    gulp.src(config.build.dest + 'package.json')
        .pipe(deleteLines({
            'filters': [
                /clean|replace|merge-stream|strip-code|delete-lines/i,
            ]
        }))
        .pipe(gulp.dest(config.build.dest));
});

gulp.task('build-plugin', () => {
    runSequence(
        'copy',
        'rename',
        'replace',
        'sass',
        'scripts',
        'uglify',
        'cleanupDevelopmentFiles',
        'cleanupPackageJson'
    );
});
/* end-dev-block */

gulp.task('default', () => {
    runSequence(
        'sass',
        'scripts',
        'uglify',
    );
});
