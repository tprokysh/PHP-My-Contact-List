<?php

Route::set('index.php', function () {
    (new Contacts)->CreateView('index');
});

Route::set('api.php', function () {
    (new Main)->CreateApi('api');
});