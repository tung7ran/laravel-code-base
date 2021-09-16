<?php
    // Dùng để lưu trữ những hàm dùng chung
    define("__IMAGE_DEFAULT__", asset('public/backend/img/placeholder.png'));
    define("__BASE_URL__", url('public/frontend'));

    function isUpdate($method)
    {
        return (bool)$method == 'update';
    }

    function updateOrStoreRouteRender($method, $model, $data)
    {
        return isUpdate($method) ? route($model . '.update', $data) : route($model . '.store');
    }

    function renderLinkAddPostType()
    {
        $type = request()->get('type');
        if ($type == 'blog') {
            return [
                'title'    => 'Bài Viết',
                'linkAdd'  => route('posts.create', ['type' => 'blog']),
                'linkList' => route('posts.index', ['type' => 'blog']),
                'type' => 'blog',
            ];
        }
        if ($type == 'endow') {
            return [
                'title'    => 'Ưu đãi',
                'linkAdd'  => route('posts.create', ['type' => 'endow']),
                'linkList' => route('posts.index', ['type' => 'endow']),
                'type' => 'endow',
            ];
        }
    }
