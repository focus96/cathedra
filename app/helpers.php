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

if (!function_exists('setInSearchParams')) {
    function setInSearchParams($params, $value)
    {
        if (!count($params)) return $value;

        if (($key = array_search($value, $params)) !== false) {
            unset($params[$key]);
        }else {
            $params[] = $value;
        }

        return implode('_', array_unique($params));
    }
}

if (!function_exists('newsParams')) {
    function newsParams($id = null, $categories = null, $tags = null, $search = null)
    {
        $categories = !is_null($categories) ? $categories : request()->get('categories', null);
        $tags = !is_null($tags) ? $tags : request()->get('tags', null);
        $search = !is_null($search) ? $search : request()->get('search', null);

        return array_filter(compact(['id', 'categories', 'tags', 'search']));
    }
}