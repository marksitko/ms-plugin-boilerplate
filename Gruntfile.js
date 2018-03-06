module.exports = function(grunt) {

    // Configure main project settings
    grunt.initConfig({

        // Baisc settings about info and plugins
        pkg: grunt.file.readJSON('package.json'),

        sass: {
            dist: {
                options: {
                    sourcemap: 'none',
                },
                files: {
                    'assets/dist/css/wpps_style.css' : 'assets/src/scss/style.scss'
                }
            }
        },
        postcss: {
            options: {
                processors: [
                    require('autoprefixer'),
                    // require('cssnano')() // minify the result
                ]
            },
            dist: {
                src: 'assets/dist/css/wpps_style.css'
            }
        },
        concat: {
            options: {
                stripBanners: true,
                banner: 'jQuery(document).ready(function($) {',
                footer: '});',
            },
            dist: {
                src: ['assets/src/js/_variables.js', 'assets/src/js/_functions.js', 'assets/src/js/_script.js'],
                dest: 'assets/src/js/build.js',
            }
        },
        uglify: {
            my_target: {
                files: {
                    'assets/dist/js/wpps_script.js': 'assets/src/js/build.js',
                }
            }
        },
        watch: {
            options: {
                livereload: true
            },
            files: ['*.php', '**/*.php', 'assets/src/**/*.*'],
            tasks: ['sass', 'concat', 'postcss', 'uglify'],
        },
        
    });

    // load the plugin
    grunt.loadNpmTasks('grunt-postcss');
    grunt.loadNpmTasks('grunt-contrib-sass');
    grunt.loadNpmTasks('grunt-contrib-watch');
    grunt.loadNpmTasks('grunt-contrib-concat')
    grunt.loadNpmTasks('grunt-contrib-uglify');
    
    // do the task
    grunt.registerTask('default', ['watch']);
    grunt.registerTask('convert', ['sass']);
    grunt.registerTask('build-js', ['concat', 'uglify']);


};