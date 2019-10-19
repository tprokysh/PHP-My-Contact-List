<?php

class Route
{
    public static $validRoutes = array();

    public static function set ($url, $func) {
        self::$validRoutes = $url;
        if ($_GET['url'] == $url) {
            $func->__invoke();
        }
    }
}