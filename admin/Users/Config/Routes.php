<?php
namespace Admin\Users\Config;
if(!isset($routes))
{
    $routes = \Config\Services::routes(true);
}
$routes->group(env('app.adminROUTE'), ['namespace' => 'Admin','filter' => 'login'], function($routes)
{
    $routes->add('users', 'Users\Controllers\Users::index');
    $routes->post('users/search','Users\Controllers\Users::search');
    $routes->match(['get','post'],'users/add', 'Users\Controllers\Users::add');
    $routes->match(['get','post'],'users/edit/(:segment)', 'Users\Controllers\Users::edit/$1');
    $routes->get('users/delete/(:segment)',   'Users\Controllers\Users::delete/$1');
    $routes->post('users/delete','Users\Controllers\Users::delete');
    $routes->get('users/login/(:segment)','Users\Controllers\Users::login/$1');
    $routes->get('users/search','Users\Controllers\Users::getUsers');

    $routes->add('usergroup', 'Users\Controllers\Usergroup::index');
    $routes->post('usergroup/search','Users\Controllers\Usergroup::search');
    $routes->match(['get','post'],'usergroup/add', 'Users\Controllers\Usergroup::add');
    $routes->match(['get','post'],'usergroup/edit/(:segment)', 'Users\Controllers\Usergroup::edit/$1');
    $routes->get('usergroup/delete/(:segment)',   'Users\Controllers\Usergroup::delete/$1');
    $routes->post('usergroup/delete','Users\Controllers\Usergroup::delete');
    $routes->match(['get','post'],'usergroup/permission/(:segment)', 'Users\Controllers\Usergroup::permission/$1');

});
