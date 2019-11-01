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

if (!function_exists('include_page_content')) {
    function include_page_content(string $code)
    {
        $page = \App\Models\Page::where('code', $code)->first();

        if($page) {
            $html = $page->content;
            $html = preg_replace('/<blockquote>/', '<blockquote class="generic-blockquote">', $html);
            $html = preg_replace('/<table.*>/', '<table class="table">', $html);
            $html = preg_replace('/<ol>/', '<ol class="ordered-list">', $html);
            $html = preg_replace('/<ul>/', '<ul class="unordered-list">', $html);
            $html = preg_replace('/<strong>/', '<b>', $html);
            $html = preg_replace('/<\/strong>/', '</b>', $html);
            $html = preg_replace('/<s>/', '<del>', $html);
            $html = preg_replace('/<\/s>/', '</del>', $html);
            $html = '<div class="all-initial">' . $html . '</div>';
        }else {
            $html = '';
        }

        return $html;
    }
}

if (!function_exists('include_page_header')) {
    function include_page_header(string $code)
    {
        $page = \App\Models\Page::where('code', $code)->first();

        return $page ? $page->name : '';
    }
}
