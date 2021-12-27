<?php
/**
 * Created by PhpStorm.
 * User: Sofiane Akbly <sofiane.akbly@gmail.com>
 * Date: 06/04/2021
 * Time: 17:17
 */

/** @var Router $router */

use Illuminate\Support\Facades\Route;
use Laravel\Lumen\Routing\Router;

Route::group(['as' => 'auth.', 'prefix' => 'auth'], function () {
    
    $namespacePrefix = '\\' . config('auth.controllers.namespace') . '\\';
    
    Route::post('/login', $namespacePrefix . 'LoginController@login');
    Route::post('/register', $namespacePrefix . 'RegisterController@register');
    Route::post('/logout', $namespacePrefix . 'AuthController@logout');
    
    Route::get('/logged', $namespacePrefix . 'AuthController@logged');
    Route::get('/current', $namespacePrefix . 'AuthController@user');
});
