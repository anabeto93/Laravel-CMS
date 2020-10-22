<?php

if (!function_exists('getPages')) {
    function getPages($latest = false) {
        if (!$latest) {
            return App\Models\Post::published()->isPage()->get();
        }
        return App\Models\Post::published()->isPage()->latest()->get();
    }
}