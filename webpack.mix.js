const mix = require("laravel-mix");

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel applications. By default, we are compiling the CSS
 | file for the application as well as bundling up all the JS files.
 |
 */

// mix.js("resources/js/app.js", "public/js").postCss(
//     "resources/css/app.css",
//     "public/css",
//     [
//         //
//     ]
// );

var pluginPath = "resources/plugins/";

mix.combine(
    [
        // ** Required Plugins **
        pluginPath + "jquery/jquery.js",
        pluginPath + "bootstrap/popper.js",
        pluginPath + "bootstrap/bootstrap.js",

        // ** Additional Plugins **
        pluginPath + "toastr/toastr.js",
        pluginPath + "notie/notie.js",
        pluginPath + "jquery-validate/jquery.validate.js",
        pluginPath + "jquery-validate/additional-methods.js",
        pluginPath + "select2/select2.js",
        pluginPath + "datatables/jquery.dataTables.js",
        pluginPath + "datatables/dataTables.bootstrap4.js",
        pluginPath + "datatables/dataTables.responsive.js",
        pluginPath + "bootstrap-datepicker/bootstrap-datepicker.js",
    ],
    "public/assets/js/core/plugins.js"
    )
    .js("resources/js/app.js", "public/assets/js/core/")
    .sass("resources/sass/jhsmix.scss", "public/assets/css/")
    .options({
        processCssUrls: false,
    })
    .version();
