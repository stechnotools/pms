<?php
namespace Admin\Common\Config;
if(!isset($routes))
{ 
    $routes = \Config\Services::routes(true);
}

$routes->group('', ['namespace' => 'Admin','filter' => 'login'], function($routes)
{
    $routes->add('/', 'Common\Controllers\Dashboard::index');
    $routes->add('mdashboard', 'Common\Controllers\Dashboard::mdashboard');
    $routes->add('login', 'Common\Controllers\Auth::login');
    $routes->get('logout', 'Common\Controllers\Auth::logout');
    $routes->add('relogin', 'Common\Controllers\Auth::reLogin');
    $routes->match(['get','post'],'account/password', 'Common\Controllers\Auth::password');
    $routes->add('error', 'Common\Controllers\Error::index');

});

$routes->group('api', ['namespace' => 'Admin'], function($routes)
{
    $routes->add('login', 'Common\Controllers\Api::login');
});