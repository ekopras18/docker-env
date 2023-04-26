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
mix.styles([
    "public/assets/css/icons/icomoon/styles.min.css",
    "public/assets/css/icons/fontawesome/styles.min.css",
        "public/assets/css/minified/bootstrap.min.css",
        "public/assets/css/minified/bootstrap_limitless.min.css",
        "public/assets/css/minified/layout.min.css",
        "public/assets/css/minified/components.min.css",
        "public/assets/css/minified/colors.min.css",
        "public/assets/css/alertifyjs/alertify.min.css",
        "public/assets/css/alertifyjs/themes/bootstrap.min.css",
        "public/assets/js/plugins/ui/fullcalendar/main.css",
        "public/assets/css/custom.css",
], 
'public/assets/css/optima.css').version();

mix.scripts([
	"public/assets/js/main/jquery.min.js",
        "public/assets/js/main/bootstrap.bundle.min.js",
        "public/assets/js/plugins/loaders/blockui.min.js",
        "public/assets/js/plugins/forms/validation/validate.min.js",
        "public/assets/js/plugins/forms/styling/uniform.min.js",
        "public/assets/js/plugins/loaders/pace.min.js",
        "public/assets/js/plugins/visualization/d3/d3.min.js",
        "public/assets/js/plugins/visualization/c3/c3.min.js",
        "public/assets/js/plugins/visualization/d3/d3_tooltip.js",
        "public/assets/js/plugins/visualization/d3/venn.js",
        "public/assets/js/plugins/visualization/echarts/echarts.min.js",
        "public/assets/js/plugins/visualization/loader.js",
        "public/assets/js/plugins/forms/styling/uniform.min.js",
        "public/assets/js/plugins/forms/styling/switchery.min.js",
        "public/assets/js/plugins/forms/styling/switch.min.js",
        "public/assets/js/plugins/forms/selects/bootstrap_multiselect.js",
        "public/assets/js/plugins/ui/moment/moment.min.js",
        "public/assets/js/plugins/pickers/daterangepicker.js",
        "public/assets/js/plugins/ui/sticky.min.js",
        "public/assets/js/plugins/forms/wizards/steps.min.js",
        "public/assets/js/plugins/forms/selects/select2.min.js",
        "public/assets/js/plugins/forms/validation/validate.min.js",
        "public/assets/js/plugins/tables/datatables/datatables.min.js",
        "public/assets/js/plugins/media/fancybox.min.js",
        "public/assets/js/plugins/alertifyjs/alertify.min.js",
        "public/assets/js/plugins/autoNumeric/autoNumeric.js",
        "public/assets/js/plugins/editors/summernote/summernote.min.js",
        "public/assets/js/plugins/extensions/cookie.js",
        "public/assets/js/plugins/ui/fullcalendar/main.js",
        "public/assets/js/plugins/loaders/progressbar.min.js",
        "public/assets/js/app.js",
        "public/assets/js/custom.js"
],
'public/assets/js/optima.js').version();
