<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    $subscribe_url = config('pushover.url')
        .'?success='.urlencode(config('app.url').'?success=1')
        .'&failure='.urlencode(config('app.url').'?failed=1');

    return view('index', compact('subscribe_url'));
});
