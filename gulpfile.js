const gulp = require('gulp');
const notify = require('gulp-notify');
const wpPot = require('gulp-wp-pot');

// Define a task to generate POT file
gulp.task('pot', function () {
    return gulp.src('./src/**/*.php')
        .pipe(wpPot({
            domain: 'business-profile-render',
            destFile: './language/business-profile-render.pot',
            package: 'Business Profile Render',
        }))
        .pipe(gulp.dest('./language/business-profile-render.pot'))
        .pipe(notify('POT file generated successfully!'));
});

// Define a default task
gulp.task('default', gulp.series('pot'));