<?php


if (!function_exists('isActiveRoute')) {
    function isActiveRoute($routes){
        $currentRoute = request()->route();
        if ($currentRoute) {
            return in_array($currentRoute->getName(), (array) $routes) ? 'active' : '';
        }
        return '';
    }
}