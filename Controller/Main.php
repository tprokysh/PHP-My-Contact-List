<?php

class Main
{
    public function CreateView($url) {
        require 'View/'. "$url" . '.php';
    }

    public function CreateApi($url) {
        require "$url.php";
    }
}