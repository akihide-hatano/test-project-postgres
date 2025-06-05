import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.js', // この行は既存かもしれません (resources/js配下のJSファイルをスキャン)
        './resources/js/**/*.vue', // Vueを使っている場合 (Vueファイルを使っていれば)
        './public/js/**/*.js', // ★★★ この行を追加する！ ★★★ (public/js配下のJSファイルをスキャン)
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
        },
    },

    plugins: [forms],
};
