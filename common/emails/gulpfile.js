'use strict'

const gulp = require('gulp')
const gulp_inline_css = require('gulp-inline-css')
const gulp_file_include = require('gulp-file-include')
const gulp_htmlmin = require('gulp-htmlmin')
const gulp_sass = require('gulp-dart-sass')
const fs = require("fs")

const sass = () => {
	return gulp
		.src(['./src/styles.scss'])
		.pipe(gulp_sass().on('error', gulp_sass.logError))
		.pipe(gulp.dest('./src/'))
}

const php = () => {
	return gulp.src(['./src/*.php'])
		.pipe(gulp_file_include({
			prefix: '@@',
			basepath: '@file'
		}))
		.pipe(gulp_inline_css({
			preserveMediaQueries: true,
			removeStyleTags: false
		}))
		.pipe(gulp_htmlmin({ collapseWhitespace: true }))
		.pipe(gulp.dest('./dist/'));
}

const json = () => {
	return gulp.src(['./src/*.json']).pipe(gulp.dest('dist'))
}

const build = gulp.series(sass, php, json)

const watch = () => {
	gulp.watch(['./src/*.php'], { usePolling: true }, build)
	gulp.watch(['./src/*.scss', './src/**/*.scss'], { usePolling: true }, build)
	gulp.watch(['./src/*.json'], { usePolling: true }, build)
}

exports.build = build
exports.default = gulp.series(build, watch)


