
/*
 |--------------------------------------------------------------------------
 | Browser-sync config file
 |--------------------------------------------------------------------------
 |
 | For up-to-date information about the options:
 |   http://www.browsersync.io/docs/options/
 |
 | There are more options than you see here, these are just the ones that are
 | set internally. See the website for more info.
 |
 |
 */
module.exports = {
    "files": [
        "**/index.php",
        "**/include/*.php",
        "_themes/**/css/*.css",
        "js/**/*.js",
        "_themes/**/js/*.js",
        "img/*"
    ],
    "proxy": 'localhost:80',
};