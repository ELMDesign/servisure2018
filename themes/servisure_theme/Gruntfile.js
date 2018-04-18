module.exports = function (grunt) {
  require('load-grunt-tasks')(grunt);

  grunt.initConfig({
    pkg: grunt.file.readJSON('package.json'),

    sass: {
      dist: {
        options: {
          outputStyle: 'compressed',
          includePaths: ['scss']
        },
        files: {
          'css/servisure_theme.css': 'scss/servisure_theme.scss'
        }
      }
    },

    copy: {
      dist: {
        files: [
          {expand: true, cwd: 'bower_components/foundation/css/', src: ['*'], dest: 'css/', filter: 'isFile'},
          {expand: true, cwd: 'bower_components/foundation/js/', src: ['**'], dest: 'js/'},
          {expand: true, cwd: 'bower_components/foundation/scss/', src: ['**'], dest: 'scss/'}
        ]
      }
    },

    watch: {
      grunt: {files: ['Gruntfile.js']},


      sass: {
        files: 'scss/**/*.scss',
        tasks: ['sass']
      }
    },
    browserSync: {
            dev: {
                bsFiles: {
                    src : [
                        'css/*.css',
                        'js/*.js',
                        'scss/**/*.scss',
                        'templates/*.php'
                    ]
                },
                options: {
                    watchTask: true,
                    proxy: "http://servisure.dev.dd:8083"

                }
            }
        }
  });

  //Load NPM Tasks
  grunt.loadNpmTasks('grunt-browser-sync');
  //Register Grunt Tasks
  grunt.registerTask('build', ['copy', 'sass']);
  grunt.registerTask('default', ['browserSync', 'watch']);
};