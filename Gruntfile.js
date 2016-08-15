/* global module, require */

module.exports = function(grunt) {

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
				src: [ '*.css', '!ie.css' ]
			}
		},

		browserSync: {
			dev: {
				bsFiles: {
					src: [
						'*.css',
						'**/*.php',
						'*.js'
					]
				},
				options: {
					proxy: 'http://vagrant.local', // enter your local WP URL here
				}
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
					}
				]
			}
		},

		po2mo: {
			files: {
				src: 'languages/*.po',
				expand: true
			}
		},

		pot: {
			options:{
				text_domain: pkg.name, //Your text domain. Produces my-text-domain.pot
				dest: 'languages/', //directory to place the pot file
				keywords: [ //WordPress localisation functions
					'__:1',
					'_e:1',
					'_x:1,2c',
					'esc_html__:1',
					'esc_html_e:1',
					'esc_html_x:1,2c',
					'esc_attr__:1',
					'esc_attr_e:1',
					'esc_attr_x:1,2c',
					'_ex:1,2c',
					'_n:1,2',
					'_nx:1,2,4c',
					'_n_noop:1,2',
					'_nx_noop:1,2,3c'
				]
			},
			files:{
				src:  [ '**/*.php' ],
				expand: true
			}
		},

		replace: {
			pot: {
				src: 'languages/*.po*',
				overwrite: true,
				replacements: [
					{
						from: 'SOME DESCRIPTIVE TITLE.',
						to: pkg.title
					},
					{
						from: 'YEAR THE PACKAGE\'S COPYRIGHT HOLDER',
						to: new Date().getFullYear()
					},
					{
						from: 'FIRST AUTHOR <EMAIL@ADDRESS>, YEAR.',
						to: 'GoDaddy Operating Company, LLC.'
					},
					{
						from: 'charset=CHARSET',
						to: 'charset=UTF-8'
					}
				]
			}
		},

		sass: {
			dist: {
				files: {
					'style.css'        : '.dev/sass/style.scss',
					'editor-style.css' : '.dev/sass/editor-style.scss',
					'ie.css'           : '.dev/sass/ie.scss'
				}
			}
		},

		watch: {
			css: {
				files: '.dev/**/*.scss',
				tasks: [ 'sass','autoprefixer','cssjanus' ]
			},
			pot: {
				files: [ '**/*.php' ],
				tasks: [ 'pot' ]
			}
		}
	});


	require('matchdep').filterDev('grunt-*').forEach( grunt.loadNpmTasks );

	grunt.registerTask( 'default', [ 'sass', 'autoprefixer', 'cssjanus' ] );
	grunt.registerTask( 'lint', [ 'jshint' ] );
	grunt.registerTask( 'update-pot', [ 'pot', 'replace:pot' ] );

};
