<?php

if (!function_exists('admin_uploads')) {
    function admin_uploads($name) {
        if(file_exists(storage_path('app/public/uploads/' . $name))) {
            return '/storage/uploads/' . $name;
        }else {
            return config('defaultImage', '/img/no-image.svg');
        }
    }
}

if (!function_exists('vue')) {
    function vue(string $value) {
        return '{{' . $value . '}}';
    }
}