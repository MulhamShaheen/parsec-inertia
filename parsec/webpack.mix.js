
const path = require("path");
const mix = require("laravel-mix");


mix.alias({
    ziggy: path.resolve("vendor/tightenco/ziggy/dist/vue"),
});

mix.setPublicPath('/')
    .js('resources/js/app.js', 'js/')
    .vue()
    .webpackConfig({
        resolve: {
            alias: {
                "@": path.resolve(__dirname, "resources/js"),
            },
        },
    })
    .extract()
    .postCss('resources/css/app.css',
        'css/',
        [require("tailwindcss")]
    ).version();

