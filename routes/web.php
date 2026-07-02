<?php

use App\Core\Http\Response;
use App\Core\Route;

Route::get('/', function () {
    return new Response('<h1>Portal Agrofart 2.0</h1>');
});