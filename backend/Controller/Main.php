<?php

class Main
{
    public function CreateView($url) {
        require 'frontend/'. "$url" . '.html';
    }
}