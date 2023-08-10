const gulp = require('gulp');
const scss = require('gulp-dart-sass');
const babel = require('gulp-babel');
const rename = require('gulp-rename');
const gulpImports = require('gulp-imports');

const modules = [
	'admin',
	'console',
	'common',
	'staff',
	'chipped',
	'client',
];

const startModulePatch = function (module) {
	const input_pattern = './' + module + '/views/*';
	const output_folder = './' + module + '/web';


	const job_rejs = {
		styles: ['/**/*.scss'],
		scripts: ['/**/*.js'],
	}
	const jobs = {
		styles: () =>
			gulp.src(job_rejs.styles.map (path => input_pattern + path))
				.pipe(scss())
				.pipe(rename(function (path) {
					path.dirname = 'css';
				}))
				.pipe(gulp.dest(output_folder)),

		scripts: () =>
			gulp.src(job_rejs.scripts.map (path => input_pattern + path))
				.pipe(gulpImports())
				.pipe(babel())
				.pipe(rename(function (path) {
					path.dirname = 'js';
				}))
				.pipe(gulp.dest(output_folder)),
	}

	const job_names = Object.keys(job_rejs);

	job_names.forEach(job_name => {
		gulp.task(module + '-' + job_name, jobs[job_name]);
		gulp.watch(job_rejs[job_name].map (path => input_pattern + path), { usePolling: true }, gulp.series(module + '-' + job_name));
	});

	gulp.watch(input_pattern + '/**/*.php', { usePolling: true }, gulp.series(module + '-styles'));
	job_names.splice(job_names.indexOf('clean'), 1);

	return gulp.parallel(...job_names.map(job_name => module + '-' + job_name));
}

modules.forEach (module => {
	if (module == 'console' || module == 'common') {
		return;
	}

	const img_types = ['outline', 'solid'];

	img_types.forEach (type => {
		gulp.src(['./node_modules/heroicons/' + type + '/**/*'])
			.pipe(gulp.dest('./' + module + '/web/img/' + type));
	});
});

gulp.task('default', gulp.parallel(modules.map(module => startModulePatch(module))));
