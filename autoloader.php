<?php
include 'database.php';
function autoLoader($class) {
    $file = str_replace('\\', '/', $class . '.php');
    if (file_exists("classes/" . $file)) {
        require_once "classes/" . $file;
    }
    if (file_exists("Controller/" . $file)) {
        require_once "Controller/" . $file;
    }
    if (file_exists($file)) {
        require_once "$file";
    }
}

spl_autoload_register("autoLoader");
