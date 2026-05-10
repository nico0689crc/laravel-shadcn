<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('/showcase');
});

Route::get('/showcase', function () {
    return view('showcase.index');
});

Route::get('/showcase/components/{component}', function (string $component) {
    $view = "showcase.components.{$component}";
    if (view()->exists($view)) {
        return view($view);
    }
    abort(404);
});
