/* global module, require */

module.exports = function( grunt ) {

	var pkg = grunt.file.readJSON( 'package.json' );

	grunt.initConfig({

		pkg: pkg,

		autoprefixer: {
			options: {
				browsers: [
					'Android >= 2.1',
					'Chrome >= 21',
					'Edge >= 12',
					'Explorer >= 7',
					'Firefox >= 17',
					'Opera >= 12.1',
					'Safari >= 6.0'
				],
				cascade: false
			},
			dist: {
				src: [ '*.css' ]
			}
		},

		cssjanus: {
			theme: {
				options: {
					swapLtrRtlInUrl: false
				},
				files: [
					{
						src: 'style.css',
						dest: 'style-rtl.css'
					},
					{
						src: 'editor-style.css',
						dest: 'editor-style-rtl.css'
					}
				]
			}
		},

		sass: {
			options: {
				precision: 5,
				sourceMap: false
			},
			dist: {
				files: [
					{
						'style.css': '.dev/sass/style.scss',
						'editor-style.css': '.dev/sass/editor-style.scss'
					}
				]
			}
		},

		watch: {
			css: {
				files: '.dev/sass/**/*.scss',
				tasks: [ 'sass','autoprefixer','cssjanus' ]
			}
		}

	});

	require( 'matchdep' ).filterDev( 'grunt-*' ).forEach( grunt.loadNpmTasks );

	grunt.registerTask( 'default', [ 'sass', 'autoprefixer', 'cssjanus' ] );

};
