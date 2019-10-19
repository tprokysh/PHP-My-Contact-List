<?php
include 'database.php';
function autoLoader($class) {
    $file = str_replace('\\', '/', $class . '.php');
    if (file_exists("backend/classes/" . $file)) {
        require_once "backend/classes/" . $file;
    }
    if (file_exists("backend/Controller/" . $file)) {
        require_once "backend/Controller/" . $file;
    }
    if (file_exists($file)) {
        require_once "backend/$file";
    }
}

spl_autoload_register("autoLoader");
