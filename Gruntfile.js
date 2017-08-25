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
                    'assets/public/css/PREFIX-style.css' : 'assets/scss/public.scss',
                    'assets/public/css/flex-grid.css' : 'assets/scss/flex-grid.scss',
                    'assets/admin/css/PREFIX-admin-style.css' : 'assets/scss/admin.scss'
                }
            }
        },
        postcss: {
            options: {
                processors: [
                    require('autoprefixer'),
                ]
            },
            dist: {
                src: 'assets/public/css/PREFIX-style.css',
                src: 'assets/public/css/flex-grid.css',
                src: 'assets/admin/css/PREFIX-style.css'
            }
        },
        watch: {
            files: ['**/*.php', 'assets/scss/**/*.scss'],
            tasks: ['sass', 'postcss'],
        },
        
    });

    // load the plugin
    grunt.loadNpmTasks('grunt-postcss');
    grunt.loadNpmTasks('grunt-contrib-sass');
    grunt.loadNpmTasks('grunt-contrib-watch');
    grunt.loadNpmTasks('grunt-contrib-concat');
    

    // do the task
    grunt.registerTask('default', ['watch']);
    grunt.registerTask('convert', ['sass']);


};