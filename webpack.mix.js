const mix = require("laravel-mix");

mix.postCss("resources/css/app.css", "public/css", [require("tailwindcss")]).js(
    "resources/js/app.js",
    "public/js"
);

mix.version(); // Enable cache busting
