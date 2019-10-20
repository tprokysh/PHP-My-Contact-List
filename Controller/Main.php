<?php

class Main
{
    public function CreateView($url) {
        require 'View/'. "$url" . '.php';
    }
}