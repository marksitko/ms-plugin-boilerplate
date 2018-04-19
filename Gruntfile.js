module.exports = function(grunt) {

    var projectConfig = {
        'prefix': 'wpps_',
        'sassDir': 'assets/src/scss/',
        'cssDir': 'assets/dist/css/',
        'jsSrc': 'assets/src/js/',
        'jsDist': 'assets/dist/js/',
    }


    // Configure main project settings
    grunt.initConfig({

        // Baisc settings about info and plugins
        pkg: grunt.file.readJSON('package.json'),
        projectConfig: projectConfig,

        sass: {
            dist: {
                options: {
                    sourcemap: 'none',
                },
                files: {
                    '<%= projectConfig.cssDir %><%= projectConfig.prefix %>style.css' : '<%= projectConfig.sassDir %>style.scss'
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
                src: '<%= projectConfig.cssDir %><%= projectConfig.prefix %>style.css'
            }
        },
        concat: {
            options: {
                stripBanners: true,
                banner: 'jQuery(document).ready(function($) {',
                footer: '});',
            },
            dist: {
                src: ['<%= projectConfig.jsSrc %>_variables.js', '<%= projectConfig.jsSrc %>_functions.js', '<%= projectConfig.jsSrc %>_scripts.js'],
                dest: '<%= projectConfig.jsSrc %>build.js',
            }
        },
        uglify: {
            my_target: {
                files: {
                    '<%= projectConfig.jsDist %><%= projectConfig.prefix %>script.js': '<%= projectConfig.jsSrc %>build.js',
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
    grunt.registerTask('build', ['sass', 'concat', 'postcss', 'uglify']);
    grunt.registerTask('build-js', ['concat', 'uglify']);


};