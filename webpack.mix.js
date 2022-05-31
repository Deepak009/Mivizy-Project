const mix = require('laravel-mix');
const path = require("path");
require("vuetifyjs-mix-extension");

mix.webpackConfig(webpack => {
    return {
        resolve: {
            alias: {
                '@': path.resolve(__dirname, 'resources/js'),
            },
        },
    }
})
mix.copy("resources/images", "public/images");
mix.js("resources/js/app.js", "public/js")
    .vuetify("vuetify-loader", {
        extract: "css/app.css"
    })
    .vue();
