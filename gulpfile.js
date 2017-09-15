var gulp = require('gulp-param')(require('gulp'), process.argv),
    less = require('gulp-less'),
    rename = require('gulp-rename'),
    fs = require('fs');

var path_themes = './app/Resources/themes/',
    path_web_assets = './web/assets/',
    filename_dev = 'style_theme_1.css',
    filename = 'style.css';

gulp.task('watch', function (theme) {
    try {
        fs.accessSync(path_themes + theme);
    } catch (err) {
        console.log('You must choose a valid theme: "' + path_themes + theme + '" does not exist');
        return;
    }

    gulp.watch(path_themes + theme + '/assets/less/**/*.less', ['less']);
});

gulp.task('less', function (theme) {
    /* theme must be a string */
    if (typeof theme === 'undefined'
        || theme === false
        || theme === true) {
        console.log('You must select a theme: --theme <theme>');
        return;
    }

    /* ignore error in less file */
    var l = less({});
    l.on('error', function () {
        l.end();
    });

    console.info('Getting files from: ' + path_themes + theme + '/assets/less');
    console.info('Compiling: ' + path_web_assets + theme + '/css/style.css');

    return gulp.src(path_themes + theme + '/assets/less/theme.less')
        .pipe(l)
        .pipe(rename(filename))
        .pipe(gulp.dest(path_web_assets + theme + '/css'))
        .pipe(rename(filename_dev))
        .pipe(gulp.dest(path_web_assets + theme + '/css'));
});

gulp.task('default', ['less', 'watch']);
